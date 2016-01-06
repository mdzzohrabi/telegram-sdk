<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;

/**
 * Class ForceReply
 *
 * Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if the user has selected the bot‘s message and tapped ’Reply'). This can be extremely useful if you want to create user-friendly step-by-step interfaces without having to sacrifice privacy mode.
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 * @see     https://core.telegram.org/bots/api#forcereply
 */
class ForceReply implements ReplyInterface
{

    /**
     * Shows reply interface to the user, as if they manually selected the bot‘s message and tapped ’Reply'
     * @var true
     */
    protected $forceReply = true;

    /**
     * Optional.
     * Use this parameter if you want to force reply from specific users only. Targets: 1)
     * users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id),
     * sender of the original message.
     *
     * @var bool
     */
    protected $selective = false;

    /**
     * @return true
     */
    public function getForceReply()
    {
        return $this->forceReply;
    }

    /**
     * @param true $forceReply
     * @return ForceReply
     */
    public function setForceReply($forceReply)
    {
        $this->forceReply = $forceReply;

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
     * @return ForceReply
     */
    public function setSelective($selective)
    {
        $this->selective = $selective;

        return $this;
    }

}