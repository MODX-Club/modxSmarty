<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_field($params, & $smarty) {
    if (!isset($params['name']) OR !$tagName = $params['name']) {
        return;
    }
    if(!empty($params['assign'])){
        $assign = (string)$params['assign'];
    }
    $output = '';
    $modx = & $smarty->modx;
    $modx->getParser();
    $nextToken = substr($tagName, 0, 1);
    $cacheable = false;
    if ($nextToken === '#') {
        $tagName = substr($tagName, 1);
    }
    if (is_array($modx->resource->_fieldMeta) && in_array($modx->parser->realname($tagName), array_keys($modx->resource->_fieldMeta))) {
        $element = new modFieldTag($modx);
        $element->set('name', $tagName);
        $element->setCacheable($cacheable);
        $output = $element->process($tagPropString);
    } elseif ($element = $modx->parser->getElement('modTemplateVar', $tagName)) {
        $element->set('name', $tagName);
        $element->setCacheable($cacheable);
        $output = $element->process($tagPropString);
    }

    return !empty($assign) ? $smarty->assign($assign, $output) : $output;
}

?>
