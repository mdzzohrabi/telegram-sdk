<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Test;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Telegram\Bot\Entity\InlineQueryResultArticle;
use Telegram\DataTransformer;
use Telegram\Response;
use Telegram\TelegramBot;

/**
 * Class TelegramBotTest
 *
 * @package Telegram\Test
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class TelegramBotTest extends \PHPUnit_Framework_TestCase
{

    // MasoudDevBot
    const TOKEN = '176201674:AAF7H3NugaKjcdclObdK08npvkExZOI1ZPk';

    public function testGetMe() {

        $client = new Client([
            RequestOptions::VERIFY  => false
        ]);

        $bot = new TelegramBot( self::TOKEN , $client );

        $this->assertEquals( 'MasoudDevBot' , $bot->getMe()->getUsername() );

        $this->assertInstanceOf( Response::class , $bot->removeWebhook() );
        $this->assertFalse( $bot->removeWebhook()->isError() );

    }

    public function testInlineQuery() {

        /** @var TelegramBot|\PHPUnit_Framework_MockObject_MockObject $bot */
        $bot = $this
            ->getMockBuilder( TelegramBot::class )
            ->setConstructorArgs([ self::TOKEN ])
            ->setMethods([ 'post' ])
            ->getMock();

        $bot
            ->expects($this->atLeastOnce())
            ->method('post')
            ->willReturn( new Response( new \GuzzleHttp\Psr7\Response() ) )
        ;

        $this->assertEquals( self::TOKEN , $bot->getApiToken() );

        $bot->answerInlineQuery(
            1,
            [
                new InlineQueryResultArticle( 1 , 'Title' , 'Body' )
            ]
        );

    }

    public function testInlineResults() {

        $results = [
            new InlineQueryResultArticle( 1 , 'A' , 'B' )
        ];

        $res = DataTransformer::serialize( $results );

        $this->assertEquals( 'A', $res[0]['title'] );


    }

}