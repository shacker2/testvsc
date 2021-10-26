<?php
include(dirname(__FILE__).'/../../config/config.inc.php');
if(_PS_VERSION_ < "1.5.0.0"){
include(dirname(__FILE__).'/../../header.php');
require_once(dirname(__FILE__).'/alldownloads.php');
global $params;
$alldownloads = new alldownloads();
echo $alldownloads->displayFrontForm($params);
}
if(_PS_VERSION_ > "1.5.0.0")
{
	if(_PS_VERSION_ > "1.5.0.0" && _PS_VERSION_ < "1.5.4.0"){@include_once(dirname(__FILE__).'/../../header.php');}

include(dirname(__FILE__).'/alldownloads.php');






$errors = array();

	global $params;

// init front controller in order to use Tools::redirect
$controller=new FrontController();
$alldownloads = new AllDownloads();
Tools::redirect(Context::getContext()->link->getModuleLink('alldownloads', 'default'));
	
	}
?>