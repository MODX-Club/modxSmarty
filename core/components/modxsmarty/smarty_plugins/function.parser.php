<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_parser($params, & $smarty)
{
    if(!isset($params['content']) OR !$output = $params['content']){return;}
    if(!empty($params['assign'])){
        $assign = (string)$params['assign'];
    }
    $modx = & $smarty->modx; 
    $modx->getParser(); 
    $options = array();
    $maxIterations= intval($modx->getOption('parser_max_iterations', $options, 10));
    $modx->parser->processElementTags('', $output, true, false, '[[', ']]', array(), $maxIterations);
    $modx->parser->processElementTags('', $output, true, true, '[[', ']]', array(), $maxIterations);
    return !empty($assign) ? $smarty->assign($assign, $output) : $output;
}

?>