<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_field($params, & $smarty)
{
    if(!isset($params['name']) OR !$name = $params['name']){return '';}
    $modx = & $smarty->modx; 
    if(!isset($modx->resource) || !is_object($modx->resource)){return '';}
    $field = $modx->resource->$name;
    if(is_string($field)){
        return $field;
    }
    return  '';
}

?>