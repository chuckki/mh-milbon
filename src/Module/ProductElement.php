<?php

// classes/elements/ContentProduct.php
namespace  Chuckki\MilbonBundle\Module;

/**
 * Class ContentProduct
 * @package esitcontent\classes\elements
 */
class ProductElement extends \ContentElement
{

    /**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_product_element';

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
        $this->Template->wildcard   = "### ProductElement ###";
    }

    /**
     * Erzeugt die Ausgebe für das Frontend.
     * @return string
     */
    private function genFeOutput(){
        if ($this->cssImage == ''){
            return '';
        }
        $objFile = \FilesModel::findByUuid($this->cssImage);
        if ($objFile === null){
            if (!\Validator::isUuid($this->cssImage)){
                return '<p class="error">'.$GLOBALS['TL_LANG']['ERR']['version2format'].'</p>';
            }
            return '';
        }
        if (!is_file(TL_ROOT . '/' . $objFile->path)){
            return '';
        }
        $this->Template->href = $objFile->path;

        $this->Template->addImage = false;
        // Add an image
        if ($this->addImage && $this->singleSRC != ''){
            $objModel = \FilesModel::findByUuid($this->singleSRC);
            if ($objModel === null){
                if (!\Validator::isUuid($this->singleSRC)){
                    $this->Template->text = '<p class="error">'.$GLOBALS['TL_LANG']['ERR']['version2format'].'</p>';
                }
            }
            elseif (is_file(TL_ROOT . '/' . $objModel->path)){
                $this->singleSRC = $objModel->path;
                $this->addImageToTemplate($this->Template, $this->arrData);
            }
        }
    }
}
