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
 * Properties for the SmuglyAlbum snippet.
 *
 * @package smugly
 * @subpackage build
 */
$properties = array(
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
);
return $properties;
