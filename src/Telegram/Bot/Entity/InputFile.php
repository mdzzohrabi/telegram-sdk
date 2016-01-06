<?php
/**
 * (c) Masoud Zohrabi <mdzzohrabi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Telegram\Bot\Entity;

use Telegram\TelegramSDKException;

/**
 * Class InputFile
 *
 * This object represents the contents of a file to be uploaded.
 * Must be posted using multipart/form-data in the usual way that files are uploaded via the browser.
 *
 * @package Telegram\Bot\Entity
 * @author  Masoud Zohrabi <mdzzohrabi@gmail.com>
 */
class InputFile
{
    /**
     * @var string The path to the file on the system.
     */
    protected $path;

    /**
     * @var resource The stream pointing to the file.
     */
    protected $stream;

    /**
     * Creates a new InputFile entity.
     *
     * @param string $filePath
     *
     * @throws TelegramSDKException
     */
    public function __construct($filePath)
    {
        $this->path = $filePath;
    }

    /**
     * Return the name of the file.
     *
     * @return string
     */
    public function getFileName()
    {
        return basename($this->path);
    }

    /**
     * Opens file stream.
     *
     * @throws TelegramSDKException
     *
     * @return resource
     */
    public function open()
    {
        if (is_resource($this->path)) {
            return $this->path;
        }
        if (!$this->isRemoteFile() && !is_readable($this->path)) {
            throw new TelegramSDKException('Failed to create InputFile entity. Unable to read resource: '.$this->path.'.');
        }
        return fopen($this->path, 'r');
    }
    /**
     * Returns true if the path to the file is remote.
     *
     * @return bool
     */
    protected function isRemoteFile()
    {
        return preg_match('/^(https?|ftp):\/\/.*/', $this->path) === 1;
    }
}