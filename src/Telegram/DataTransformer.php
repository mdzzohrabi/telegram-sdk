<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram;

/**
 * Class DataTransformer
 *
 * @package Telegram
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class DataTransformer
{

    protected static $namespaceUses = [];

    protected static $phpTypes = [ 'boolean' , 'bool' , 'integer' , 'int' , 'float' , 'string' , 'array' , 'object' , 'null' ];

    /**
     * @param   string    $class
     *
     * @return \ReflectionClass
     */
    protected static function getClassReflection( $class ) {
        return new \ReflectionClass( $class );
    }

    /**
     * @param  string   $class
     * @param  string   $property
     *
     * @return \ReflectionProperty
     */
    protected static function getPropertyReflection( $class , $property ) {
        return new \ReflectionProperty( $class , $property );
    }

    /**
     * @param $type
     * @return bool
     */
    protected static function isPhpType( $type ) {
        return in_array( $type , self::$phpTypes );
    }

    protected static function getPropertyType( \ReflectionProperty $property ) {

        $comment = $property->getDocComment();
        preg_match( '/\@var\s+((\w+)(\[\])*)/' , $comment , $types );
        $type = $types[1];

        // Class type
        if ( !self::isPhpType( $type ) ) {
            $type = self::qualifiedClass( $property->getDeclaringClass() , $type );
        }

        return $type;

    }

    protected static function qualifiedClass( \ReflectionClass $class , $type ) {

        if ( substr( $type , 0 , 1 ) == '\\' )
            return substr( $type , 1 );

        $classNamespace = $class->getNamespaceName();

        if ( !$uses = self::$namespaceUses[ $classNamespace ] ) {

            $scriptContent = file_get_contents($class->getFileName());
            $scriptContent = substr($scriptContent, strpos($scriptContent, 'namespace '.$class->getNamespaceName()));
            preg_match_all( "/use\\s+([a-z]+(\\\\[a-z]+)*);/i" , $scriptContent , $uses );

            if ( isset($uses[1]) )
                $uses = $uses[1];
            else
                $uses = [];

            $_temp = [];

            foreach ( $uses as $use ) {
                $parts = explode( '\\' , $use );
                $className = end($parts);
                $_temp[ $className ] = implode('\\',array_slice( $parts , 0 , -1 ));
            }

            $uses = $_temp;

            self::$namespaceUses[ $classNamespace ] = $uses;
        }

        if ( isset( $uses[ $type ] ) )
            $classNamespace = $uses[$type];

        return $classNamespace . '\\' . $type;


    }

    /**
     * Capitalize string
     *
     * <pre>
     * 		String::capitalize( "active" ) 		# => Active
     * </pre>
     *
     * @param  string $string String
     * @return string
     */
    public static function capitalize( $string ) {

        return strtoupper( $string[0] ) . strtolower( substr( $string , 1) );

    }

    /**
     * Underscore string
     *
     * @param  string $string 	String
     * @return string
     */
    public static function underscore( $string ) {

        if ( !preg_match( '/[A-Z-]|::/' , $string ) ) return $string;

        $string = strtr( $string , [ '::' => '/' , '-' => '_' ] );

        $string = preg_replace( '/([A-Z\d]+)([A-Z][a-z])/' , '$1_$2' , $string );

        $string = preg_replace( '/([a-z\d])([A-Z])/' , '$1_$2' , $string );

        return strtolower( $string );

    }

    /**
     * Camelize string
     *
     * <pre>
     * 		String::camelize( "active_record" ) 	# => ActiveRecord
     * 		String::camelize( "SSLSecure" )			# => SslSecure
     * </pre>
     *
     * @param  string  $string 	String
     * @param  boolean $upper 	Upper first letter
     * @return string
     */
    public static function camelize( $string , $upper = true ) {

        if ( $upper )
            $string = preg_replace_callback( '/^[a-z0-9]+/' , function( $find ){ return self::capitalize( $find[0] ); } , $string );
        else
            $string = preg_replace_callback( '/^[a-z0-9]+/' , function( $find ){ return strtolower( $find[0] ); } , $string );

        $string = preg_replace_callback( '/(_|\\/)([a-z0-9]+)/' , function( $find ){

            return self::capitalize( $find[2] );

        } , $string );

        $string = str_replace( '/' , '::' , $string );

        return $string;

    }

    /**
     * Transform array to Object
     *
     * @param   mixed       $data
     * @param   string      $class
     * @param   bool|int    $array
     * @return mixed
     * @throws TelegramSDKException
     */
    public static function transform( $data , $class , $array = false ) {

        if ( $data === null || $data === false || $data === true )
            return null;

        // Class reflection
        $reflect = self::getClassReflection( $class );
        // Class properties
        $properties = $reflect->getProperties();
        // Map underscore -> property
        $map = array();

        foreach ( $properties as $property ) {
            $map[ self::underscore( $property->getName() ) ] = array(
                'property'  => $property->getName(),
                'setter'    => 'set' . self::camelize( $property->getName() ),
                'getter'    => 'get' . self::camelize( $property->getName() ),
                'type'      => self::getPropertyType( $property )
            );
        }

        $items = [ $data ];

        // Result objects
        $objects = [];

        // Array deep level
        for ( $i = 0 ; $i < $array ; $i++ ) {
            $items = $items[0];
        }

        foreach ( $items as $item ) {

            if ( is_array( $item ) ) {

                // Create new class
                $object = new $class;

                foreach ($item as $key => $value) {

                    if (!isset($map[ $key ])) {
                        throw new TelegramSDKException(
                            'Class `%s` property `%s:%s` not found',
                            $class,
                            self::camelize($key, false),
                            self::underscore(self::camelize($key, false))
                        );
                    }

                    $property = $map[ $key ];
                    $type = $property['type'];

                    if (self::isPhpType($type)) {
                        settype($value, $property['type']);
                    } else {
                        $isArray = 0;
                        while (substr($type, -2, 2) == '[]') {
                            $isArray++;
                            $type = substr($type, 0, strlen($type) - 2);
                        }
                        $value = self::transform($value, $type, $isArray);
                    }

                    $object->{$property['setter']}($value);

                }

            } else {

                $object = new $class( $item );

            }

            $objects[] = $object;

        }

        for ( $i = 1 ; $i < $array ; $i++ )
           $objects = [ $objects ];

        return $array ? $objects : current( $objects );

    }

    /**
     * Serialize object
     *
     * @param      $object
     * @param bool $allowNull
     * @return array
     */
    public static function serialize( $object , $allowNull = false )
    {

        if (is_array($object)) {
            $result = [];
            foreach ( $object as $k => $v )
                $result[ $k ] = self::serialize( $v );
            return $result;
        } elseif ( !is_object($object) )
            return $object;
        else if ( $object instanceof \DateTime ) {
            return $object->format('c');
        }

        $reflect = self::getClassReflection( $object );
        $result  = [];

        foreach ( $reflect->getProperties() as $property ) {

            $camelized = self::camelize( $property->getName() );

            if ( !$reflect->hasMethod( $getter = 'get' . $camelized ) )
                if ( !$reflect->hasMethod( $getter = 'is' . $camelized ) )
                    continue;

            $value = $object->{$getter}();

            self::deepSerialize( $value , $allowNull );

            if ($allowNull || $value !== null )
                $result[ self::underscore( $property->getName() ) ] = $value;

        }

        return $result;

    }

    protected static function deepSerialize( &$value , $allowNull = false ) {

        if ( is_object( $value ) ) {
            $value = self::serialize( $value , $allowNull );
        } elseif ( is_array( $value ) ) {
            foreach ( $value as &$item )
                self::deepSerialize( $item , $allowNull );
        }

    }

}