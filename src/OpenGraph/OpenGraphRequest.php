<?php

/**
 * Open Graph Request class to make a http request to opengraph.io API and fetch response
 *
 * @package primeobsession/opengraph-io-php
 * @author Jonathan Vaughn
 * @version 1.0
 * @url : https://www.opengraph.io
 * @docs : https://www.opengraph.io/documentation/
 */

namespace OpenGraph;

class OpenGraphRequest
{
    /**
     * Make an OpenGraph request
     *
     * @param string $url
     * @return mixed
     * @throws OpenGraphException
     */
    public function request($url)
    {
        if (strlen($url)) {
            if (gettype($url) == 'string') {
                $cURL = curl_init();
                curl_setopt_array($cURL, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_USERAGENT => 'Requesting to OpenGraph API...'
                ));
                $response = curl_exec($cURL);
                if ($response) {
                    /* Check response is JSON or not */
                    if ($this->isJson($response)) {
                        curl_close($cURL);
                        $decodedMessage = json_decode($response);
                        if ($decodedMessage->error->code == 101 && $decodedMessage->error->message == 'Invalid API Key')
                            throw new OpenGraphException("You have provided an invalid API key.");
                        else
                            return new OpenGraphResponse(json_decode($response));
                    } else {
                        curl_close($cURL);
                        throw new OpenGraphException("Response is not a JSON");
                    }
                }
            } else {
                throw new OpenGraphException("Error in argument passing! URL type should be of string type.");
            }
        } else {
            throw new OpenGraphException("URL is required.");
        }

        return null;
    }

    /**
     * Check an object is JSON or not
     *
     * @param null $stringifiedJSON
     * @return bool
     */
    public function isJson($stringifiedJSON = null)
    {
        if ($stringifiedJSON) {
            return is_string($stringifiedJSON)
            && is_array(json_decode($stringifiedJSON, true))
            && (json_last_error() == JSON_ERROR_NONE)
                ? true : false;
        } else {
            return false;
        }
    }
}
