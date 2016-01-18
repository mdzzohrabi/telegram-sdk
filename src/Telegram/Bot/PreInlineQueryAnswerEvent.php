<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot;

use Telegram\Bot\Entity\InlineQueryResult;

/**
 * Class PreInlineQueryAnswerEvent
 *
 * @package Telegram\Bot
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class PreInlineQueryAnswerEvent
{

    /** @var  string */
    protected $inlineQueryId;

    /** @var  InlineQueryResult[] */
    protected $results;

    /** @var  int */
    protected $cacheTime;

    /** @var  bool */
    protected $isPersonal;

    /** @var  int */
    protected $nextOffset;

    public function __construct( $inlineQueryId , $results , $cacheTime , $isPersonal , $nextOffset )
    {
        $this->inlineQueryId = $inlineQueryId;
        $this->results = $results;
        $this->cacheTime = $cacheTime;
        $this->isPersonal = $isPersonal;
        $this->nextOffset = $nextOffset;
    }

    /**
     * @return string
     */
    public function getInlineQueryId()
    {
        return $this->inlineQueryId;
    }

    /**
     * @param string $inlineQueryId
     * @return PreInlineQueryAnswerEvent
     */
    public function setInlineQueryId($inlineQueryId)
    {
        $this->inlineQueryId = $inlineQueryId;

        return $this;
    }

    /**
     * @return Entity\InlineQueryResult[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param Entity\InlineQueryResult[] $results
     * @return PreInlineQueryAnswerEvent
     */
    public function setResults($results)
    {
        $this->results = $results;

        return $this;
    }

    /**
     * @return int
     */
    public function getCacheTime()
    {
        return $this->cacheTime;
    }

    /**
     * @param int $cacheTime
     * @return PreInlineQueryAnswerEvent
     */
    public function setCacheTime($cacheTime)
    {
        $this->cacheTime = $cacheTime;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsPersonal()
    {
        return $this->isPersonal;
    }

    /**
     * @param boolean $isPersonal
     * @return PreInlineQueryAnswerEvent
     */
    public function setIsPersonal($isPersonal)
    {
        $this->isPersonal = $isPersonal;

        return $this;
    }

    /**
     * @return int
     */
    public function getNextOffset()
    {
        return $this->nextOffset;
    }

    /**
     * @param int $nextOffset
     * @return PreInlineQueryAnswerEvent
     */
    public function setNextOffset($nextOffset)
    {
        $this->nextOffset = $nextOffset;

        return $this;
    }



}