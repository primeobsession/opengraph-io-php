<?php

/**
 * Open Graph Response class to wrap a opengraph.io API response into object
 *
 * @package primeobsession/opengraph-io-php
 * @author Jonathan Vaughn
 * @version 1.0
 * @url : https://www.opengraph.io
 * @docs : https://www.opengraph.io/documentation/
 */

namespace OpenGraph;

use DateTime;

class OpenGraphResponse implements Arrayfier
{
    /**
     * Open Graph Response ID
     *
     * @var null
     */
    protected $_id = null;

    /**
     * Open Graph Response version
     *
     * @var null|string
     */
    protected $_v = null;

    /**
     * Open Graph Response URL
     *
     * @var null|string
     */
    protected $url = null;

    /**
     * Open Graph Response Hybrid Graph Node
     *
     * @var null|HybridGraph
     */
    protected $hybridGraph = null;

    /**
     * Open Graph Response Open Graph Node
     *
     * @var null|OpenGraph
     */
    protected $openGraph = null;

    /**
     * Open Graph Response HTML Inferred Node
     *
     * @var null|HtmlInferred
     */
    protected $htmlInferred = null;

    /**
     * Open Graph Response Request Info Node
     *
     * @var null|RequestInfo
     */
    protected $requestInfo = null;

    /**
     * Open Graph Response accessed count
     *
     * @var null|int
     */
    protected $accessed = null;

    /**
     * Open Graph Response updated date time
     *
     * @var DateTime|null
     */
    protected $updated = null;

    /**
     * Open Graph Response created date time
     *
     * @var DateTime|null
     */
    protected $created = null;

    /**
     * Open Graph Response API version
     *
     * @var null|string
     */
    protected $version = null;

    /**
     * OpenGraph constructor.
     *
     * @param \stdClass $response
     * @return OpenGraphResponse
     */
    public function __construct($response)
    {
        $this->_id = property_exists($response, 'id') ? $response->_id : null;
        $this->_v = property_exists($response, '_v') ? $response->_v : null;
        $this->url = property_exists($response, 'url') ? $response->url : null;
        $this->hybridGraph = property_exists($response, 'hybridGraph')? new HybridGraph($response->hybridGraph) : null;
        $this->openGraph = property_exists($response, 'openGraph')
            ? new OpenGraph($response->openGraph) : null;
        $this->htmlInferred = property_exists($response, 'htmlInferred')
            ? new HtmlInferred($response->htmlInferred) : null;
        $this->requestInfo = property_exists($response, 'requestInfo')
            ? new RequestInfo($response->requestInfo) : null;
        $this->accessed = property_exists($response, 'accessed') ? $response->accessed : null;
        $this->updated = property_exists($response, 'updated') ? new DateTime($response->updated) : null;
        $this->created = property_exists($response, 'created') ? new DateTime($response->created) : null;
        $this->version = property_exists($response, 'version') ? $response->version : null;

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
    public function toArray() {
        return array(
            '_id' => $this->_id,
            '_v' => $this->_v,
            'url' => $this->url,
            'hybridGraph' => $this->hybridGraph->toArray(),
            'openGraph' => $this->openGraph->toArray(),
            'htmlInferred' => $this->htmlInferred->toArray(),
            'requestInfo' => $this->requestInfo->toArray(),
            'accessed' => $this->accessed,
            'updated' => $this->updated,
            'created' => $this->created,
            'version' => $this->version
        );
    }
}
