<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;

/**
 * Class ReplyKeyboardMarkup
 *
 * This object represents a custom keyboard with reply options (see Introduction to bots for details and examples).
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 * @see     https://core.telegram.org/bots/api#replykeyboardmarkup
 */
class ReplyKeyboardMarkup implements ReplyInterface
{

    /**
     * Array of button rows, each represented by an Array of Strings
     * @var string[][]
     */
    protected $keyboard;

    /**
     * Optional.
     * Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons).
     * Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     *
*@var bool
     */
    protected $resizeKeyboard;

    /**
     * Optional. Requests clients to hide the keyboard as soon as it's been used. Defaults to false.
     * @var bool
     */
    protected $oneTimeKeyboard;

    /**
     * Optional.
     * Use this parameter if you want to show the keyboard to specific users only. Targets: 1)
     * users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id),
     * sender of the original message.
     *
     * @var bool
     */
    protected $selective;

    /**
     * ReplyKeyboardMarkup constructor.
     *
     * @param array $keyboard
     * @param bool  $oneTime
     * @param bool  $autoSize
     */
    public function __construct( array $keyboard = array() , $oneTime = null , $autoSize = true )
    {
        $this->setKeyboard( $keyboard );
        $this->setResizeKeyboard( $autoSize );
        $this->setOneTimeKeyboard( $oneTime );
    }

    /**
     * @return \string[][]
     */
    public function getKeyboard()
    {
        return $this->keyboard;
    }

    /**
     * @param \string[][] $keyboard
     * @return ReplyKeyboardMarkup
     */
    public function setKeyboard($keyboard)
    {
        $this->keyboard = $keyboard;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isResizeKeyboard()
    {
        return $this->resizeKeyboard;
    }

    /**
     * @param boolean $resizeKeyboard
     * @return ReplyKeyboardMarkup
     */
    public function setResizeKeyboard($resizeKeyboard)
    {
        $this->resizeKeyboard = $resizeKeyboard;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isOneTimeKeyboard()
    {
        return $this->oneTimeKeyboard;
    }

    /**
     * @param boolean $oneTimeKeyboard
     * @return ReplyKeyboardMarkup
     */
    public function setOneTimeKeyboard($oneTimeKeyboard)
    {
        $this->oneTimeKeyboard = $oneTimeKeyboard;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isSelective()
    {
        return $this->selective;
    }

    /**
     * @param boolean $selective
     * @return ReplyKeyboardMarkup
     */
    public function setSelective($selective)
    {
        $this->selective = $selective;

        return $this;
    }


}