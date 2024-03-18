<?php
/**
 * Requirng the autoload file.
 */

require_once "vendor/autoload.php";
use GuzzleHttp\Client;

/*
* Creating a class of apiCall.
*/
class FetchApi {
    /**
     * @param string.
     *   Stores the api url.
     */
    public $url;

    /**
     * Create a constructor for setting the url.
     */
     function __construct(string $url) {
        /**
         * @param url.
         *   Api URL.
         */
        $this->url = $url;
     }

    /**
     * Public method o calling the api.
     * @param api        
     *   The api.
     * 
     * @return Object.   
     *   Returns the data after fetching data.
     */
    function apiCall() {
        /**
         * Create instace of class Client.
         */
        $client = new Client();
        /**
         * Get request to the api.
         */ 
        $response = $client->request('GET', $this->url);

        //Check if the api response status is 200 or not.
        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            return json_decode($body, TRUE);
        } 
        else {
            echo "Bad HTTP request";
        }
    }
}
