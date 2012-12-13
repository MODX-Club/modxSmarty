<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_ph($params, & $smarty)
{
    if(!isset($params['name']) OR !$name = $params['name']){return;}
    return $smarty->modx->getPlaceholder($name);
}

?>