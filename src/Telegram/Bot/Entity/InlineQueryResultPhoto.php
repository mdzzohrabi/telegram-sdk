<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;

/**
 * Class InlineQueryResultPhoto
 *
 * Represents a link to a photo. By default, this photo will be sent by the user with optional caption.
 * Alternatively, you can provide message_text to send it instead of photo.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultphoto
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class InlineQueryResultPhoto extends InlineQueryResult
{

    protected $type = 'photo';

    /**
     * A valid URL of the photo. Photo must be in jpeg format. Photo size must not exceed 5MB
     * @var string
     */
    protected $photoUrl;

    /**
     * Optional. Width of the photo
     * @var int
     */
    protected $photoWidth;

    /**
     * Optional. Height of the photo
     * @var int
     */
    protected $photoHeight;

    /**
     * URL of the thumbnail for the photo
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

    public function __construct( $id , $photoUrl , $thumbUrl )
    {
        $this->id = $id;
        $this->photoUrl = $photoUrl;
        $this->thumbUrl = $thumbUrl;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return InlineQueryResultPhoto
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhotoUrl()
    {
        return $this->photoUrl;
    }

    /**
     * @param string $photoUrl
     * @return InlineQueryResultPhoto
     */
    public function setPhotoUrl($photoUrl)
    {
        $this->photoUrl = $photoUrl;

        return $this;
    }

    /**
     * @return int
     */
    public function getPhotoWidth()
    {
        return $this->photoWidth;
    }

    /**
     * @param int $photoWidth
     * @return InlineQueryResultPhoto
     */
    public function setPhotoWidth($photoWidth)
    {
        $this->photoWidth = $photoWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getPhotoHeight()
    {
        return $this->photoHeight;
    }

    /**
     * @param int $photoHeight
     * @return InlineQueryResultPhoto
     */
    public function setPhotoHeight($photoHeight)
    {
        $this->photoHeight = $photoHeight;

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
     * @return InlineQueryResultPhoto
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
     * @return InlineQueryResultPhoto
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
     * @return InlineQueryResultPhoto
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
     * @return InlineQueryResultPhoto
     */
    public function setDisableWebPagePreview($disableWebPagePreview)
    {
        $this->disableWebPagePreview = $disableWebPagePreview;

        return $this;
    }



}