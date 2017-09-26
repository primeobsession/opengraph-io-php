<?php

/**
 * Class for HTML Inferred Info
 *
 * @package primeobsession/opengraph-io-php
 * @author Jonathan Vaughn
 * @version 1.0
 * @url : https://www.opengraph.io
 * @docs : https://www.opengraph.io/documentation/
 */

namespace OpenGraph;

class HtmlInferred implements Arrayfier
{
    /**
     * HTML Inferred title
     *
     * @var null|string
     */
    protected $title = null;

    /**
     * HTML Inferred description
     *
     * @var null|string
     */
    protected $description = null;

    /**
     * HTML Inferred type
     *
     * @var null|string
     */
    protected $type = null;

    /**
     * HTML Inferred URL
     *
     * @var null|string
     */
    protected $url = null;

    /**
     * HTML Inferred favicon
     *
     * @var null|string
     */
    protected $favicon = null;

    /**
     * HTML Inferred site name
     *
     * @var null|string
     */
    protected $site_name = null;

    /**
     * HTML Inferred images
     *
     * @var array
     */
    protected $images = [];

    /**
     * HTML Inferred image guess
     *
     * @var null|string
     */
    protected $image_guess = null;

    /**
     * HtmlInferred constructor.
     *
     * @param \stdClass $htmlInferred
     * @return HtmlInferred
     */
    public function __construct($htmlInferred)
    {
        $this->title = property_exists($htmlInferred, 'title') ? $htmlInferred->title : null;
        $this->description = property_exists($htmlInferred, 'description') ? $htmlInferred->description : null;
        $this->type = property_exists($htmlInferred, 'type') ? $htmlInferred->type : null;
        $this->url = property_exists($htmlInferred, 'url') ? $htmlInferred->url : null;
        $this->favicon = property_exists($htmlInferred, 'favicon') ? $htmlInferred->favicon : null;
        $this->site_name = property_exists($htmlInferred, 'site_name') ? $htmlInferred->site_name : null;
        $this->images = property_exists($htmlInferred, 'images') ? $htmlInferred->images : null;
        $this->image_guess = property_exists($htmlInferred, 'image_guess') ? $htmlInferred->image_guess : null;

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
            'site_name' => $this->site_name,
            'images' => $this->images,
            'image_guess' => $this->image_guess,
        );
    }
}
