<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;

/**
 * Class Message
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 * @see     https://core.telegram.org/bots/api#message
 */
class Message
{

    /**
     * Unique message identifier
     * @var int
     */
    protected $messageId;

    /**
     * Optional. Sender, can be empty for messages sent to channels
     * @var User
     */
    protected $from;

    /**
     * Date the message was sent in Unix time
     * @var int
     */
    protected $date;

    /**
     * Conversation the message belongs to
     * @var Chat
     */
    protected $chat;

    /**
     * Optional. For forwarded messages, sender of the original message
     * @var User
     */
    protected $forwardFrom;

    /**
     * Optional. For forwarded messages, date the original message was sent in Unix time
     * @var int
     */
    protected $forwardDate;

    /**
     * Optional. For replies, the original message.
     * Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
     *
     * @var Message
     */
    protected $replyToMessage;

    /**
     * Optional. For text messages, the actual UTF-8 text of the message
     * @var string
     */
    protected $text;

    /**
     * Optional. Message is an audio file, information about the file
     * @var Audio
     */
    protected $audio;

    /**
     * Optional. Message is a general file, information about the file
     * @var Document
     */
    protected $document;

    /**
     * Optional. Message is a photo, available sizes of the photo
     * @var PhotoSize[]
     */
    protected $photo;

    /**
     * Optional. Message is a sticker, information about the sticker
     * @var Sticker
     */
    protected $sticker;

    /**
     * Optional. Message is a video, information about the video
     * @var Video
     */
    protected $video;

    /**
     * Optional. Message is a voice message, information about the file
     * @var Voice
     */
    protected $voice;

    /**
     * Optional. Caption for the photo or video
     * @var string
     */
    protected $caption;

    /**
     * Optional. Message is a shared contact, information about the contact
     * @var Contact
     */
    protected $contact;

    /**
     * Optional. Message is a shared location, information about the location
     * @var Location
     */
    protected $location;

    /**
     * Optional. A new member was added to the group, information about them (this member may be the bot itself)
     * @var User
     */
    protected $newChatParticipant;

    /**
     * Optional. A member was removed from the group, information about them (this member may be the bot itself)
     * @var User
     */
    protected $leftChatParticipant;

    /**
     * Optional. A chat title was changed to this value
     * @var string
     */
    protected $newChatTitle;

    /**
     * Optional. A chat photo was change to this value
     * @var PhotoSize[]
     */
    protected $newChatPhoto;

    /**
     * Optional. Service message: the chat photo was deleted
     * @var bool
     */
    protected $deleteChatPhoto;

    /**
     * Optional. Service message: the group has been created
     * @var bool
     */
    protected $groupChatCreated;

    /**
     * Optional. Service message: the supergroup has been created
     * @var bool
     */
    protected $superGroupChatCreated;

    /**
     * Optional. Service message: the channel has been created
     * @var bool
     */
    protected $channelChatCreated;

    /**
     * Optional. The group has been migrated to a supergroup with the specified identifier, not exceeding 1e13 by absolute value
     * @var int
     */
    protected $migrateToChatId;

    /**
     * Optional. The supergroup has been migrated from a group with the specified identifier, not exceeding 1e13 by absolute value
     * @var int
     */
    protected $migrateFromChatId;

    /**
     * Spool id
     * @var string|null
     */
    protected $spoolId;

    /**
     * @return int
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param int $messageId
     * @return Message
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * @return User
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param User $from
     * @return Message
     */
    public function setFrom( User $from = null )
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return int
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param int $date
     * @return Message
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Chat
     */
    public function getChat()
    {
        return $this->chat;
    }

    /**
     * @param Chat $chat
     * @return Message
     */
    public function setChat( Chat $chat )
    {
        $this->chat = $chat;

        return $this;
    }

    /**
     * @return User
     */
    public function getForwardFrom()
    {
        return $this->forwardFrom;
    }

    /**
     * @param User $forwardFrom
     * @return Message
     */
    public function setForwardFrom( User $forwardFrom = null )
    {
        $this->forwardFrom = $forwardFrom;

        return $this;
    }

    /**
     * @return int
     */
    public function getForwardDate()
    {
        return $this->forwardDate;
    }

    /**
     * @param int $forwardDate
     * @return Message
     */
    public function setForwardDate($forwardDate)
    {
        $this->forwardDate = $forwardDate;

        return $this;
    }

    /**
     * @return Message
     */
    public function getReplyToMessage()
    {
        return $this->replyToMessage;
    }

