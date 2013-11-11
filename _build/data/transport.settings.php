<?php
/*
 * This file is part of the Smugly package.
 *
 * Copyright (c) Jason Coward <jason@opengeek.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Loads system settings
 *
 * @package smugly
 * @subpackage build
 */
$settings = array();

$settings['smugly.cache_request']= $modx->newObject('modSystemSetting');
$settings['smugly.cache_request']->fromArray(array(
    'key' => 'smugly.cache_request',
    'value' => false,
    'xtype' => 'combo-boolean',
    'namespace' => 'smugly',
    'area' => 'caching',
),'',true,true);

$settings['smugly.cache_expires']= $modx->newObject('modSystemSetting');
$settings['smugly.cache_expires']->fromArray(array(
    'key' => 'smugly.cache_expires',
    'value' => '86400',
    'xtype' => 'textfield',
    'namespace' => 'smugly',
    'area' => 'caching',
),'',true,true);

$settings['smugly.cache_key']= $modx->newObject('modSystemSetting');
$settings['smugly.cache_key']->fromArray(array(
    'key' => 'smugly.cache_key',
    'value' => 'resource',
    'xtype' => 'textfield',
    'namespace' => 'smugly',
    'area' => 'caching',
),'',true,true);

$settings['smugly.login']= $modx->newObject('modSystemSetting');
$settings['smugly.login']->fromArray(array(
    'key' => 'smugly.login',
    'value' => 'anonymously',
    'xtype' => 'textfield',
    'namespace' => 'smugly',
    'area' => 'authentication',
),'',true,true);

return $settings;
