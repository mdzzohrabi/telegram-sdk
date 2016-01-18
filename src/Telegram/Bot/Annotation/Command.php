<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Annotation;

/**
 * Class Command
 *
 * @package Telegram\Bot\Annotation
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 * @Annotation
 */
class Command
{

    /**
     * Command name
     * @var string
     */
    public $name;

    /**
     * Command description
     * @var string
     */
    public $description;

    /**
     * @var bool
     */
    public $selfDecide = false;

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return boolean
     */
    public function isSelfDecide()
    {
        return $this->selfDecide;
    }

}