<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Class RobotParser
 *
 * @package Telegram
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class RobotParser
{

    /** @var AnnotationReader */
    protected $annotationReader;

    public function __construct()
    {

        $vendorRootDir = __DIR__;

        while ( $vendorRootDir && !file_exists( $vendorRootDir . '/vendor/autoload.php' ) )
            $vendorRootDir = dirname( $vendorRootDir );


        if ( $vendorRootDir ) {

            /** @var \Composer\Autoload\ClassLoader $loader */
            $loader = include $vendorRootDir.'/vendor/autoload.php';

            AnnotationRegistry::registerLoader([$loader, 'loadClass']);

        }

        $this->annotationReader = new AnnotationReader();

    }

    public function getCommands( AbstractBot $bot ) {

        $result = [];

        foreach ( (new \ReflectionClass($bot))->getMethods() as $method )
            $result[ $method->getName() ] = $this->annotationReader->getMethodAnnotations( $method );

        return $result;

    }

}