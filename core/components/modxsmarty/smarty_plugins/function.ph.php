<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_ph($params, & $smarty) {
    if (!isset($params['name']) OR !$name = $params['name']) {
        return;
    }
    if(!empty($params['assign'])){
        $assign = (string)$params['assign'];
    }
    $output = $smarty->modx->getPlaceholder($name);
    
    $modx = & $smarty->modx;
    $modx->getParser();
    
    if(isset($params['parse']) && $params['parse'] == 'true'){
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
