<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram;

use Exception;

/**
 * Class FileSpool
 *
 * @package Telegram
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class FileSpool
{

    /**
     * Path to store messages queue
     * @var string
     */
    protected $path;

    /**
     * Bulk message limit
     * @var int
     */
    protected $limit = 30;

    /**
     * Delay between packets
     * @var int
     */
    protected $delay = 1000;
    /**
     * @var TelegramBot
     */
    protected $bot;

    /**
     * FileSpool constructor.
     *
     * @param TelegramBot $bot
     * @param string      $path
     * @throws Exception
     */
    public function __construct( TelegramBot $bot, $path )
    {
        $this->path = $path;

        if ( !file_exists( $path ) )
            if ( !mkdir( $path , 0777 , true ) ) {
                throw new Exception(sprintf( 'Unable to create path "%s"' , $path ));
            }

        $this->bot = $bot;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    protected function generateId() {
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            //optional for php 4.2.0 and up.
            mt_srand((double)microtime()*10000);
            $charId = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                .substr($charId, 0, 8).$hyphen
                .substr($charId, 8, 4).$hyphen
                .substr($charId,12, 4).$hyphen
                .substr($charId,16, 4).$hyphen
                .substr($charId,20,12)
                .chr(125);// "}"
            return $uuid;
        }
    }

    /**
     * @param            $endpoint
     * @param            $params
     * @param bool|false $hasFile
     * @return bool      False on failure
     */
    public function queueMessage( $endpoint , $params , $hasFile = false ) {

        if ( $hasFile )
            foreach ( $params as &$param ) {
                list( $name , $contents ) = $param;
                if ( is_resource( $contents ) ) {
                    $meta = stream_get_meta_data( $contents );
                    $uri = $meta['uri'];
                    $param['contents'] = $uri;
                    $param['resource'] = true;
                }
            }

        $data = serialize([
            'endpoint'  => $endpoint,
            'params'    => $params
        ]);

        $messageId = 'message-' . $this->generateId();

        return file_put_contents( $this->path . '/' . $messageId , $data ) !== false;

    }

    public function flushQueue() {

        $sendMode = $this->bot->getSendMode();
        $this->bot->setSendMode( TelegramBot::SEND_TYPE_DIRECT );

        $directoryIterator = new \DirectoryIterator( $this->path );

        $count = 0;

        foreach ( $directoryIterator as $file ) {

            // Ignore none-message files
            if ( substr( $file->getFilename() , 0 , strlen('Message') ) != 'message' ) continue;

            // Ignore sending messages
            if ( $file->getExtension() == 'sending' ) continue;

            if ( rename( $file->getRealPath() , $newFile = $file->getRealPath() . '.sending' ) ) {

                $message = unserialize(file_get_contents( $newFile ));

                $params = [];
                $fileUpload = false;

                foreach ( $message['params'] as $i => $param ) {

                    if ( isset( $param['resource'] ) ) {
                        unset( $param['resource'] );
                        $param['contents'] = fopen( $param['contents'] , 'r' );
                        $fileUpload = true;
                    }

                    $params[ $i ] = $param;
                }

                $this->getBot()->post( $message['endpoint'] , $params , $fileUpload );

                unlink( $newFile );

                $count++;

            }

            if ( $this->getLimit() && $this->getLimit() <= $count ) {
                break;
            }

        }

        $this->bot->setSendMode( $sendMode );

        return $count;

    }

    public function loop() {

        while ( true ) {

            $this->flushQueue();

            if ( $this->getDelay() )
                sleep( $this->getDelay() );

        }

    }

    /**
     * @return TelegramBot
     */
    public function getBot()
    {
        return $this->bot;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getDelay()
    {
        return $this->delay;
    }

    /**
     * @param int $delay
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;
    }

}