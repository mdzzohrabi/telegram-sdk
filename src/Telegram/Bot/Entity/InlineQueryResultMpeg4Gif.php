<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;


class InlineQueryResultMpeg4Gif extends InlineQueryResult
{


    protected $type = 'mpeg4_gif';

    /**
     * A valid URL for the MP4 file. File size must not exceed 1MB
     * @var string
     */
    protected $mpeg4Url;

    /**
     * Optional. Video width
     * @var int
     */
    protected $mpeg4Width;

    /**
     * Optional. Video height
     * @var int
     */
    protected $mpeg4Height;

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

    /**
     * InlineQueryResultMpeg4Gif constructor.
     *
     * @param $id
     * @param $mpeg4Url
     * @param $thumbUrl
     */
    public function __construct( $id , $mpeg4Url , $thumbUrl )
    {
        $this->id = $id;
        $this->thumbUrl = $thumbUrl;
        $this->mpeg4Url = $mpeg4Url;
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
     * @return InlineQueryResultMpeg4Gif
     */
    public function setDisableWebPagePreview($disableWebPagePreview)
    {
        $this->disableWebPagePreview = $disableWebPagePreview;

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
     * @return InlineQueryResultMpeg4Gif
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

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
     * @return InlineQueryResultMpeg4Gif
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * @return InlineQueryResultMpeg4Gif
     */
    public function setThumbUrl($thumbUrl)
    {
        $this->thumbUrl = $thumbUrl;

        return $this;
    }

    /**
     * @return int
     */
    public function getMpeg4Height()
    {
        return $this->mpeg4Height;
    }

    /**
     * @param int $mpeg4Height
     * @return InlineQueryResultMpeg4Gif
     */
    public function setMpeg4Height($mpeg4Height)
    {
        $this->mpeg4Height = $mpeg4Height;

        return $this;
    }

    /**
     * @return int
     */
    public function getMpeg4Width()
    {
        return $this->mpeg4Width;
    }

    /**
     * @param int $mpeg4Width
     * @return InlineQueryResultMpeg4Gif
     */
    public function setMpeg4Width($mpeg4Width)
    {
        $this->mpeg4Width = $mpeg4Width;

        return $this;
    }

    /**
     * @return string
     */
    public function getMpeg4Url()
    {
        return $this->mpeg4Url;
    }

    /**
     * @param string $mpeg4Url
     * @return InlineQueryResultMpeg4Gif
     */
    public function setMpeg4Url($mpeg4Url)
    {
        $this->mpeg4Url = $mpeg4Url;

        return $this;
    }

}