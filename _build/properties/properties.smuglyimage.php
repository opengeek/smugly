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
 * Properties for the SmuglyImage snippet.
 *
 * @package smugly
 * @subpackage build
 */
$properties = array(
    array(
        'name' => 'tpl',
        'desc' => 'Name of a Chunk serving as a tpl for rendering the image data.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
    ),
    array(
        'name' => 'ImageID',
        'desc' => 'A valid SmugMug ImageID.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
    ),
    array(
        'name' => 'ImageKey',
        'desc' => 'A valid SmugMug ImageKey.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
    ),
);
return $properties;
