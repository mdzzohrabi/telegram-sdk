<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;

use Telegram\Collection;

/**
 * Class PhotoCollection
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class PhotoCollection extends Collection
{

    /**
     * @var PhotoSize[]
     */
    protected $items = array();

    /**
     * @param mixed $offset
     * @return PhotoSize
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }

    /**
     * @return PhotoSize
     */
    public function current()
    {
        return parent::current();
    }

}