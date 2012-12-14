<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_link($params, & $smarty)
{
    if(!isset($params['id']) OR !$id = $params['id']){return;}
    return $smarty->modx->makeUrl($id);
}

?>