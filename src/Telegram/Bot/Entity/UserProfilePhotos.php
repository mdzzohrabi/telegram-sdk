<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;

/**
 * Class UserProfilePhotos
 * This object represent a user's profile pictures.
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class UserProfilePhotos
{
    /**
     * Total number of profile pictures the target user has
     * @var int
     */
    protected $totalCount;

    /**
     * Requested profile pictures (in up to 4 sizes each)
     * @var PhotoSize[][]
     */
    protected $photos;

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }

    /**
     * @param int $totalCount
     * @return UserProfilePhotos
     */
    public function setTotalCount($totalCount)
    {
        $this->totalCount = $totalCount;

        return $this;
    }

    /**
     * @return PhotoCollection[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param PhotoCollection[] $photos
     * @return UserProfilePhotos
     */
    public function setPhotos($photos)
    {
        $this->photos = $photos;

        return $this;
    }}