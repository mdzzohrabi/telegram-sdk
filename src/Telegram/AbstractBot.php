<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram;

use Telegram\Bot\Entity\ReplyInterface;
use Telegram\Bot\Entity\ReplyKeyboardMarkup;
use Telegram\Bot\Entity\Update;

abstract class AbstractBot
{

    /**
     * @var TelegramBot
     */
    protected $api;

    /**
     * @return TelegramBot
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param TelegramBot $api
     * @return AbstractBot
     */
    public function setApi($api)
    {
        $this->api = $api;

        return $this;
    }

    /**
     * Make keyboard
     *
     * @param array $keyboard
     * @return ReplyKeyboardMarkup
     */
    protected function makeKeyboard( array $keyboard ) {
        return new ReplyKeyboardMarkup( $keyboard );
    }

    /**
     * Send message
     *
     * @param                     $chatId
     * @param                     $message
     * @param null                $replyTo
     * @param ReplyInterface|null $keyboard
     * @return Bot\Entity\Message
     */
    public function sendMessage( $chatId , $message , $replyTo = null , ReplyInterface $keyboard = null ) {
        return $this->getApi()->sendMessage(
            $chatId,
            $message,
            null,
            null,
            $replyTo,
            $keyboard
        );
    }

    /**
     * @param Update $update
     * @return mixed
     */
    public abstract function handle( Update $update );



}