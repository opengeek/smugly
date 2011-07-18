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
 * Properties for the SmuglyAlbums snippet.
 *
 * @package smugly
 * @subpackage build
 */
$properties = array(
    array(
        'name' => 'tpl',
        'desc' => 'Name of a chunk serving as a template for each album.',
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