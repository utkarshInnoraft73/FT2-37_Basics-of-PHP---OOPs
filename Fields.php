<?php

require("./FetchApi.php");


/**
 * Create a class of fields.
 */
class Field
{

    /**
     * Private interger type data.
     * Store id.
     */
    private $id;

    /**
     * Private String data.
     * Store the field image url.
     */
    private $fieldImage;

    /**
     * Private string type of data; 
     * Store the title of field.
     */
    private $fieldTitle;

    /**
     * Private string type data.
     * Store the link of self explornation.
     */
    private $alias;

    /**
     * Private string type of data.
     * Store the services links of the field.
     */
    private $fieldService;

    /**
     * 
     * Create the constructor for setting the values.
     */

    function __construct($id, $fieldImage, $fieldTitle, $alias, $fieldService, )
    {
        $this->id = $id;
        $this->fieldImage = $fieldImage;
        $this->fieldTitle = $fieldTitle;
        $this->alias = $alias;
        $this->fieldService = $fieldService;
    }

    /**
     * Getting the id.
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * Getting the fieldImage.
     */
    function getFieldImage()
    {
        return $this->fieldImage;
    }

    /**
     * Getting the field title.
     */
    function getFieldTitle()
    {
        return $this->fieldTitle;
    }

    /**
     * Getting the alias.
     */
    function getAlias()
    {
        return $this->alias;
    }

    /**
     * getting the field services.
     */

    function getFieldService()
    {
        return $this->fieldService;
    }

    /**
     * Getting the icon link array.
     */
}
function fieldServices()
{
    $fieldArray = [];

    $arr_body = (new FetchApi('https://www.innoraft.com/jsonapi/node/services'))->apiCall();
    $i = 0;
    foreach ($arr_body['data'] as $data) {
        $baseUrl = "https://www.innoraft.com";
        if (($data['attributes']['field_secondary_title']) != NULL) {
            $fieldTitle = $data['attributes']['field_secondary_title']['value'];
            $fieldService =  $data['attributes']['field_services']['value'];
            $fieldImage = $baseUrl . (new FetchApi($data['relationships']['field_image']['links']['related']['href']))->apiCall()['data']['attributes']['uri']['url'];
            $alias = $baseUrl . $data['attributes']['path']['alias'];
            
        }

        $i = $i+$i;

        $obj = new Field($i, $fieldImage, $fieldTitle, $alias, $fieldService);
        $fieldArray[] = $obj;
    }

    return $fieldArray;
}
