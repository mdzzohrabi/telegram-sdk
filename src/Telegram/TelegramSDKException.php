<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram;

use Exception;

class TelegramSDKException extends Exception
{

    public function __construct( $message )
    {

        $args    = func_get_args();
        $message = call_user_func_array( 'sprintf' , $args );

        parent::__construct ($message, 0 , null );
    }

}