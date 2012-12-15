<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_tv($params, & $smarty)
{
    if(!isset($params['name']) OR !$name = $params['name']){return '';}
    if(isset($params['assign']) && $params['assign']){
        $assign = (string)$params['assign'];
    }
    $modx = & $smarty->modx;
    
    // Check modResource ID
    /*if(isset($params['contentid']) && ($params['contentid'] > 0)){
        $contentid = $params['contentid']; 
    }
    else if(!isset($modx->resource) || !is_object($modx->resource)){return '';}
    else{
        $contentid = $modx->resource->get('id');
    }*/
    if(isset($params['contentid']) && ($params['contentid'] > 0)){
        $contentid = $params['contentid'];
        $resource = $modx->getObject('modResource', $contentid);
    }
    else{
        $resource = & $modx->resource;
    }
    
    if(!$resource || !is_object($resource)){return '';}
    
    $output = $resource->getTVValue($name);
    
    if(isset($params['parse']) && $params['parse'] == 'true'){
        $modx->getParser();
        $maxIterations= intval($modx->getOption('parser_max_iterations', $options, 10));
        $modx->parser->processElementTags('', $output, true, false, '[[', ']]', array(), $maxIterations);
        $modx->parser->processElementTags('', $output, true, true, '[[', ']]', array(), $maxIterations);
    }
    
    return $assign ? $smarty->assign($assign, $output) : $output;
}

?>