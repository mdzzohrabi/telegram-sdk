<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;


/**
 * Class ChosenInlineResult
 *
 * @see https://core.telegram.org/bots/api#choseninlineresult
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class ChosenInlineResult
{

    /** @var  string */
    protected $resultId;

    /** @var  User */
    protected $from;

    /** @var  string */
    protected $query;

    /**
     * @return string
     */
    public function getResultId()
    {
        return $this->resultId;
    }

    /**
     * @param string $resultId
     * @return ChosenInlineResult
     */
    public function setResultId($resultId)
    {
        $this->resultId = $resultId;

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
     * @return ChosenInlineResult
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string $query
     * @return ChosenInlineResult
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

}