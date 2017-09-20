<?php

/**
 * Open Graph Exception class to handle all open graph exceptions
 *
 * @package primeobsession/opengraph-io-php
 * @author Jonathan Vaughn
 * @version 1.0
 * @url : https://www.opengraph.io
 * @docs : https://www.opengraph.io/documentation/
 */

namespace OpenGraph;

use Exception;

class OpenGraphException extends Exception
{
    /**
     * Exception code
     *
     * @var int $code
     */
    protected $code;

    /**
     * Exception message
     *
     * @var string $message
     */
    protected $message;

    /**
     * HttpBadRequestException constructor.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct($message = "", $code = null)
    {
        parent::__construct($message, $code);
    }

    /**
     * Set exception code
     *
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Set exception message
     *
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}
