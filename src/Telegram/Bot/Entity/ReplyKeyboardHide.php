<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;

/**
 * Class ReplyKeyboardHide
 *
 * Upon receiving a message with this object, Telegram clients will hide the current custom keyboard and display the default letter-keyboard. By default, custom keyboards are displayed until a new keyboard is sent by a bot. An exception is made for one-time keyboards that are hidden immediately after the user presses a button (see ReplyKeyboardMarkup).
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 * @see     https://core.telegram.org/bots/api#replykeyboardhide
 */
class ReplyKeyboardHide implements  ReplyInterface
{

    /**
     * Requests clients to hide the custom keyboard
     * @var true
     */
    protected $hideKeyboard = true;

    /**
     * Optional. Use this parameter if you want to hide keyboard for specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * @var bool
     */
    protected $selective;

    /**
     * @return true
     */
    public function getHideKeyboard()
    {
        return $this->hideKeyboard;
    }

    /**
     * @param true $hideKeyboard
     * @return ReplyKeyboardHide
     */
    public function setHideKeyboard($hideKeyboard)
    {
        $this->hideKeyboard = $hideKeyboard;

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
     * @return ReplyKeyboardHide
     */
    public function setSelective($selective)
    {
        $this->selective = $selective;

        return $this;
    }



}