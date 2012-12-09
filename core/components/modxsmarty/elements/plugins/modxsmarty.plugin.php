<?php
// Инициализируем Смарти
  
$core_path = $modx->getOption('modxsmarty.core_path', $scriptProperties, $modx->getOption('core_path', null).'components/modxsmarty/');
$template_dir = $modx->getOption('modxsmarty.template_dir', $scriptProperties, $core_path.'templates/');
$template = $modx->getOption('modxsmarty.template', $scriptProperties, 'default');

$config = array(
    'template_dir'      => $template_dir."{$template}/",
    'compile_dir'       => $core_path.'compiled/',
    'cache_dir'         => $core_path.'cache/',
    'caching'           => $modx->getOption('modxsmarty.caching', $scriptProperties, false),
    'cache_lifetime'    => $modx->getOption('modxsmarty.cache_lifetime', $scriptProperties, -1),
);

switch($modx->event->name){
    case 'OnHandleRequest':
        if($modx->context->key == 'mgr'){
            return;
        }
        $plugins_dir = array(
            $core_path.'smarty_plugins',
        );
        $modx->getService('smarty', 'smarty.modSmarty', '', $config);
        $modx->smarty->addPluginsDir($plugins_dir);
        break;
    
    case 'OnSiteRefresh':
        $modx->setOption('extensions', array('.tpl.php'));
        $modx->cacheManager->deleteTree($config['cache_dir'], array(
            'extensions' => array('.tpl.php'),
        ));
        break;
    
    default:;
}