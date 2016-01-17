<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot;


use Telegram\Bot\Entity\ReplyInterface;

class PreSendEvent
{

    /** @var  int */
    private $chatId;

    /** @var  string */
    private $text;

    /** @var  int */
    private $replyTo;

    /** @var  ReplyInterface */
    private $keyboard;

    public function __construct( $chatId , $text , $replyTo , $keyboard )
    {
        $this->chatId = $chatId;
        $this->text = $text;
        $this->replyTo = $replyTo;
        $this->keyboard = $keyboard;
    }

    /**
     * @return mixed
     */
    public function getChatId()
    {
        return $this->chatId;
    }

    /**
     * @param mixed $chatId
     * @return PreSendEvent
     */
    public function setChatId($chatId)
    {
        $this->chatId = $chatId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return PreSendEvent
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @param mixed $replyTo
     * @return PreSendEvent
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getKeyboard()
    {
        return $this->keyboard;
    }

    /**
     * @param mixed $keyboard
     * @return PreSendEvent
     */
    public function setKeyboard($keyboard)
    {
        $this->keyboard = $keyboard;

        return $this;
    }



}