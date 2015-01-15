<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_chunk($params, & $smarty)
{
    if(!isset($params['name']) OR !$name = $params['name']){return;}
    if(!empty($params['assign'])){
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
        
    $output = $modx->getChunk($name, $scriptProperties);
    
    if(!isset($params['noparse']) || $params['noparse'] != 'true'){
        $maxIterations= intval($modx->getOption('parser_max_iterations', $params, 10));
        $modx->parser->processElementTags('', $output, true, false, '[[', ']]', array(), $maxIterations);
        $modx->parser->processElementTags('', $output, true, true, '[[', ']]', array(), $maxIterations);
    }
    
    if(!empty($assign)){
        $smarty->assign($assign, $output);
        return;
    }
    
    // else
    return $output;
}

?>