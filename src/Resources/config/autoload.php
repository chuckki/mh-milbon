<?php


// config/autoload.php
/**
 * Variables
 */
$strFolder      = 'milbon';
$strNamespace   = 'milbon';

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	$strNamespace
));

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Elements
    'milbon\\classes\\elements\\ProductElement' 	=> "system/modules/milbon/classes/elements/ProductElement.php",
    'milbon\\classes\\elements\\ProductList'    	=> "system/modules/milbon/classes/elements/ProductList.php",
    'milbon\\classes\\elements\\ComplementaryList'  => "system/modules/milbon/classes/elements/ComplementaryList.php",
	'milbon\\classes\\elements\\ModulePageTitle'   	=> "system/modules/milbon/classes/elements/ModulePageTitle.php",
    'milbon\\classes\\elements\\PageTitle'          => "system/modules/milbon/classes/elements/PageTitle.php",


));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'ce_product_element'        => "system/modules/milbon/templates",
    'ce_product_list'           => "system/modules/milbon/templates",
    'ce_product_regimen'        => "system/modules/milbon/templates",
    'ce_product_complementary'  => "system/modules/milbon/templates",
	'mod_pagetitle'             => "system/modules/milbon/templates",    
));