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
        $this->error = $openGraph->error;
        $this->title = $openGraph->title;
        $this->type = $openGraph->type;
        $this->admins = $openGraph->admins;
        $this->site_name = $openGraph->site_name;
        $this->image = $openGraph->image;
        $this->url = $openGraph->url;
        $this->description = $openGraph->description;

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
