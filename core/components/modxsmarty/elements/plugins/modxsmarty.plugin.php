<?php
// Инициализируем Смарти
  
$core_path = $modx->getOption('modxSmarty.core_path', $scriptProperties, $modx->getOption('core_path', null).'components/modxsmarty/');
$template_dir = $modx->getOption('modxSmarty.template_dir', $scriptProperties, $core_path.'templates/');
$template = $modx->getOption('modxSmarty.template', $scriptProperties, 'default');
$cache_dir = $modx->getOption('modxSmarty.cache_dir', $scriptProperties, $modx->getOption('core_path', null).'cache/modxsmarty/');

if(!$compile_dir = $modx->getOption('modxSmarty.compile_dir', $scriptProperties, null)){
    $compile_dir = "{$core_path}compiled/";
}

$config = array(
    'template_dir'      => $template_dir."{$template}/",
    'compile_dir'       => $compile_dir,
    'cache_dir'         => $cache_dir,
    'caching'           => $modx->getOption('modxSmarty.caching', $scriptProperties, false),
    'cache_lifetime'    => $modx->getOption('modxSmarty.cache_lifetime', $scriptProperties, -1),
);

switch($modx->event->name){
    case 'OnHandleRequest':
        
        if(
            $modx->context->key == 'mgr'
            OR (isset($modx->smarty) && is_object($modx->smarty))
        ){
            return;
        }
        
        $smarty = $modx->getService('smarty', 'modxSmarty', MODX_CORE_PATH . 'components/modxsmarty/model/modxSmarty/', $config);
            
        $templates = array();
        
        $_compile_dir = "{$template}/";
        
        if($pre_template = $modx->getOption('modxSmarty.pre_template', null, false)){
            $templates['prepend'] = $template_dir."{$pre_template}/";
            $modx->smarty->assign('pre_template', $pre_template);
            $modx->smarty->assign('pre_template_url', $modx->getOption('modxSite.template_url'). $pre_template .'/');
            $_compile_dir .= "{$pre_template}/";
        } 
        
        $_compile_dir .= $modx->context->key. "/";
        
        $templates['main'] = $template_dir."{$template}/"; 
        $smarty->setTemplateDir($templates);
        $smarty->setCompileDir($config['compile_dir']. $_compile_dir);
        
        /*
            http://www.smarty.net/forums/viewtopic.php?p=87138&sid=03237308442c46664f9a5a80353eb277#87138
            Set $smarty->inheritance_merge_compiled_includes = false;
            You must delete the existing compiled and cache files after this modification. The files must be rebuild.
        */
        $smarty->inheritance_merge_compiled_includes = false;  
     
        $plugins_dir = array(
            $core_path.'smarty_plugins',
        );
        $modx->smarty->addPluginsDir($plugins_dir);
        $modx->smarty->assign('modx', $modx);
        $modx->smarty->assign('template_url', $modx->getOption('modxSite.template_url'). $template .'/');
         
        break;
    
    case 'OnSiteRefresh':
        $modx->setOption('extensions', array('.tpl.php'));
        $modx->cacheManager->deleteTree($config['cache_dir'], array(
            'extensions' => array('.tpl.php'),
        ));
        $modx->cacheManager->deleteTree($config['compile_dir'], array(
            'extensions' => array('.tpl.php'),
        ));
        
        break;
    
    default:;
}
