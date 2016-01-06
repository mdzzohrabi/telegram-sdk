<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot;

use Telegram\Collection;

class Commands extends Collection
{

    /**
     * @var Command[]
     */
    protected $items = array();

    /**
     * Add command
     *
     * @param Command $command
     * @return $this
     */
    public function addCommand( Command $command ) {
        $this->items[] = $command;
        return $this;
    }

    /**
     * @param array|Command[] $commands
     * @return $this
     */
    public function addCommands( array $commands ) {
        foreach ( $commands as $command )
            $this->items[] = $command;
        return $this;
    }

    /**
     * Find command by name
     *
     * @param $name
     * @return null|Command
     */
    public function getCommand( $name ) {
        foreach ( $this->items as $command )
            if ( $command->getName() == $name || $command->getAlias() == $name )
                return $command;
        return null;
    }

    /**
     * @return Command[]
     */
    public function getCommands() {
        return $this->items;
    }

}