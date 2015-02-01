<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */
 
/*
использование: 

<link href="{lessphp file="css/style.less"}" rel="stylesheet" type="text/css"/>
*/
 
 
require_once dirname(__FILE__).'/lessphp/Less.php';


function smarty_function_lessphp($params, & $smarty)
{
    if(!isset($params['file']) OR !$file = $params['file'])
    	return;
	
	$modx=$smarty->modx;
	$template = $modx->getOption('modxSmarty.template', array(), 'default');
	$template_url = $modx->getOption('modxSite.template_url').$template.'/';
	$template_dir = MODX_ASSETS_PATH.'components/modxsite/templates/'.$template.'/';
	$less_fname=$template_dir.$file;
	
	$less_files = array( $less_fname => $template_url.'css/' );
	$options = array( 'cache_dir' => $template_dir.'cache/' , 'compress'=>true);
	return $template_url.'cache/'.Less_Cache::Get( $less_files, $options );
}

?>