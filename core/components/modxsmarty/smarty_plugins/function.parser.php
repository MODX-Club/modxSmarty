<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_parser($scriptProperties, & $smarty)
{
    $modx = & $smarty->modx; 
    $output = $scriptProperties['content'];
    $maxIterations= intval($modx->getOption('parser_max_iterations', $options, 10));
    $modx->parser->processElementTags('', $output, true, false, '[[', ']]', array(), $maxIterations);
    $modx->parser->processElementTags('', $output, true, true, '[[', ']]', array(), $maxIterations);
    return $output;
}

?>