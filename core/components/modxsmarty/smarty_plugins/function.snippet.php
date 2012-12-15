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
    if(isset($params['assign']) && $params['assign']){
        $assign = (string)$params['assign'];
    }
    
    $modx = & $smarty->modx;
    $modx->getParser(); 
    $scriptProperties = array();
    
    if(isset($params['params'])){
        $scriptProperties = $params['params'];
        // Check if String
        if(is_string($scriptProperties)){
            $scriptProperties = $modx->parser->parseProperties($scriptProperties);
        }
    }  
    
    $output = $modx->runSnippet($name, $scriptProperties);
    
    if(isset($params['parse']) && $params['parse'] == 'true'){
        $maxIterations= intval($modx->getOption('parser_max_iterations', $options, 10));
        $modx->parser->processElementTags('', $output, true, false, '[[', ']]', array(), $maxIterations);
        $modx->parser->processElementTags('', $output, true, true, '[[', ']]', array(), $maxIterations);
    }
    
    return $assign ? $smarty->assign($assign, $output) : $output;
}

?>