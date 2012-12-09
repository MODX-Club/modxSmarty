<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_snippet($params, & $smarty)
{
    if(!$name = $params['name']){return;}
    $modx = & $smarty->modx;
    
    if(isset($params['scriptProperties'])){
        $scriptProperties = (array)$params['scriptProperties'];
    }
    else $scriptProperties = array();
    $output = $modx->runSnippet($name, $scriptProperties);
    
    if(isset($params['parse']) && $params['parse'] == 'true'){
        $maxIterations= intval($modx->getOption('parser_max_iterations', $options, 10));
        $modx->parser->processElementTags('', $output, true, false, '[[', ']]', array(), $maxIterations);
        $modx->parser->processElementTags('', $output, true, true, '[[', ']]', array(), $maxIterations);
    }
    
    return $output;
}

?>