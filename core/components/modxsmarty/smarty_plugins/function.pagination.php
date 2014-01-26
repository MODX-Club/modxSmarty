<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */


function smarty_function_pagination($params, &$smarty)
{
    $pagination = array();
    $default = array(
        'prev_next' => 0,
        'limit' => 5,
        'current' => 1,
        'edges' => 3,
        'offset' => 3,
        'resource_id' => 1
    ); 
    $params = array_merge($default, $params);
    $pages = array();
    $prev = array();
    $next = array();

    $total = ceil($params['items']/$params['limit']);
    $params['current'] = ($params['current'] <= $total) ? $params['current'] : 1;
    
    if ($total>1){
        
        $l_edge = ($params['edges']) ? range(1, min($total, $params['edges'])) : array();
        $r_edge = ($params['edges']) ? range(max(1, ($total - $params['edges'] + 1)), $total) : array();
        $middle = range(max(1, $params['current'] - $params['offset']), min($total, $params['current'] + $params['offset']));
        $pages = array_merge($l_edge, $middle, $r_edge);
        $pages = array_unique($pages);     
    }

    $get = $_GET;
    unset($get['q']);

    foreach($pages as $key => $page){

        $get['page'] = $page;        
        $href = $smarty->modx->makeUrl($params['resource_id'], '', $get);
        $pages[$key] = array(
          'id' => $page,
          'href' => $href, 
          'type' => ($params['current'] == $page) ? 'current' : ''
          ); 
        if ($params['prev_next']) {
            if ($page == ($params['current'] + 1)){
                $next = $pages[$key];
                $next['type'] = 'next';
            }
            if ($page == ($params['current'] - 1)){
                $prev = $pages[$key];
                $prev['type'] = 'prev';
            }            
        }
    }

    $pagination['pages'] = $pages;
    $pagination['next'] = $next;
    $pagination['prev'] = $prev;

    $smarty->assign($params['assign'], $pagination);
}

?>