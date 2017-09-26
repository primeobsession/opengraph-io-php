<?php

/**
 * Class for Open Graph Info
 *
 * @package primeobsession/opengraph-io-php
 * @author Jonathan Vaughn
 * @version 1.0
 * @url : https://www.opengraph.io
 * @docs : https://www.opengraph.io/documentation/
 */

namespace OpenGraph;

class OpenGraph implements Arrayfier
{
    /**
     * Open Graph error
     *
     * @var null|string
     */
    protected $error = null;

    /**
     * Open Graph title
     *
     * @var null|string
     */
    protected $title = null;

    /**
     * Open Graph type
     *
     * @var null|string
     */
    protected $type = null;

    /**
     * Open Graph admins
     *
     * @var null|string
     */
    protected $admins = null;

    /**
     * Open Graph site name
     *
     * @var null|string
     */
    protected $site_name = null;

    /**
     * Open Graph image
     *
     * @var null|string
     */
    protected $image = null;

    /**
     * Open Graph URL
     *
     * @var null|string
     */
    protected $url = null;

    /**
     * Open Graph description
     *
     * @var null|string
     */
    protected $description = null;

    /**
     * OpenGraph constructor.
     *
     * @param \stdClass $openGraph
     * @return OpenGraph
     */
    public function __construct($openGraph)
    {
        $this->error = property_exists($openGraph, 'error') ? $openGraph->error : null;
        $this->title = property_exists($openGraph, 'title') ? $openGraph->title : null;
        $this->type = property_exists($openGraph, 'type') ? $openGraph->type : null;
        $this->admins = property_exists($openGraph, 'admins') ? $openGraph->admins : null;
        $this->site_name = property_exists($openGraph, 'site_name') ? $openGraph->site_name : null;
        $this->image = property_exists($openGraph, 'image') ? $openGraph->image : null;
        $this->url = property_exists($openGraph, 'url') ? $openGraph->url : null;
        $this->description = property_exists($openGraph, 'description') ? $openGraph->description : null;

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
            'error' => $this->error,
            'title' => $this->title,
            'type' => $this->type,
            'admins' => $this->admins,
            'site_name' => $this->site_name,
            'image' => $this->image,
            'url' => $this->url,
            'description' => $this->description
        );
    }
}
