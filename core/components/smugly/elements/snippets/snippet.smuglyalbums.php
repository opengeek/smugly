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
$sortdir = isset($sortby) ? $sortdir : 'ASC';
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
    usort($albums, function($a, $b) use ($sortby, $sortdir) {
        if ($a[$sortby] == $b[$sortby]) return 0;
        return (strtoupper($sortdir) === 'DESC' ? $a[$sortby] > $b[$sortby] : $a[$sortby] < $b[$sortby]) ? -1 : 1;
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
