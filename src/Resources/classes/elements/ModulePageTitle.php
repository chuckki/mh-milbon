<?php
namespace milbon\classes\elements;

/**
 * pageimage Extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2009-2014, terminal42 gmbh
 * @author     terminal42 gmbh <info@terminal42.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/terminal42/contao-pageimage
 */


class ModulePageTitle extends \Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_pagetitle';


    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### PAGE IMAGE ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'typolight/main.php?do=modules&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        $strBuffer = parent::generate();

/*        echo "<pre>";
        print_r($this->Template);
        die();
*/

        if ($this->Template->src == '') {
            //die("2");
            //return '';

        }

        return $strBuffer;
    }


    protected function compile()
    {
        //return true;
        
        if ($this->defineRoot) {
            $objPage = \PageModel::findByPk($this->rootPage);
        } else {
            global $objPage;
        }

        if (null === $objPage) {
            die("1");
            return;
        }

        $intOffset = (int) $this->levelOffset;


        $arrImage = PageTitle::getOne($objPage, $intOffset, (bool) $this->inheritPageImage);

        if (null === $arrImage) {
            //die("2");
            //return;
        }
/*
        $arrSize = deserialize($this->imgSize);
        $arrImage['src'] = $this->getImage($arrImage['path'], $arrSize[0], $arrSize[1], $arrSize[2]);

        $this->Template->setData($arrImage);
        
        $picture = \Picture::create($arrImage['path'], $arrSize)->getTemplateData();
        $picture['alt'] = specialchars($arrImage['alt']);
        $this->Template->picture = $picture;

        if (($imgSize = @getimagesize(TL_ROOT . '/' . rawurldecode($arrImage['src']))) !== false) {
            $this->Template->size = ' ' . $imgSize[3];
        }
        */

        // Add page information to template
        global $objPage;
        $this->Template->currentPage = $objPage->row();
        $this->Template->collectionsTitel = $objPage->collectionsTitel;
        $this->Template->collectionsText = $objPage->collectionsText;
        $this->Template->title = $objPage->title;
        $this->Template->alias = $objPage->alias;   

    }
}
