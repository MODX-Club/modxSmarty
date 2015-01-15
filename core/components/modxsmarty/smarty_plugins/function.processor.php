<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_processor($params, & $smarty)
{
    $output = array(
        'success'      => false,
        'message'      => '',
        'errors'       => array(),
        'field_errors' => array(),
        'object'       => null,
    );

    if (!isset($params['action']) OR !$action = $params['action']) {
        return;
    }
    if(!empty($params['assign'])){
        $assign = (string)$params['assign'];
    }

    $modx = & $smarty->modx;
    $scriptProperties = array();
    $options = array();

    if (!empty($params['location'])) {
        $options['location'] = $params['location'];
    }

    if (isset($params['params'])) {
        $scriptProperties = $params['params'];
        // Check if String
        if (is_string($scriptProperties)) {
            $modx->getParser();
            $scriptProperties = $modx->parser->parseProperties($scriptProperties);
        }
    }
    if (!empty($params['ns'])) {
        $nm_config_name = "{$params['ns']}.core_path";
        if (!$path = $modx->getOption($nm_config_name, null)) {
            if ($namespace = $modx->getObject('modNamespace', $params['ns'])
                AND $path = $namespace->getCorePath()
            ) {
                $modx->setOption($nm_config_name, $path);
            }
        }
        if ($path) {
            $path .= 'processors/';
            $options['processors_path'] = $path;
        }
    }
    if ($response = $modx->runProcessor($action, $scriptProperties, $options)) {
        $output = $response->getResponse();
        if ($response->isError()) {
            if ($response->hasFieldErrors()) {
                $errors = (array) $response->getFieldErrors();
                foreach ($errors as $error) {
                    $output['field_errors'][$error->getField()] = $error->getMessage();
                }
            }
        } else {
            $output['success'] = true;
        }
    }
    
    $modx->error->reset();
    
    if(!empty($assign)){
        $smarty->assign($assign, $output);
        return;
    }
    
    // else
    return $output;
}
