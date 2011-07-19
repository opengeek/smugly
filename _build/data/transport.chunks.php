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
$chunks = array();

$chunks[0]= $modx->newObject('modChunk');
$chunks[0]->fromArray(array(
    'id' => 0,
    'name' => 'SmuglyAlbum',
    'description' => 'Sample tpl for rendering the output of a SmugMug Album (see SmuglyAlbum snippet).',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/smuglyalbum.tpl'),
    'properties' => '',
),'',true,true);

$chunks[1]= $modx->newObject('modChunk');
$chunks[1]->fromArray(array(
    'id' => 0,
    'name' => 'SmuglyImage',
    'description' => 'Sample tpl for rendering the output of a SmugMug Image (see SmuglyImage and SmuglyImages snippets).',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/smuglyimage.tpl'),
    'properties' => '',
),'',true,true);

return $chunks;