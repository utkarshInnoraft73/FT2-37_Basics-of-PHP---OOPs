<?php

require( "./FetchApi.php" );


/**
 * Create a class of fields.
 */
class Field
{
    /**
     * @param Private String data type.
     * Store the field image url.
     */
    private $fieldImage;

    /**
     * @param Private string type of data; 
     * Store the title of field.
     */
    private $fieldTitle;

    /**
     * @param Private string type data.
     * Store the link of self explornation.
     */
    private $alias;

    /**
     * @param Private string type of data.
     * Store the services links of the field in the format of HTML.
     */
    private $fieldService;

    /**
     * @param Private string type of data.
     * Store the icons links of the field.
     */
    private $fieldIcons;

    /**
     * 
     * Create the constructor for setting the values.
     * 
     * @param fieldImage : String.
     * Store the image URL for a particular service field.
     * @param fieldTitle : String.
     * Store the title for a particular service in the format of html.
     * @param alias : String.
     * Store the URL for more detail about a particular service. 
     * @param fieldService : String.
     * Store the services URLs for the particular service in the format of html. 
     * @param fieldIcons : String.
     * Store the Icons URL for the particular service.
     */

    function __construct( $fieldImage, $fieldTitle, $alias, $fieldService, $fieldIcons)
    {

        $this->fieldImage = $fieldImage;
        $this->fieldTitle = $fieldTitle;
        $this->alias = $alias;    
        $this->fieldService = $fieldService;
        $this->fieldIcons = $fieldIcons;
    }

    /**
     * Getting the fieldImage.
     * @return fieldImage.
     */
    function getFieldImage()
    {
        return $this->fieldImage;
    }

    /**
     * Getting the field title.
     * @return fieldTitle.
     */
    function getFieldTitle()
    {
        return $this->fieldTitle;
    }

    /**
     * Getting the alias.
     * @return alias.
     */
    function getAlias()
    {
        return $this->alias;
    }

    /**
     * getting the field services.
     * @return fieldServices.
     */
    function getFieldService()
    {
        return $this->fieldService;
    }
    
    /**
     * getting the field icons.
     * @return fieldIcons.
     */
    function getFieldIcons()
    {
        return $this->fieldIcons;
    }
    
    /**
     * getting the length of field icons.
     * @return fieldIcons.
     */
    function getFieldIconsLen()
    {
        return count($this->fieldIcons);
    }
}