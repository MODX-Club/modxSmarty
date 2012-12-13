<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_snippet($params, & $smarty)
{
    if(!isset($params['name']) OR !$name = $params['name']){return;}
    
    $modx = & $smarty->modx;
    $modx->getParser(); 
    $scriptProperties = array();
    
    if(isset($params['scriptProperties'])){
        $scriptProperties = $params['scriptProperties'];
        // Check if String
        if(is_string($params['scriptProperties'])){
            $scriptProperties = $modx->parser->parseProperties($scriptProperties);
        }
    }  
    
    $output = $modx->runSnippet($name, $scriptProperties);
    
    if(isset($params['parse']) && $params['parse'] == 'true'){
        $maxIterations= intval($modx->getOption('parser_max_iterations', $options, 10));
        $modx->parser->processElementTags('', $output, true, false, '[[', ']]', array(), $maxIterations);
        $modx->parser->processElementTags('', $output, true, true, '[[', ']]', array(), $maxIterations);
    }
    
    return $output;
}

?>