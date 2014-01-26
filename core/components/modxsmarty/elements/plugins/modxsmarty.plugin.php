<?php
// Инициализируем Смарти
  
$core_path = $modx->getOption('modxSmarty.core_path', $scriptProperties, $modx->getOption('core_path', null).'components/modxsmarty/');
$template_dir = $modx->getOption('modxSmarty.template_dir', $scriptProperties, $core_path.'templates/');
$template = $modx->getOption('modxSmarty.template', $scriptProperties, 'default');
$cache_dir = $modx->getOption('modxSmarty.cache_dir', $scriptProperties, $modx->getOption('core_path', null).'cache/modxsmarty/');
$compile_dir = $modx->getOption('modxSmarty.compile_dir', $scriptProperties, "{$core_path}compiled/{$template}/");

$config = array(
    'template_dir'      => $template_dir."{$template}/",
    'compile_dir'       => $compile_dir,
    'cache_dir'         => $cache_dir,
    'caching'           => $modx->getOption('modxSmarty.caching', $scriptProperties, false),
    'cache_lifetime'    => $modx->getOption('modxSmarty.cache_lifetime', $scriptProperties, -1),
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
        $modx->smarty->assign('modx', $modx);
        break;
    
    case 'OnSiteRefresh':
        $modx->setOption('extensions', array('.tpl.php'));
        $modx->cacheManager->deleteTree(dirname($config['cache_dir']), array(
            'extensions' => array('.tpl.php'),
        ));
        $modx->cacheManager->deleteTree(dirname($config['compile_dir']), array(
            'extensions' => array('.tpl.php'),
        ));
        break;
    
    default:;
}