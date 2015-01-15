<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_tv($params, & $smarty) {
    if (!isset($params['name']) OR !$name = $params['name']) {
        return '';
    }
    if(!empty($params['assign'])){
        $assign = (string)$params['assign'];
    }
    $modx = & $smarty->modx;

    if (isset($params['contentid']) && ($params['contentid'] > 0)) {
        $contentid = $params['contentid'];
        $resource = $modx->getObject('modResource', $contentid);
    } else {
        $resource = & $modx->resource;
    }

    if (!$resource || !is_object($resource)) {
        return '';
    }

    $output = $resource->getTVValue($name);

    if (isset($params['parse']) && $params['parse'] == 'true') {
        $modx->getParser();
        $maxIterations = intval($modx->getOption('parser_max_iterations', $params, 10));
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
