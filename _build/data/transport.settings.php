<?php
/**
 * Smugly
 *
 * Copyright 2010-2011 by Jason Coward <jason@modx.com>
 *
 * Smugly is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Smugly is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Smugly; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package smugly
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