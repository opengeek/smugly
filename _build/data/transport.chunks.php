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
