<?php

/**
 * Open Graph Request Info
 *
 * @package primeobsession/opengraph-io-php
 * @author Jonathan Vaughn
 * @version 1.0
 * @url : https://www.opengraph.io
 * @docs : https://www.opengraph.io/documentation/
 */

namespace OpenGraph;

class RequestInfo implements Arrayfier
{
    /**
     * Request Info redirect URLs
     *
     * @var null|string
     */
    protected $redirects = null;

    /**
     * Request Info redirect host
     *
     * @var null|string
     */
    protected $host = null;

    /**
     * RequestInfo constructor.
     *
     * @param \stdClass $requestInfo
     * @return RequestInfo
     */
    public function __construct($requestInfo)
    {
        $this->redirects = $requestInfo->redirects;
        $this->host = $requestInfo->host;

        return $this;
    }

    /**
     * Magic method to obtain class properties
     *
     * @param $name
     * @return mixed
     */
    public function __get($name) {
        return $this->$name;
    }

    /**
     * Implementation of Arrayfier Interface
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'redirects' => $this->redirects,
            'host' => $this->host
        );
    }
}
