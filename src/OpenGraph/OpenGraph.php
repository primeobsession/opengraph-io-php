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
    /** base url of api **/
    protected static $base_url      = "https://opengraph.io/api/";
    /** api version **/
    protected static $api_version   = "1.1";
    /** url to hit variable **/
    protected static $url_to_hit    = "";
    /** setting up api key and site url **/
    function __construct($api_key_usr = NULL, $site_url = NULL, $cache_ok = NULL , $full_render = NULL)
    {
        /**debugging**/
        // echo $api_key_usr;
        // echo "<br/>";
        // echo $site_url;
        // echo "<br/>";
        // echo $cache_ok;
        // echo "<br/>";
        // echo $full_render;
        // echo "<br/>";
        // echo gettype($cache_ok);
        // exit();
        /**debugging**/
        if (strlen($api_key_usr) && strlen($site_url)) {
            define('API_KEY', $api_key_usr);
            define('SITE_URL', $site_url);
            if ($cache_ok == 1 || strlen($cache_ok)) {
                if (gettype($cache_ok) == "boolean") {
                    define('CACHE_OK', true);
                } else {
                    throw new Exception("Error in argument passing! Cache ok type should be of boolean");
                }
            }
            if ($full_render == 1 || strlen($full_render)) {
                if (gettype($full_render) == "boolean") {
                    define('FULL_RENDER', true);
                } else {
                    throw new Exception("Error in argument passing! Full render type should be of boolean");
                }
            }
        } else {
            throw new Exception("Sorry ! Missing Params either Api key or Site URL");
        }
    }
    /** set up url to request through api **/
    public function formUrl() {
        if (defined('API_KEY') && defined('SITE_URL')) {
            /** cache ok defined **/
            if (defined('CACHE_OK')) {
                if (defined('FULL_RENDER')) {
                    /** cache ok defined full render defined **/
                    self::$url_to_hit = self::$base_url.self::$api_version.'/site/'.urlencode(SITE_URL).'?cache_ok=true&full_render=true&app_id='.API_KEY;
                } else {
                    /** only cache ok defined **/
                    self::$url_to_hit = self::$base_url.self::$api_version.'/site/'.urlencode(SITE_URL).'?cache_ok=true&app_id='.API_KEY;
                }
            } else {
                /** cache ok not defined full render defined **/
                if (defined('FULL_RENDER')) {
                    self::$url_to_hit = self::$base_url.self::$api_version.'/site/'.urlencode(SITE_URL).'?full_render=true&app_id='.API_KEY;
                } else {
                    /** neither full render nor cache ok defined**/
                    self::$url_to_hit = self::$base_url.self::$api_version.'/site/'.urlencode(SITE_URL).'?app_id='.API_KEY;
                }
            }
        } else {
            throw new Exception("Sorry ! Missing Params either Api key or Site URL");
        }
        return self::$url_to_hit;
    }
    /** scrap site content through api call  **/
    public static function scrapSiteContents() {
        $get_api_url = self::formUrl();
        // Get cURL resource
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $get_api_url,
            CURLOPT_USERAGENT => 'Requesting to opengraph-api'
        ));
        if(curl_exec($curl)){
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            // Close request to clear up some resources
            curl_close($curl);
            if (self::isJson($resp) || self::isJson($resp) == 1) {
                return json_encode(array(
                    'status' => true,
                    'status_code' => 200,
                    'response' => json_decode($resp, true)
                ));
            } else {
                return json_encode(array(
                    'status' => false,
                    'status_code' => 400,
                    'response' => 'Sorry! Bad Request'
                ));
            }
        } else {
            throw new Exception('Sorry! Error processing request: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
            // Close request to clear up some resources
            curl_close($curl);
        }
    }
    /** check an object is json or not php >= 5.3.0 only **/
    public static function isJson($json_str = NULL) {
        if ($json_str) {
            return is_string($json_str) && is_array(json_decode($json_str, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
        } else {
            return false;
        }
    }
    /** get hybrid graph title **/
    public static function getTitle($json_str = NULL , $is_arr = false) {
        if ($is_arr || $is_arr == 1) {
           if ($json_str) {
               $json_arr = json_decode(json_encode($json_str), true);
               if (array_key_exists('hybridGraph', $json_arr)) {
                   if (array_key_exists('title', $json_arr['hybridGraph'])) {
                       return $json_arr['hybridGraph']['title'];
                   } else {
                        return NULL;
                   }
               } else {
                    return NULL;
               }
           } else {
                throw new Exception("Invalid object has been passed", 1);
           }
        } else {
            if (self::isJson($json_str) || self::isJson($json_str) == 1) {
                $json_to_arr =  json_decode($json_str, true);
                if (array_key_exists('hybridGraph', $json_to_arr)) {
                    if (array_key_exists('title', $json_to_arr['hybridGraph'])) {
                        return $json_to_arr['hybridGraph']['title'];
                    } else {
                        return NULL;
                    }
                } else {
                    return NULL;
                }
            } else {
                throw new Exception("Invalid Json String", 1);
            }
        }
    }
    /** get hybrid graph description **/
    public static function getDescription($json_str = NULL, $is_arr = false) {
        if ($is_arr || $is_arr == 1) {
            if ($json_str) {
               $json_arr = json_decode(json_encode($json_str), true);
               if (array_key_exists('hybridGraph', $json_arr)) {
                   if (array_key_exists('description', $json_arr['hybridGraph'])) {
                       return $json_arr['hybridGraph']['description'];
                   } else {
                        return NULL;
                   }
               } else {
                    return NULL;
               }
           } else {
                throw new Exception("Invalid object has been passed", 1);
           }
        } else {
            if (self::isJson($json_str) || self::isJson($json_str) == 1) {
                $json_to_arr =  json_decode($json_str, true);
                if (array_key_exists('hybridGraph', $json_to_arr)) {
                    if (array_key_exists('description', $json_to_arr['hybridGraph'])) {
                        return $json_to_arr['hybridGraph']['description'];
                    } else {
                        return NULL;
                    }
                } else {
                    return NULL;
                }
            } else {
                throw new Exception("Invalid Json String", 1);
            }
        }
    }
    /** get hybrid graph image **/
    public static function getImage($json_str = NULL, $is_arr = false) {
        if ($is_arr || $is_arr == 1) {
            if ($json_str) {
               $json_arr = json_decode(json_encode($json_str), true);
               if (array_key_exists('hybridGraph', $json_arr)) {
                   if (array_key_exists('image', $json_arr['hybridGraph'])) {
                       return $json_arr['hybridGraph']['image'];
                   } else {
                        return NULL;
                   }
               } else {
                    return NULL;
               }
           } else {
                throw new Exception("Invalid object has been passed", 1);
           }
        } else {
            if (self::isJson($json_str) || self::isJson($json_str) == 1) {
                $json_to_arr =  json_decode($json_str, true);
                if (array_key_exists('hybridGraph', $json_to_arr)) {
                    if (array_key_exists('image', $json_to_arr['hybridGraph'])) {
                        return $json_to_arr['hybridGraph']['image'];
                    } else {
                        return NULL;
                    }
                } else {
                    return NULL;
                }
            } else {
                throw new Exception("Invalid Json String", 1);
            }
        }
    }
}