<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Telegram\Bot\Command;
use Telegram\Bot\Commands;
use Telegram\Bot\Entity\File;
use Telegram\Bot\Entity\InputFile;
use Telegram\Bot\Entity\Message;
use Telegram\Bot\Entity\ReplyInterface;
use Telegram\Bot\Entity\Update;
use Telegram\Bot\Entity\User;
use Telegram\Bot\Entity\UserProfilePhotos;

/**
 * Class TelegramBot
 *
 * @package Telegram
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class TelegramBot
{

    /**
     * Telegram Api Base Url
     */
    const API_BASE_URL = 'https://api.telegram.org/bot';

    /**
     * Bot Api Token
     *
     * @var null|string
     */
    protected $apiToken = null;

    /**
     * @var Client|null
     */
    protected $httpClient;

    /**
     * @var Commands
     */
    protected $commands;

    /**
     * @var Command
     */
    protected $notFoundCommand;

    /**
     * @var string
     */
    protected $log;

    /**
     * TelegramBot constructor.
     *
     * @param string $apiToken
     * @param null   $httpClient
     */
    public function __construct( $apiToken , $httpClient = null )
    {
        $this->setApiToken( $apiToken );

        if ( !$httpClient )
            $httpClient = new Client;

        $this->httpClient = $httpClient;
        $this->commands = new Commands();

    }

    /**
     * @return string|null
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param string $apiToken
     * @return $this
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;
        return $this;
    }

    /**
     * Api Url
     * @return string
     */
    public function getApiUrl() {
        return self::API_BASE_URL . $this->getApiToken() . '/';
    }

    /**
     * Use this method to receive incoming updates using long polling . An Array of Update objects is returned.
     *
     * @param int|null $offset  Identifier of the first update to be returned.
     *                          Must be greater by one than the highest among the identifiers of previously received
     *                          updates. By default, updates starting with the earliest unconfirmed update are
     *                          returned. An update is considered confirmed as soon as getUpdates is called  with an
     *                          offset higher than its update_id.
     * @param int|null $limit   Limits the number of updates to be retrieved. Values between 1—100 are accepted.
     *                          Defaults to 100
     * @param int|null $timeout Timeout in seconds for long polling. Defaults to 0, i.e. usual short polling
     *
     * @return Update[]
     */
    public function getUpdates( $offset = null , $limit = null , $timeout = null ) {

        return DataTransformer::transform( $this->post( 'getUpdates' , [
            'offset'    => $offset,
            'limit'     => $limit,
            'timeout'   => $timeout
        ])->getResult() , Update::class , true );

    }

    /**
     * Use this method to specify a url and receive incoming updates via an outgoing webhook.
     *
     * @param string|null    $url         HTTPS url to send updates to. Use an empty string to remove webhook
     *                                    integration
     * @param InputFile|null $certificate Upload your public key certificate so that the root certificate in use can be
     *                                    checked.
     *
     * @link https://core.telegram.org/bots/api#setwebhook
     *
     * @return Message
     * @throws TelegramSDKException
     */
    public function setWebhook( $url = null , $certificate = null ) {

        if ( filter_var($url,FILTER_VALIDATE_URL) === false )
            throw new TelegramSDKException( 'Invalid URL Provided' );

        return $this->uploadFile( 'setWebhook' , [ 'url'    => $url, 'certificate'  => $certificate ] );

    }

    /**
     * @return Message
     */
    public function removeWebhook() {
        return $this->uploadFile( 'setWebhook' , [ 'url'    => '' ] );
    }

    /**
     * @return Commands
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @return Update
     * @throws TelegramSDKException
     */
    public function getWebhookUpdate() {
        $body = json_decode(file_get_contents('php://input'), true);
        return DataTransformer::transform( $body , Update::class );
    }

    /**
     * @param Update $update
     * @return mixed
     * @throws TelegramSDKException
     */
    public function handle( Update $update ) {

        foreach ( $this->getCommands()->getCommands() as $command ) {
            if ( $canHandle = $command->canHandle( $update ) ) {
                $arguments = !is_null($canHandle) ? $canHandle : null;
                return $command->handle( $this , $update , $arguments );
            }
        }

        if ( $this->notFoundCommand )
            return $this->notFoundCommand->handle( $this , $update );

        return 'Its not command';

    }

    /**
     * @return mixed|Client
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param mixed $httpClient
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param       $endpoint
     * @param array $params
     * @return Message
     * @throws TelegramSDKException
     */
    protected function uploadFile( $endpoint , array $params = [] ) {

        $request_params = [];

        foreach ( $params as $key => $value )
        {
            if ( is_null( $value ) ) continue;

            if ( !is_resource( $value ) && $key !== 'url' ) {
                $validUrl = filter_var( $value , FILTER_VALIDATE_URL );
                $value = !is_array($value) && ( is_file( $value ) || $validUrl ) ? (new InputFile( $value ))->open() : (string)$value;
            }

            $request_params[] = array(
                'name'      => $key,
                'contents'  => $value
            );

        }

        return DataTransformer::transform( $this->post( $endpoint , $request_params , true )->getResult() , Message::class );

    }

    /**
     * @param            $endpoint
     * @param array      $params
     * @param bool|false $fileUpload
     * @return Response
     */
    protected function post( $endpoint , array $params = [] , $fileUpload = false ) {

        if ( $fileUpload )
            $params = [ RequestOptions::MULTIPART => $params ];
        else
            $params = [ RequestOptions::FORM_PARAMS => $params ];

        return $this->sendRequest( 'POST' , $endpoint , $params );

    }

    /**
     * @param       $method
     * @param       $endpoint
     * @param array $params
     * @return Response
     */
    protected function sendRequest( $method , $endpoint , array $params = [] ) {

        $response = $this->getHttpClient()->request( $method , $this->getApiUrl() . $endpoint , $params );
        return new Response( $response );

    }

    /**
     * @Api
     * @return User
     * @throws TelegramSDKException
     */
    public function getMe() {
        return DataTransformer::transform( $this->post( 'getme' )->getResult() , User::class );
    }

    /**
     * @Api
     * Send message
     *
     * Use this method to send text messages. On success, the sent Message is returned.
     *
     * @see https://core.telegram.org/bots/api#sendmessage
     *
     * @param string|int           $chatId                Unique identifier for the target chat or username of the
     *                                                    target channel (in the format @channelusername)
     * @param string               $text                  Text of the message to be sent
     * @param string               $parseMode             Send Markdown
     * @param bool                 $disableWebPagePreview Disables link previews for links in this message
     * @param int                  $replyToMessageId      If the message is a reply, ID of the original message
     * @param ReplyInterface|null $replyMarkup           A JSON-serialized object for a custom reply keyboard,
     *                                                    instructions to hide keyboard or to force a reply from the
     *                                                    user.
     * @return Message
     */
    public function sendMessage( $chatId , $text , $parseMode = null , $disableWebPagePreview = null , $replyToMessageId = null , ReplyInterface $replyMarkup = null ) {

        return DataTransformer::transform( $this->post( 'sendMessage' , [
            'chat_id'                   => $chatId,
            'text'                      => $text,
            'parseMode'                 => $parseMode,
            'disable_web_page_preview'  => $disableWebPagePreview,
            'reply_to_message_id'       => $replyToMessageId,
            'reply_markup'              => json_encode( DataTransformer::serialize( $replyMarkup ) )
        ])->getResult() , Message::class );

    }

    /**
     * Forward message
     *
     * Use this method to forward messages of any kind. On success, the sent Message is returned.
     *
     * @see     https://core.telegram.org/bots/api#forwardmessage
     *
     * @param int|string $chatId     Unique identifier for the target chat or username of the target channel (in the
     *                               format @channelusername)
     * @param int|string $fromChatId Unique identifier for the chat where the original message was sent (or channel
     *                               username in the format @channelusername)
     * @param int        $messageId  Unique message identifier
     * @return Message
     */
    public function forwardMessage( $chatId , $fromChatId , $messageId ) {

        return DataTransformer::transform( $this->post( 'forwardMessage' , [
            'chat_id'   => $chatId,
            'from_chat_id'  => $fromChatId,
            'message_id'    => $messageId
        ] )->getResult() , Message::class );

    }

    /**
     * @Api
     * Send photo
     *
     * Use this method to send photos. On success, the sent Message is returned.
     *
     * @see     https://core.telegram.org/bots/api#sendphoto
     *
     * @param int|string           $chatId           Unique identifier for the target chat or username of the target
     *                                               channel (in the format @channelusername)
     * @param InputFile|string     $photo            Photo to send. You can either pass a file_id as String to resend a
     *                                               photo that is already on the Telegram servers, or upload a new
     *                                               photo using multipart/form-data.
     * @param string               $caption          Photo caption (may also be used when resending photos by file_id).
     * @param int                  $replyToMessageId If the message is a reply, ID of the original message
     * @param ReplyInterface|null  $replyMarkup      Additional interface options. A JSON-serialized object for a
     *                                               custom reply keyboard, instructions to hide keyboard or to force a
     *                                               reply from the user.
     * @return Message
     */
    public function sendPhoto( $chatId , $photo , $caption = null , $replyToMessageId = null , ReplyInterface $replyMarkup = null ) {

        return $this->uploadFile( 'sendPhoto' , [
            'chat_id'               => $chatId,
            'photo'                 => $photo,
            'caption'               => $caption,
            'reply_to_message_id'   => $replyToMessageId,
            'reply_markup'          => DataTransformer::serialize( $replyMarkup )
        ]);

    }


    /**
     * Get user profile photos
     *
     * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
     *
     * @see     https://core.telegram.org/bots/api#getuserprofilephotos
     * @param int|string $userId
     * @param int        $offset
     * @param int        $limit
     * @return UserProfilePhotos
     */
    public function getUserProfilePhotos( $userId , $offset = null , $limit = null ) {

        return DataTransformer::transform( $this->post( 'getUserProfilePhotos' , [
            'user_id'   => $userId,
            'offset'    => $offset,
            'limit'     => $limit
        ])->getResult() , UserProfilePhotos::class );

    }

    /**
     * @Api
     * Get File
     *
     * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download
     * files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link
     * https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is
     * guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by
     * calling getFile again.
     *
     * @see     https://core.telegram.org/bots/api#getfile
     *
     * @param string $fileId File identifier to get info about
     * @return mixed
     */
    public function getFile( $fileId ) {

        return DataTransformer::transform( $this->post('getFile',[ 'file_id' => $fileId ])->getResult() , File::class );

    }

    public function handleUpdates( $webhook = false )
    {

        if ( $webhook )
            return $this->handle( $this->getWebhookUpdate() );

        $updates = $this->getUpdates();
        $highestId = -1;

        foreach ( $updates as $update ) {
            $highestId = max( $highestId , $update->getUpdateId() );

            try {
                $this->handle($update);
            } catch ( \Exception $e ) {
                $this->log( 'Exception(' . $e->getCode() . ') : ' . $e->getMessage() . ' on ' . $e->getFile() . '(' . $e->getLine() . ')');
            }
        }

        $this->getUpdates( ++$highestId , 1 );

        return $updates;

    }

    /**
     * @param $logFile
     * @return $this
     */
    public function setLogFile( $logFile ) {
        $this->log = $logFile;
        return $this;
    }

    public function log( $message ) {

        if ( !$this->log )
            return;

        $message = '[' . date('c') . '] ' . $message . "\n";
        file_put_contents( $this->log , file_get_contents( $this->log ) . $message );

    }

    /**
     * @return Command
     */
    public function getNotFoundCommand()
    {
        return $this->notFoundCommand;
    }

    /**
     * @param Command $notFoundCommand
     * @return $this
     */
    public function setNotFoundCommand( Command $notFoundCommand)
    {
        $this->notFoundCommand = $notFoundCommand;
        return $this;
    }


}