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
 * @package smugly
 * @subpackage build
 */
$snippets = array();

$snippets[0]= $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
    'id' => 0,
    'name' => 'SmuglyAlbum',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/snippets/snippet.smuglyalbum.php'),
),'',true,true);
$properties = include $sources['build'].'properties/properties.smuglyalbum.php';
$snippets[0]->setProperties($properties);
unset($properties);

$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 0,
    'name' => 'SmuglyAlbums',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/snippets/snippet.smuglyalbums.php'),
),'',true,true);
$properties = include $sources['build'].'properties/properties.smuglyalbums.php';
$snippets[1]->setProperties($properties);
unset($properties);

$snippets[2]= $modx->newObject('modSnippet');
$snippets[2]->fromArray(array(
    'id' => 0,
    'name' => 'SmuglyImage',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/snippets/snippet.smuglyimage.php'),
),'',true,true);
$properties = include $sources['build'].'properties/properties.smuglyimage.php';
$snippets[2]->setProperties($properties);
unset($properties);

$snippets[3]= $modx->newObject('modSnippet');
$snippets[3]->fromArray(array(
    'id' => 0,
    'name' => 'SmuglyImages',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/snippets/snippet.smuglyimages.php'),
),'',true,true);
$properties = include $sources['build'].'properties/properties.smuglyimages.php';
$snippets[3]->setProperties($properties);
unset($properties);

return $snippets;