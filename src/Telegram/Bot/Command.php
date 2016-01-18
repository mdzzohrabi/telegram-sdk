<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot;

use Telegram\Bot\Entity\Update;
use Telegram\TelegramBot;

/**
 * Class Command
 *
 * @package Telegram\Bot
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
abstract class Command
{

    /**
     * Command name
     * @return string
     */
    public abstract function getName();

    public function getAlias() {
        return $this->getName();
    }

    public function getHelp() {
        return array(
            ($this->getAlias() ?: $this->getName()) => $this->getDescription()
        );
    }

    public function canHandle( Update $update ) {

        if ( $update->getMessage() === null ) return false;

        $text = trim( $update->getMessage()->getText() , "\t\n\r\\" );

        if ( $this->getName() == $text || $this->getAlias() == $text )
            return true;

        if ( preg_match('/^\/([^\s@]+)@?(\S+)?\s?(.*)$/', $text, $matches ) ) {
            $commandName = $matches[1];
            $arguments = $matches[3];
            return $this->getName() == $commandName || $this->getAlias() == $commandName ? $arguments : false;
        }

        return false;

    }

    /**
     * Command description
     * @return string
     */
    public abstract function getDescription();

    /**
     * Handle
     *
     * @param TelegramBot $bot
     * @param Update      $update
     * @param string|null $arguments
     * @return
     */
    public abstract function handle( TelegramBot $bot , Update $update , $arguments = null );

}