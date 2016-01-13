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

}