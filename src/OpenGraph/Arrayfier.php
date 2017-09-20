<?php

/**
 * Arrayfier Interface to implement object to Array
 *
 * @package primeobsession/opengraph-io-php
 * @author Jonathan Vaughn
 * @version 1.0
 * @url : https://www.opengraph.io
 * @docs : https://www.opengraph.io/documentation/
 */

namespace OpenGraph;

interface Arrayfier
{
    /**
     * @return mixed
     */
    public function toArray();
}
