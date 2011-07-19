<?php
/**
 * SmuglyAlbums
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
 * A snippet to iterate a user's SmugMug Albums.
 *
 * This snippet is compatible with getPage for paging results.
 *
 * @package smugly
 */
/** @var $modx modX */
/** @var $scriptProperties array */
if (!$modx->getService('smugly', 'smugly.Smugly', $modx->getOption('smugly.core_path', $scriptProperties, $modx->getOption('core_path') . 'components/smugly/') . 'model/', $scriptProperties)
    || !($modx->smugly instanceof Smugly)
) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'SmuglyAlbums: Could not load smugly service.');
    return '';
}

/* setup default properties */
$outputDelimiter = $modx->smugly->getOption('outputDelimiter', $scriptProperties, "\n");
$filter = isset($filter) ? $modx->fromJSON($filter) : array();
$sortby = isset($sortby) ? $sortby : '';
$limit = isset($limit) ? (integer) $limit : 20;
$offset = isset($offset) ? (integer) $offset : 0;
$totalVar = !empty($totalVar) ? $totalVar : 'total';

$output = array();

$albums = array();
$albumsRaw = $modx->smugly->getAlbums($scriptProperties);

if (!empty($filter)) {
    foreach ($albumsRaw as $albumRaw) {
        $diff = array_diff_assoc($filter, $albumRaw);
        if (empty($diff)) {
            $albums[] = $albumRaw;
        }
    }
    unset($albumsRaw);
} else {
    $albums =& $albumsRaw;
}

if (!empty($sortby) && isset($albums[0][$sortby])) {
    usort($albums, function($a, $b) use ($sortby) {
        if ($a[$sortby] == $b[$sortby]) return 0;
        return ($a[$sortby] < $b[$sortby]) ? -1 : 1;
    });
}

$idx = 0;
$cnt = 0;
$modx->setPlaceholder($totalVar, count($albums));
foreach ($albums as $album) {
    $idx++;
    if ($limit > 0) {
        if ($offset > 0 && $idx < $offset) continue;
        if ($cnt >= $limit) break;
    }
    $output[] = $modx->getChunk($tpl, $album);
    $cnt++;
}

return implode($outputDelimiter, $output);