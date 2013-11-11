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
 * Properties for the SmuglyAlbums snippet.
 *
 * @package smugly
 * @subpackage build
 */
$properties = array(
    array(
        'name' => 'tpl',
        'desc' => 'Name of a Chunk serving as a tpl for rendering each album.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
    ),
    array(
        'name' => 'NickName',
        'desc' => 'The account nickname to retrieve the albums from.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
    ),
    array(
        'name' => 'outputDelimiter',
        'desc' => 'A delimiter to use between the tpl output from each album.',
        'type' => 'textfield',
        'options' => '',
        'value' => "\n",
    ),
    array(
        'name' => 'filter',
        'desc' => 'A JSON search filter for limiting the albums returned from the user account.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
    ),
    array(
        'name' => 'sortby',
        'desc' => 'A property name to sort the albums by.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
    ),
    array(
        'name' => 'limit',
        'desc' => 'Limits the number of albums returned. Defaults to 0 (unlimited).',
        'type' => 'textfield',
        'options' => '',
        'value' => '0',
    ),
    array(
        'name' => 'offset',
        'desc' => 'An offset of albums returned by the criteria to skip.',
        'type' => 'textfield',
        'options' => '',
        'value' => '0',
    ),
    array(
        'name' => 'totalVar',
        'desc' => 'The name of a placeholder to set with the total number of albums (for use with getPage).',
        'type' => 'textfield',
        'options' => '',
        'value' => 'total',
    ),
);

return $properties;
