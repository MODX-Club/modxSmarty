<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_lang($params, & $smarty)
{
    if(!isset($params['key']) OR !$key = $params['key']){return;}
    
    $assign = '';    
    if(isset($params['assign']) && $params['assign']){
        $assign = (string)$params['assign'];
    }
    
    $language = '';    
    if(isset($params['language']) && $params['language']){
        $language = (string)$params['language'];
    }
    
    $modx = & $smarty->modx;
    $scriptProperties = array();
    
    if(isset($params['params'])){
        $modx->getParser(); 
        $scriptProperties = $params['params'];
        // Check if String
        if(is_string($scriptProperties)){
            $scriptProperties = $modx->parser->parseProperties($scriptProperties);
        }
    }     
     
    $output = $modx->lexicon($key, $scriptProperties, $language);
    
    if(!empty($assign)){
        $smarty->assign($assign, $output);
        return;
    }
    
    // else
    return $output;
}

?>