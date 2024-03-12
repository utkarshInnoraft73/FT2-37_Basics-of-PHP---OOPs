<?php

require( "./FetchApi.php" );


/**
 * Create a class of fields.
 */
class Field
{
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
     * Private string type of data.
     * Store the icons links of the field.
     */
    private $fieldIcons;

    /**
     * 
     * Create the constructor for setting the values.
     */

    function __construct( $fieldImage, $fieldTitle, $alias, $fieldService, $fieldIcons)
    {

        $this->fieldImage = $fieldImage;        // Respective image of particular service.
        $this->fieldTitle = $fieldTitle;        // Title of the particular field.
        $this->alias = $alias;                  // Url of the respective service.
        $this->fieldService = $fieldService;    // Url of all the services provided by a service.
        $this->fieldIcons = $fieldIcons;
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
     * getting the field icons.
     */
    function getFieldIcons()
    {
        return $this->fieldIcons;
    }
    
    /**
     * getting the length of field icons.
     */
    function getFieldIconsLen()
    {
        return count($this->fieldIcons);
    }
}