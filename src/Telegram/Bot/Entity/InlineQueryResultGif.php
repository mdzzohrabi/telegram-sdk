<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;

/**
 * Class InlineQueryResultGif
 *
 * Represents a link to an animated GIF file. By default,
 * this animated GIF file will be sent by the user with optional caption.
 * Alternatively, you can provide message_text to send it instead of the animation.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultgif
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class InlineQueryResultGif extends InlineQueryResult
{

    protected $type = 'gif';

    /**
     * A valid URL for the GIF file. File size must not exceed 1MB
     * @var string
     */
    protected $gifUrl;

    /**
     * Optional. Width of the GIF
     * @var int
     */
    protected $gifWidth;

    /**
     * Optional. Height of the GIF
     * @var int
     */
    protected $gifHeight;

    /**
     * URL of the static thumbnail for the result (jpeg or gif)
     * @var string
     */
    protected $thumbUrl;

    /**
     * Optional. Short description of the result
     * @var string
     */
    protected $description;

    /**
     * Optional. Caption of the photo to be sent, 0-200 characters
     * @var string
     */
    protected $caption;

    /**
     * Optional. Disables link previews for links in the sent message
     * @var bool
     */
    protected $disableWebPagePreview;

    public function __construct( $id , $gifUrl , $thumbUrl )
    {
        $this->id = $id;
        $this->gifUrl = $gifUrl;
        $this->thumbUrl = $thumbUrl;
    }

    /**
     * @return string
     */
    public function getGifUrl()
    {
        return $this->gifUrl;
    }

    /**
     * @param string $gifUrl
     * @return InlineQueryResultGif
     */
    public function setGifUrl($gifUrl)
    {
        $this->gifUrl = $gifUrl;

        return $this;
    }

    /**
     * @return int
     */
    public function getGifWidth()
    {
        return $this->gifWidth;
    }

    /**
     * @param int $gifWidth
     * @return InlineQueryResultGif
     */
    public function setGifWidth($gifWidth)
    {
        $this->gifWidth = $gifWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getGifHeight()
    {
        return $this->gifHeight;
    }

    /**
     * @param int $gifHeight
     * @return InlineQueryResultGif
     */
    public function setGifHeight($gifHeight)
    {
        $this->gifHeight = $gifHeight;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbUrl()
    {
        return $this->thumbUrl;
    }

    /**
     * @param string $thumbUrl
     * @return InlineQueryResultGif
     */
    public function setThumbUrl($thumbUrl)
    {
        $this->thumbUrl = $thumbUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return InlineQueryResultGif
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * @return InlineQueryResultGif
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

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
     * @return InlineQueryResultGif
     */
    public function setDisableWebPagePreview($disableWebPagePreview)
    {
        $this->disableWebPagePreview = $disableWebPagePreview;

        return $this;
    }

}