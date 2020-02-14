<?php

// classes/elements/ContentProduct.php
namespace  Chuckki\MilbonBundle\Module;

/**
 * Class ContentProduct
 * @package esitcontent\classes\elements
 */
class ComplementaryList extends \ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_product_complementary';

    /**
     * Compile the content element
     */
    protected function compile()
    {

        if (TL_MODE == 'BE') {
            $this->genBeOutput();
        } else {
            $this->genFeOutput();
        }
    }

    /**
     * Erzeugt die Ausgebe für das Backend.
     * @return string
     */
    private function genBeOutput(){
        $this->strTemplate          = 'be_wildcard';
        $this->Template             = new \BackendTemplate($this->strTemplate);
        $this->Template->title      = $this->headline;
        $this->Template->wildcard   = "### Komplementär Kollektionen ###";
    }

    /**
     * Erzeugt die Ausgebe für das Frontend.
     * @return string
     */
    private function genFeOutput(){

        $this->Template->chosen_collections = deserialize($this->chosen_collections);

    }

}
