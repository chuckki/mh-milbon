<?php

$strName = 'tl_content';

$GLOBALS['TL_DCA'][$strName]['palettes']['productelement'] = '{type_legend},type,headline;{text_legend},text;{image_legend},addImage;{accordion_legend},headline1,text1,headline2,text2,headline3,text3;
{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop;';


$GLOBALS['TL_DCA'][$strName]['palettes']['productlist'] = '{type_legend},type,headline;{article_list_legend},is_regimen,product_list;{protected_legend:hide},protected;{expert_legend:hide},cssID,space';


$GLOBALS['TL_DCA'][$strName]['palettes']['complementary_collections'] = '{type_legend},type,headline;{article_list_legend},chosen_collections;{protected_legend:hide},protected;{expert_legend:hide},cssID,space';


$GLOBALS['TL_DCA'][$strName]['fields']['chosen_collections'] = array(
    'label'                   => array('Komplementär Kollektionen'),
    'inputType'               => 'checkboxWizard',
    'options'                  => array
                                    (
                                        'Smooth',
                                        'Moisture',
                                        'Repair'
                                    ),
    'sql'                     => "blob NULL",                                    
    'eval'                    => array('multiple'=>true, 'tl_class'=>'clr')
);  




$GLOBALS['TL_DCA'][$strName]['fields']['is_regimen'] = array(
			'label'                   => array('Kur-Produkte'),
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default ''"
		);


$GLOBALS['TL_DCA'][$strName]['fields']['text1'] = array(
			'label'                   => array('Accordion 1'),
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>false, 'rte'=>'tinyMCE', 'helpwizard'=>false),
			'explanation'             => 'insertTags',
			'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA'][$strName]['fields']['text2'] = array(
			'label'                   => array('Accordion 2'),
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>false, 'rte'=>'tinyMCE', 'helpwizard'=>false),
			'explanation'             => 'insertTags',
			'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA'][$strName]['fields']['text3'] = array(
			'label'                   => array('Accordion 3'),
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>false, 'rte'=>'tinyMCE', 'helpwizard'=>false),
			'explanation'             => 'insertTags',
			'sql'                     => "mediumtext NULL"
);


$GLOBALS['TL_DCA'][$strName]['fields']['headline1'] = array(
			'label'                   => array('Accordion 1 - Headline'),
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>200),
			'sql'                     => "varchar(255) NOT NULL default ''"
);


$GLOBALS['TL_DCA'][$strName]['fields']['headline2'] = array(
    'label'                   => array('Accordion 2 - Headline'),
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'text',
    'eval'                    => array('maxlength'=>200),
    'sql'                     => "varchar(255) NOT NULL default ''"
);


$GLOBALS['TL_DCA'][$strName]['fields']['headline3'] = array(
			'label'                   => array('Accordion 3 - Headline'),
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>200),
			'sql'                     => "varchar(255) NOT NULL default ''"
);



$GLOBALS['TL_DCA']['tl_content']['fields']['product_list'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['product_list'],
    'exclude'                 => true,
    'inputType'               => 'checkboxWizard',
    'options_callback'        => array('milbonProduct', 'getProducts'),
    'eval'                    => array
    (
        'mandatory'		=> false,
        'multiple'		=> true,
        'fieldType'		=> 'checkbox'
    ),
    'sql'                     => "blob NULL",

);



class milbonProduct extends Backend
{

    public function getProducts(DataContainer $dc)
    {

        $objStyleSheet = $this->Database->prepare("SELECT a.id, a.headline, b.tag, b.id as tagID FROM tl_content a join tl_tag b on a.id=b.tid WHERE type='productelement' and invisible != 1 ORDER BY b.tag")
            ->execute($intPid);

        if ($objStyleSheet->numRows < 1) {
            return array();
        }

        $return = array();

        while ($objStyleSheet->next()) {
            $return[$objStyleSheet->id] = $objStyleSheet->tag ." :: ". deserialize($objStyleSheet->headline)['value'];
        }


        return $return;
    }
}