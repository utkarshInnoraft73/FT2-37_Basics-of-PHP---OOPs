<?php
/**
 * Requirng the autoload file.
 */

require_once "vendor/autoload.php";
use GuzzleHttp\Client;

/*
* Creating a class of apiCall.
*/

class FetchApi
{
    /**
     * @param string type data.
     * Stores the api url.
     */
    public $url;

    /**
     * Create a constructor for setting the url.
     */
     function __construct($url) {
        /**
         * Set the url.
         */
        $this->url = $url;
     }

    /**
     * Public method to calling the api.
     * @param api        
     *  The api.
     * @return data     
     * After calling api.
     */
    function apiCall()
    {
        /**
         * Create instace of class Client.
         */
        $client = new Client();
        /**
         * Get request to the api.
         */ 
        $response = $client->request('GET', $this->url);
        /**
         * Checking if the response status is 200 or not.
         * If true @return data.
         * else print msg. 
         */
        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            return json_decode($body, true);
        } 
        else {
            echo "Bad HTTP request";
        }
    }
}
