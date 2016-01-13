<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Response
 *
 * @package Telegram
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class Response
{

    /**
     * Response status code
     * @var int
     */
    protected $statusCode;

    /**
     * Response body
     * @var string
     */
    protected $body;

    /**
     * Response headers
     * @var array
     */
    protected $headers = array();

    /**
     * @var array
     */
    protected $decodedBody = array();

    /**
     * Response constructor.
     *
     * @param ResponseInterface $response
     */
    public function __construct( $response )
    {

        if ( $response instanceof ResponseInterface ) {

            $this->statusCode = $response->getStatusCode();
            $this->body = $response->getBody();
            $this->headers = $response->getHeaders();

        }

        $this->decodedBody = json_decode( $this->body , true );

    }

    /**
     * @return array
     */
    public function getDecodedBody()
    {
        return $this->decodedBody;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Status code
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Response is ok ?
     *
     * @return bool
     */
    public function isError() {
        return isset( $this->decodedBody['ok'] ) && $this->decodedBody['ok'] === false;
    }

    /**
     * Response result
     *
     * @return array
     */
    public function getResult() {
        return isset( $this->decodedBody['result'] ) ? $this->decodedBody['result'] : [];
    }

    /**
     * Response description
     *
     * @return null
     */
    public function getDescription() {
        return isset( $this->decodedBody['description'] ) ? $this->decodedBody['description'] : null;
    }

}