<?php
/**
* @author Jonathan Vaughn
* @organization Tier5
* @version 0.1
* opengraph.io package 
* url : https://www.opengraph.io
* Docs : https://www.opengraph.io/documentation/
**/
namespace OpenGraph;
use Exception;
class OpenGraph
{
    protected static $base_url      = "https://opengraph.io/api/";
    protected static $api_version   = "1.1";
    function __construct($api_key_usr = NULL)
    {
        //echo "pad";
        if (strlen($api_key_usr)) {
            define(API_KEY, $api_key_usr);
        } else {
            throw new Exception("Sorry ! Missing Api Key. Please provide an api key for opengraph");
        }
    }
    public static function getUrl() {
        if (defined('API_KEY')) {
            return self::$base_url.self::$api_version.'/site/your-sitename?app_id='.API_KEY;
        } else {
            throw new Exception("Sorry ! Missing Api Key. Please provide an api key for opengraph");
        }
    }
}