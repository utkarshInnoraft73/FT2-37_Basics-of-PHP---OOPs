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
     * Private string type data.
     * Stores the api url.
     */
    
    public $url;

    /**
     * Create a constructor for setting the url.
     */
    
     function __construct($url)
     {
        $this->url = $url;
     }

    /**
     * Public method to calling the api.
     * @param api         The api.
     * @return data       The data geting after the calling.
     */

    function apiCall()
    {
        $client = new Client();
        $response = $client->request('GET', $this->url);

        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            return json_decode($body, true);
        } else {
            echo "Bad HTTP request";
        }
    }
}
