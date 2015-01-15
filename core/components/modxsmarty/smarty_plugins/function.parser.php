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
    $maxIterations= intval($modx->getOption('parser_max_iterations', $params, 10));
    $modx->parser->processElementTags('', $output, true, false, '[[', ']]', array(), $maxIterations);
    $modx->parser->processElementTags('', $output, true, true, '[[', ']]', array(), $maxIterations);
    
    if(!empty($assign)){
        $smarty->assign($assign, $output);
        return;
    }
    
    // else
    return $output;
}

?>