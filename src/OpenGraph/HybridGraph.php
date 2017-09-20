<?php

/**
 * Class for Hybrid Graph Info
 *
 * @package primeobsession/opengraph-io-php
 * @author Jonathan Vaughn
 * @version 1.0
 * @url : https://www.opengraph.io
 * @docs : https://www.opengraph.io/documentation/
 */

namespace OpenGraph;

class HybridGraph implements Arrayfier
{
    /**
     * Hybrid Graph title
     *
     * @var null|string
     */
    protected $title = null;

    /**
     * Hybrid Graph description
     *
     * @var null|string
     */
    protected $description = null;

    /**
     * Hybrid Graph type
     *
     * @var null|string
     */
    protected $type = null;

    /**
     * Hybrid Graph URL
     *
     * @var null|string
     */
    protected $url = null;

    /**
     * Hybrid Graph favicon
     *
     * @var null|string
     */
    protected $favicon = null;

    /**
     * Hybrid Graph site name
     *
     * @var null|string
     */
    protected $site_name = null;

    /**
     * Hybrid Graph image
     *
     * @var null|string
     */
    protected $image = null;

    /**
     * HybridGraph constructor.
     *
     * @param \stdClass $hybridGraph
     * @return HybridGraph
     */
    public function __construct($hybridGraph)
    {
        $this->title = $hybridGraph->title;
        $this->description = $hybridGraph->description;
        $this->type = $hybridGraph->type;
        $this->url = $hybridGraph->url;
        $this->favicon = $hybridGraph->favicon;
        $this->image = $hybridGraph->image;

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
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'url' => $this->url,
            'favicon' => $this->favicon,
            'image' => $this->image
        );
    }
}
