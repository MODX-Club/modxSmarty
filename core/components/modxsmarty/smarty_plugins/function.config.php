<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_config($params, & $smarty)
{   
    if(!isset($params['name']) OR !$name = $params['name']){return;}
    return $smarty->modx->getOption($name, null);
}

?>