<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_config($params, & $smarty)
{   
    if (!isset($params['name']) OR !$name = $params['name']) { return; }
    if(!empty($params['assign'])){
        $assign = (string)$params['assign'];
    }
    $output = $smarty->modx->getOption($name, null);
    
    if(!empty($assign)){
        $smarty->assign($assign, $output);
        return;
    }
    
    // else
    return $output;
}

?>