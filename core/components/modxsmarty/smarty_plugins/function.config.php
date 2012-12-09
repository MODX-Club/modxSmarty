<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_config($scriptProperties, & $smarty)
{   
    return $smarty->modx->getOption($scriptProperties['name'], null);
}

?>