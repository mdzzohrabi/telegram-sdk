<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot;


use Telegram\TelegramBot;

abstract class Middleware
{

    /**
     * @var TelegramBot
     */
    protected $bot;

    public abstract function handle( UpdateEvent $event );

    public abstract function preSendMessage( PreSendEvent $event );

    public abstract function preSendPhoto( PreSendPhotoEvent $event );

    public abstract function preInlineQueryAnswer( PreInlineQueryAnswerEvent $event );

    /**
     * @return TelegramBot
     */
    public function getBot()
    {
        return $this->bot;
    }

    /**
     * @param TelegramBot $bot
     */
    public function setBot($bot)
    {
        $this->bot = $bot;
    }

}