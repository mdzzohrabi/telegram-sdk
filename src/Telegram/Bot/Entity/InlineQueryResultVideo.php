<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;

/**
 * Class InlineQueryResultVideo
 *
 * Represents link to a page containing an embedded video player or a video file.
 *
 * @see     https://core.telegram.org/bots/api#inlinequeryresultvideo
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class InlineQueryResultVideo extends InlineQueryResult
{


    protected $type = 'video';

    /**
     * A valid URL for the embedded video player or video file
     * @var string
     */
    protected $videoUrl;

    /**
     * Mime type of the content of video url, “text/html” or “video/mp4”
     * @var string
     */
    protected $mimeType;

    /**
     * Optional. Width of the video
     * @var int
     */
    protected $videoWidth;

    /**
     * Optional. Height of the video
     * @var int
     */
    protected $videoHeight;

    /**
     * Optional. Video duration in seconds
     * @var int
     */
    protected $videoDuration;

    /**
     * URL of the thumbnail (jpeg only) for the video
     * @var string
     */
    protected $thumbUrl;

    /**
     * Optional. Short description of the result
     * @var string
     */
    protected $description;


    public function __construct( $id , $title , $messageText , $videoUrl , $mimeType , $thumbUrl )
    {
        $this->id = $id;
        $this->thumbUrl = $thumbUrl;
        $this->title = $title;
        $this->messageText = $messageText;
        $this->videoUrl = $videoUrl;
        $this->mimeType = $mimeType;
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
     * @return InlineQueryResultVideo
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getVideoUrl()
    {
        return $this->videoUrl;
    }

    /**
     * @param string $videoUrl
     * @return InlineQueryResultVideo
     */
    public function setVideoUrl($videoUrl)
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     * @return InlineQueryResultVideo
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * @return int
     */
    public function getVideoWidth()
    {
        return $this->videoWidth;
    }

    /**
     * @param int $videoWidth
     * @return InlineQueryResultVideo
     */
    public function setVideoWidth($videoWidth)
    {
        $this->videoWidth = $videoWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getVideoHeight()
    {
        return $this->videoHeight;
    }

    /**
     * @param int $videoHeight
     * @return InlineQueryResultVideo
     */
    public function setVideoHeight($videoHeight)
    {
        $this->videoHeight = $videoHeight;

        return $this;
    }

    /**
     * @return int
     */
    public function getVideoDuration()
    {
        return $this->videoDuration;
    }

    /**
     * @param int $videoDuration
     * @return InlineQueryResultVideo
     */
    public function setVideoDuration($videoDuration)
    {
        $this->videoDuration = $videoDuration;

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
     * @return InlineQueryResultVideo
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
     * @return InlineQueryResultVideo
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

}