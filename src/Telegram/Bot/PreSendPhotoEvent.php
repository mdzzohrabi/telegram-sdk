<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot;


use Telegram\Bot\Entity\InputFile;
use Telegram\Bot\Entity\ReplyInterface;

class PreSendPhotoEvent
{

    /** @var  int */
    private $chatId;

    /** @var  InputFile|string */
    private $photo;

    /** @var  string */
    private $caption;

    /** @var  int */
    private $replyTo;

    /** @var  ReplyInterface */
    private $keyboard;

    public function __construct( $chatId , $photo , $caption , $replyTo , $keyboard )
    {
        $this->chatId = $chatId;
        $this->photo = $photo;
        $this->caption = $caption;
        $this->replyTo = $replyTo;
        $this->keyboard = $keyboard;
    }

    /**
     * @return int
     */
    public function getChatId()
    {
        return $this->chatId;
    }

    /**
     * @param int $chatId
     * @return PreSendPhotoEvent
     */
    public function setChatId($chatId)
    {
        $this->chatId = $chatId;

        return $this;
    }

    /**
     * @return string|InputFile
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string|InputFile $photo
     * @return PreSendPhotoEvent
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     * @return PreSendPhotoEvent
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * @return int
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @param int $replyTo
     * @return PreSendPhotoEvent
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    /**
     * @return ReplyInterface
     */
    public function getKeyboard()
    {
        return $this->keyboard;
    }

    /**
     * @param ReplyInterface $keyboard
     * @return PreSendPhotoEvent
     */
    public function setKeyboard($keyboard)
    {
        $this->keyboard = $keyboard;

        return $this;
    }



}