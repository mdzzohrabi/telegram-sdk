<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;


abstract class InlineQueryResult
{

    /**
     * Type of the result, must be article
     * @var string
     */
    protected $type;

    /**
     * Unique identifier for this result, 1-64 Bytes
     * @var string
     */
    protected $id;

    /**
     * Title of the result
     * @var string
     */
    protected $title;

    /**
     * Optional. Send “Markdown”, if you want Telegram apps to show bold, italic and inline URLs in your bot's message.
     * @var string
     */
    protected $parseMode;

    /**
     * Text of the message to be sent with the video, 1-512 characters
     * @var string
     */
    protected $messageText;

    /**
     * Optional. Disables link previews for links in the sent message
     * @var bool
     */
    protected $disableWebPagePreview;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return InlineQueryResult
     * @deprecated
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return InlineQueryResult
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return InlineQueryResult
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getParseMode()
    {
        return $this->parseMode;
    }

    /**
     * @param string $parseMode
     * @return InlineQueryResult
     */
    public function setParseMode($parseMode)
    {
        $this->parseMode = $parseMode;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessageText()
    {
        return $this->messageText;
    }

    /**
     * @param string $messageText
     * @return InlineQueryResult
     */
    public function setMessageText($messageText)
    {
        $this->messageText = $messageText;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDisableWebPagePreview()
    {
        return $this->disableWebPagePreview;
    }

    /**
     * @param boolean $disableWebPagePreview
     * @return InlineQueryResult
     */
    public function setDisableWebPagePreview($disableWebPagePreview)
    {
        $this->disableWebPagePreview = $disableWebPagePreview;

        return $this;
    }

}