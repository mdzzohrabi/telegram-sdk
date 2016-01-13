<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot;


use Telegram\Bot\Entity\Update;

class UpdateEvent
{

    /**
     * @var Update
     */
    protected $update;

    /**
     * @var bool
     */
    protected $propagationStopped = false;

    /**
     * UpdateEvent constructor.
     *
     * @param Update $update
     */
    public function __construct( Update $update )
    {
        $this->update = $update;
    }

    /**
     * @return boolean
     */
    public function isPropagationStopped()
    {
        return $this->propagationStopped;
    }

    public function stopPropagation() {
        $this->propagationStopped = true;
    }

    /**
     * @return Update
     */
    public function getUpdate()
    {
        return $this->update;
    }

}