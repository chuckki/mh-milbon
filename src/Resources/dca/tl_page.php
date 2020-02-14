<?php

/**
 * pageimage Extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2009-2014, terminal42 gmbh
 * @author     terminal42 gmbh <info@terminal42.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/terminal42/contao-pageimage
 */


/**
 * Palettes
 */
foreach ($GLOBALS['TL_DCA']['tl_page']['palettes'] as $name => $palette)
{
    if ($name == '__selector__') {
        continue;
    }

    $GLOBALS['TL_DCA']['tl_page']['palettes'][$name] = str_replace('{meta_legend}', '{collections_legend:hide},collectionsTitel,collectionsText;{meta_legend}', $palette);
 /*   $GLOBALS['TL_DCA']['tl_page']['fields']['type']['eval']['gallery_types'][] = $name;*/
}


$GLOBALS['TL_DCA']['tl_page']['fields']['collectionsTitel'] = array
(
    'label'         => array("Kollektionstitel"),
    'inputType'     => 'text',
    'exclude'       => true,
    'eval'          => array('maxlength'=>255, 'tl_class'=>'w50'),
    'sql'           => "varchar(255) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_page']['fields']['collectionsText'] = array
(
    'label'         => array("Kollektionsbeschreibung"),
    'inputType'     => 'text',
    'exclude'       => true,
    'eval'          => array('maxlength'=>255, 'tl_class'=>'w50'),
    'sql'           => "varchar(255) NOT NULL default ''",
);
