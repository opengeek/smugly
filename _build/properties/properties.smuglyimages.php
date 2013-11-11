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
 * Properties for the SmuglyImages snippet.
 *
 * @package smugly
 * @subpackage build
 */
$properties = array(
    array(
        'name' => 'tpl',
        'desc' => 'Name of a Chunk serving as a tpl for each image.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
    ),
    array(
        'name' => 'AlbumID',
        'desc' => 'A valid SmugMug AlbumID.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
    ),
    array(
        'name' => 'AlbumKey',
        'desc' => 'A valid SmugMug AlbumKey.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
    ),
    array(
        'name' => 'outputDelimiter',
        'desc' => 'A delimiter to use between the tpl output from each image.',
        'type' => 'textfield',
        'options' => '',
        'value' => "\n",
    ),
    array(
        'name' => 'filter',
        'desc' => 'A JSON search filter for limiting the images returned from the specified Album.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
    ),
    array(
        'name' => 'sortby',
        'desc' => 'A property name to sort the images by.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
    ),
    array(
        'name' => 'limit',
        'desc' => 'Limits the number of images returned. Defaults to 0 (unlimited).',
        'type' => 'textfield',
        'options' => '',
        'value' => '0',
    ),
    array(
        'name' => 'offset',
        'desc' => 'An offset of images returned by the criteria to skip.',
        'type' => 'textfield',
        'options' => '',
        'value' => '0',
    ),
    array(
        'name' => 'totalVar',
        'desc' => 'The name of a placeholder to set with the total number of images in the album (for use with getPage).',
        'type' => 'textfield',
        'options' => '',
        'value' => 'total',
    ),
);
return $properties;
