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
        $this->_id = $response->_id;
        $this->_v = $response->_v;
        $this->url = $response->url;
        $this->hybridGraph = new HybridGraph($response->hybridGraph);
        $this->openGraph = new OpenGraph($response->openGraph);
        $this->htmlInferred = new HtmlInferred($response->htmlInferred);
        $this->requestInfo = new RequestInfo($response->requestInfo);
        $this->accessed = $response->accessed;
        $this->updated = new DateTime($response->updated);
        $this->created = new DateTime($response->created);
        $this->version = $response->version;

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
