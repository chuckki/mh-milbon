<?php

namespace Chuckki\MilbonBundle\Module;


//$GLOBALS['TL_CTE']['milbon']['productelement'] 				= ProductElement::class;
$GLOBALS['TL_CTE']['milbon']['productelement'] 				= 'Chuckki\MilbonBundle\Module\ProductElement';
$GLOBALS['TL_CTE']['milbon']['productlist']    				= 'Chuckki\MilbonBundle\Module\ProductList';
$GLOBALS['TL_CTE']['milbon']['complementary_collections']   = ComplementaryList::class;
$GLOBALS['FE_MOD']['miscellaneous']['pageTitle']        	= ModulePageTitle::class;


//$GLOBALS['TL_HOOKS']['prepareFormData'][] = array('modshair\classes\elements\uploadRenameClass', 'renamePrepareFormData');
/*
$GLOBALS['TL_HOOKS']['prepareFormData'][] = array('uploadRenameClass', 'renamePrepareFormData');
*/
