<?php

// classes/elements/ContentProduct.php
namespace  Chuckki\MilbonBundle\Module;

/**
 * Class ContentProduct
 * @package esitcontent\classes\elements
 */
class ProductList extends \ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_product_list';

    /**
     * Compile the content element
     */
    protected function compile()
    {

        if($this->is_regimen == 1){
            $this->Template->setName('ce_product_regimen');
        }

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



        $selectedProducts = deserialize($this->product_list);


        if (is_array($selectedProducts))
        {
            $aproductList = $selectedProducts;
        }
        elseif (!empty($selectedProducts))
        {
            $aproductList = array($selectedProducts);
        }
        else
        {
            $aproductList = array();
        }

        //select b.*,a.type,a.id from tl_content a left join tl_tag b on a.id=b.tid where a.id=37;

        if (count($aproductList)) {
            $objPagesProducts = $this->Database->prepare("
			SELECT
				a.`id` as pid,
				a.`headline`,
				a.`type`,
				a.`singleSRC`,
				b.tag

			FROM
				tl_content a left join tl_tag b on a.id=b.tid
			WHERE
			    a.`type` = 'productelement' AND
				a.`id` IN (" . implode(',', $aproductList) . ")
			")->execute();
        }

        $prodTeaser = array();


        if ($objPagesProducts->numRows > 0) {

    		global $objPage;

    		$this->Template->isCategorie = false;
    		if($objPage->template == 'fe_page_kategorie'){
	    		$this->Template->isCategorie = true;
			}else{
	            switch ($objPagesProducts->numRows) {
	                case 2:
	                    $this->Template->counter = 6;
	                    break;
	                case 1:
	                case 4:
	                    $this->Template->counter = 3;
	                    break;
	                default:
	                case 3:
	                    $this->Template->counter = 4;
	                    break;
	            }
			}

            //$this->Template->counter = $objPagesProducts->numRows*3;

            while ($objPagesProducts->next()) {


                $contentObj = \ContentModel::findById($objPagesProducts->pid);
                $articleObj = \ArticleModel::findById($contentObj->pid);
                $pageObj = \PageModel::findById($articleObj->pid);


                $targetURL = $pageObj->getFrontendUrl();

                $prodImg = \FilesModel::findByUuid($objPagesProducts->singleSRC)->path;
                $prodTeaser[array_search($objPagesProducts->pid,$aproductList)] = array(
                    'imgSrc' => $prodImg,
                    'headline' => deserialize($objPagesProducts->headline)['value'],
                    'tag' => $objPagesProducts->tag,
                    'href' => $targetURL
                );

            }
        }
        ksort($prodTeaser);
        $this->Template->productList = $prodTeaser;
        $this->Template->headline = $this->headline;

        //echo "<pre>";
        //print_r($this->strTemplate);
        //die();

    }

}
