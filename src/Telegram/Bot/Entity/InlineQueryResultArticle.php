<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;

/**
 * Class InlineQueryResultArticle
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultarticle
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class InlineQueryResultArticle extends InlineQueryResult
{

    protected $type = 'article';

    /**
     * Optional. URL of the result
     * @var string
     */
    protected $url;

    /**
     * Optional. Pass True, if you don't want the URL to be shown in the message
     * @var bool
     */
    protected $hideUrl;

    /**
     * Optional. Short description of the result
     * @var string
     */
    protected $description;

    /**
     * Optional. Url of the thumbnail for the result
     * @var string
     */
    protected $thumbUrl;

    /**
     * Optional. Thumbnail width
     * @var int
     */
    protected $thumbWidth;

    /**
     * Optional. Thumbnail height
     * @var int
     */
    protected $thumbHeight;

    public function __construct( $id , $title , $messageText )
    {
        $this->id = $id;
        $this->title = $title;
        $this->messageText = $messageText;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return InlineQueryResultArticle
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isHideUrl()
    {
        return $this->hideUrl;
    }

    /**
     * @param boolean $hideUrl
     * @return InlineQueryResultArticle
     */
    public function setHideUrl($hideUrl)
    {
        $this->hideUrl = $hideUrl;

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
     * @return InlineQueryResultArticle
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
     * @return InlineQueryResultArticle
     */
    public function setThumbUrl($thumbUrl)
    {
        $this->thumbUrl = $thumbUrl;

        return $this;
    }

    /**
     * @return int
     */
    public function getThumbWidth()
    {
        return $this->thumbWidth;
    }

    /**
     * @param int $thumbWidth
     * @return InlineQueryResultArticle
     */
    public function setThumbWidth($thumbWidth)
    {
        $this->thumbWidth = $thumbWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getThumbHeight()
    {
        return $this->thumbHeight;
    }

    /**
     * @param int $thumbHeight
     * @return InlineQueryResultArticle
     */
    public function setThumbHeight($thumbHeight)
    {
        $this->thumbHeight = $thumbHeight;

        return $this;
    }

}