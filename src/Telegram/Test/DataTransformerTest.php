<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Test;

use DateTime;
use Telegram\Bot\Entity\Chat;
use Telegram\Bot\Entity\Message;
use Telegram\Bot\Entity\PhotoSize;
use Telegram\Bot\Entity\UserProfilePhotos;
use Telegram\DataTransformer;

class Fixture {

    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var DateTime */
    protected $expiresAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param DateTime $expiresAt
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }

}

/**
 * Class DataTransformerTest
 *
 * @package Telegram\Test
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class DataTransformerTest extends \PHPUnit_Framework_TestCase
{

    public function testTransform() {

        /** @var Message $message */
        $message = DataTransformer::transform( [
            'message_id'   => 12,
            'from'  => [
                'id'    => 10
            ],
            'reply_to_message' => [
                'message_id'    => 10
            ]
        ] , Message::class );

        $this->assertEquals( 12 , $message->getMessageId() );
        $this->assertEquals( 10 , $message->getFrom()->getId() );
        $this->assertEquals( 10 , $message->getReplyToMessage()->getMessageId() );

        /** @var UserProfilePhotos $userProfilePhotos */
        $userProfilePhotos = DataTransformer::transform([
            'total_count'   => 2,
            'photos'        => [
                [
                    [ 'file_id'   => 1 ],
                    [ 'file_id'   => 2 ]
                ]
            ]
        ],UserProfilePhotos::class);

        $this->assertEquals( 1, $userProfilePhotos->getPhotos()[0][0]->getFileId() );


        /** @var Fixture $fixture */
        $fixture = DataTransformer::transform([
            'id'    => '10',
            'name'  => 'Alireza',
            'expires_at'    => '2015-09-09'
        ] , Fixture::class );

        $this->assertEquals( 10 , $fixture->getId() );
        $this->assertEquals( 'Alireza' , $fixture->getName() );
        $this->assertInstanceOf( DateTime::class , $fixture->getExpiresAt() );
        $this->assertEquals( 9 , $fixture->getExpiresAt()->format('m') );

        /** @var Fixture $fixture */
        $fixture = DataTransformer::transform([
            'expires_at'    => false
        ] , Fixture::class );

        $this->assertNull( $fixture->getExpiresAt() );

        /** @var Fixture $fixture */
        $fixture = DataTransformer::transform([
            'expires_at'    => null
        ] , Fixture::class );

        $this->assertNull( $fixture->getExpiresAt() );


    }

    function testSerialize() {

        $object = new Message();
        $object->setMessageId( 12 );
        $chat = new Chat();
        $chat->setFirstName('Masoud');
        $object->setChat( $chat );

        $serialized = DataTransformer::serialize( $object );

        $this->assertEquals([
            'message_id'    => 12,
            'chat'          => [
                'first_name'    => 'Masoud'
            ]
        ],  $serialized );

        $object = new UserProfilePhotos();
        $object->setTotalCount( 5 );
        $object->setPhotos([
            (new PhotoSize())->setFileId(10),
            (new PhotoSize())->setFileId(20)
        ]);

        $this->assertEquals([
            'total_count'   => 5,
            'photos'        => [
                [ 'file_id' => 10 ],
                [ 'file_id' => 20 ]
            ]
        ], DataTransformer::serialize( $object ) );

        $object = new Fixture();
        $object->setExpiresAt( new DateTime() );
        $serialized = DataTransformer::serialize( $object );

        $this->assertEquals( date('c') , $serialized['expires_at'] );

    }

}