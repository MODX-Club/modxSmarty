<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_parser($params, & $smarty)
{
    if(!isset($params['content']) OR !$content = $params['content']){return;}
    $modx = & $smarty->modx; 
    $modx->getParser(); 
    $maxIterations= intval($modx->getOption('parser_max_iterations', $options, 10));
    $modx->parser->processElementTags('', $content, true, false, '[[', ']]', array(), $maxIterations);
    $modx->parser->processElementTags('', $content, true, true, '[[', ']]', array(), $maxIterations);
    return $content;
}

?>