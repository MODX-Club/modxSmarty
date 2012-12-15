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
    if(isset($params['assign']) && $params['assign']){
        $assign = (string)$params['assign'];
    }
    $output = $smarty->modx->getPlaceholder($name);
    return $assign ? $smarty->assign($assign, $output) : $output;
}

?>