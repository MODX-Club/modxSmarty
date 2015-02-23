<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_snippet($params, & $smarty)
{
    if(!isset($params['name']) OR !$name = $params['name']) return;
    
    if(!empty($params['assign'])){
        $assign = (string)$params['assign'];
    }
    
    $modx = & $smarty->modx;
    $modx->getParser();

    $as_tag = !empty($params['as_tag']);
    
    $scriptProperties = !empty($params['params']) ? $params['params'] : array();
    if($scriptProperties && !is_array($scriptProperties)){
        $scriptProperties = $modx->parser->parseProperties($scriptProperties);
    }
    
    
    // Output as MODX-tag like [[!$name...]]
    if($as_tag){
        $tag = new modFieldTag($modx);
        $tag->_token = '!';
        $tag->name= $name;
        $tag->_properties = $scriptProperties;
        $output = $tag->getTag();
    }
    
    // execute via MODX API
    else{
        $output = $modx->runSnippet($name, $scriptProperties);
        if(isset($params['parse']) && $params['parse'] == 'true'){
            $maxIterations= intval($modx->getOption('parser_max_iterations', $params, 10));
            $modx->parser->processElementTags('', $output, true, false, '[[', ']]', array(), $maxIterations);
            $modx->parser->processElementTags('', $output, true, true, '[[', ']]', array(), $maxIterations);
        }
    }
    
    
    if(!empty($assign)){
        $smarty->assign($assign, $output);
        return;
    }
    
    // else
    return $output;
}

?>
