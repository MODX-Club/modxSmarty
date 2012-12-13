<?php
/**
 * modExtra
 *
 * Copyright 2010 by Shaun McCormick <shaun+modextra@modx.com>
 *
 * modExtra is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * modExtra is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * modExtra; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package modextra
 */
/**
 * Loads system settings into build
 *
 * @package modextra
 * @subpackage build
 */
global  $modx, $sources;
$settings = array();

$settings['modxSmarty.template_dir'] = $modx->newObject('modSystemSetting');
$settings['modxSmarty.template_dir']->fromArray(array(
    'key' => 'modxSmarty.template_dir',
    'value' => '{core_path}components/modxsmarty/templates/',
    'xtype' => 'textfield',
    'namespace' => 'modxsmarty',
    'area' => 'site',
),'',true,true);


$settings['modxSmarty.template'] = $modx->newObject('modSystemSetting');
$settings['modxSmarty.template']->fromArray(array(
    'key' => 'modxSmarty.template',
    'value' => 'default',
    'xtype' => 'textfield',
    'namespace' => 'modxsmarty',
    'area' => 'site',
),'',true,true);


$settings['modxSmarty.active'] = $modx->newObject('modSystemSetting');
$settings['modxSmarty.active']->fromArray(array(
    'key' => 'modxSmarty.active',
    'value' => '0',
    'xtype' => 'combo-boolean',
    'namespace' => 'modxsmarty',
    'area' => 'site',
),'',true,true);


$settings['modxSmarty.cache_dir'] = $modx->newObject('modSystemSetting');
$settings['modxSmarty.cache_dir']->fromArray(array(
    'key' => 'modxSmarty.cache_dir',
    'value' => '{core_path}cache/modxsmarty/',
    'xtype' => 'textfield',
    'namespace' => 'modxsmarty',
    'area' => 'site',
),'',true,true);



$settings['modxSmarty.cache_lifetime'] = $modx->newObject('modSystemSetting');
$settings['modxSmarty.cache_lifetime']->fromArray(array(
    'key' => 'modxSmarty.cache_lifetime',
    'value' => '-1',
    'xtype' => 'textfield',
    'namespace' => 'modxsmarty',
    'area' => 'site',
),'',true,true);



return $settings;