    /**
     * @param Message $replyToMessage
     * @return Message
     */
    public function setReplyToMessage( Message $replyToMessage = null )
    {
        $this->replyToMessage = $replyToMessage;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Message
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return Audio
     */
    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * @param Audio $audio
     * @return Message
     */
    public function setAudio( Audio $audio = null )
    {
        $this->audio = $audio;

        return $this;
    }

    /**
     * @return Document
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param Document $document
     * @return Message
     */
    public function setDocument( Document $document = null )
    {
        $this->document = $document;

        return $this;
    }

    /**
     * @return PhotoSize[]
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param PhotoSize[] $photo
     * @return Message
     */
    public function setPhoto( array $photo = array() )
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Sticker
     */
    public function getSticker()
    {
        return $this->sticker;
    }

    /**
     * @param Sticker $sticker
     * @return Message
     */
    public function setSticker( Sticker $sticker = null )
    {
        $this->sticker = $sticker;

        return $this;
    }

    /**
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param Video $video
     * @return Message
     */
    public function setVideo( Video $video = null )
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return Voice
     */
    public function getVoice()
    {
        return $this->voice;
    }

    /**
     * @param Voice $voice
     * @return Message
     */
    public function setVoice( Voice $voice = null )
    {
        $this->voice = $voice;

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
     * @return Message
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     * @return Message
     */
    public function setContact( Contact $contact = null )
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Location $location
     * @return Message
     */
    public function setLocation( Location $location = null )
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return User
     */
    public function getNewChatParticipant()
    {
        return $this->newChatParticipant;
    }

    /**
     * @param User $newChatParticipant
     * @return Message
     */
    public function setNewChatParticipant( User $newChatParticipant = null )
    {
        $this->newChatParticipant = $newChatParticipant;

        return $this;
    }

    /**
     * @return User
     */
    public function getLeftChatParticipant()
    {
        return $this->leftChatParticipant;
    }

    /**
     * @param User $leftChatParticipant
     * @return Message
     */
    public function setLeftChatParticipant( User $leftChatParticipant = null )
    {
        $this->leftChatParticipant = $leftChatParticipant;

        return $this;
    }

    /**
     * @return string
     */
    public function getNewChatTitle()
    {
        return $this->newChatTitle;
    }

    /**
     * @param string $newChatTitle
     * @return Message
     */
    public function setNewChatTitle($newChatTitle)
    {
        $this->newChatTitle = $newChatTitle;

        return $this;
    }

    /**
     * @return PhotoSize[]
     */
    public function getNewChatPhoto()
    {
        return $this->newChatPhoto;
    }

    /**
     * @param PhotoSize[] $newChatPhoto
     * @return Message
     */
    public function setNewChatPhoto( array $newChatPhoto = array() )
    {
        $this->newChatPhoto = $newChatPhoto;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDeleteChatPhoto()
    {
        return $this->deleteChatPhoto;
    }

    /**
     * @param boolean $deleteChatPhoto
     * @return Message
     */
    public function setDeleteChatPhoto($deleteChatPhoto)
    {
        $this->deleteChatPhoto = $deleteChatPhoto;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isGroupChatCreated()
    {
        return $this->groupChatCreated;
    }

    /**
     * @param boolean $groupChatCreated
     * @return Message
     */
    public function setGroupChatCreated($groupChatCreated)
    {
        $this->groupChatCreated = $groupChatCreated;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isSuperGroupChatCreated()
    {
        return $this->superGroupChatCreated;
    }

    /**
     * @param boolean $superGroupChatCreated
     * @return Message
     */
    public function setSuperGroupChatCreated($superGroupChatCreated)
    {
        $this->superGroupChatCreated = $superGroupChatCreated;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isChannelChatCreated()
    {
        return $this->channelChatCreated;
    }

    /**
     * @param boolean $channelChatCreated
     * @return Message
     */
    public function setChannelChatCreated($channelChatCreated)
    {
        $this->channelChatCreated = $channelChatCreated;

        return $this;
    }

    /**
     * @return int
     */
    public function getMigrateToChatId()
    {
        return $this->migrateToChatId;
    }

    /**
     * @param int $migrateToChatId
     * @return Message
     */
    public function setMigrateToChatId($migrateToChatId)
    {
        $this->migrateToChatId = $migrateToChatId;

        return $this;
    }

    /**
     * @return int
     */
    public function getMigrateFromChatId()
    {
        return $this->migrateFromChatId;
    }

    /**
     * @param int $migrateFromChatId
     * @return Message
     */
    public function setMigrateFromChatId($migrateFromChatId)
    {
        $this->migrateFromChatId = $migrateFromChatId;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSpoolId()
    {
        return $this->spoolId;
    }

    /**
     * @param null|string $spoolId
     */
    public function setSpoolId($spoolId)
    {
        $this->spoolId = $spoolId;
    }

}