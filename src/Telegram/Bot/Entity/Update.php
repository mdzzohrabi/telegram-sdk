<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;

/**
 * Class Update
 *
 * This object represents an incoming update.
 *
 * @see https://core.telegram.org/bots/api#update
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class Update
{

    /**
     * The update‘s unique identifier.
     * @var int
     */
    protected $updateId;

    /**
     * Optional. New incoming message of any kind — text, photo, sticker, etc.
     * @var Message
     */
    protected $message;

    /**
     * @return int
     */
    public function getUpdateId()
    {
        return $this->updateId;
    }

    /**
     * @param int $updateId
     * @return Update
     */
    public function setUpdateId($updateId)
    {
        $this->updateId = $updateId;

        return $this;
    }

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param Message $message
     * @return Update
     */
    public function setMessage( Message $message )
    {
        $this->message = $message;

        return $this;
    }

    public function getUserId() {
        return $this->getMessage()->getFrom()->getId();
    }

    public function getChatId() {
        return $this->getMessage()->getChat()->getId();
    }

}