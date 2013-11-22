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
 * A snippet to iterate images from a SmugMug Album.
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
    $modx->log(modX::LOG_LEVEL_ERROR, 'SmuglyImages: Could not load smugly service.');
    return '';
}

/* setup default properties */
$outputDelimiter = $modx->smugly->getOption('outputDelimiter', $scriptProperties, "\n");
$AlbumID = $modx->smugly->getOption('AlbumID', $_REQUEST, $modx->smugly->getOption('AlbumID', $scriptProperties));
$AlbumKey = $modx->smugly->getOption('AlbumKey', $_REQUEST, $modx->smugly->getOption('AlbumKey', $scriptProperties));
$filter = isset($filter) && !empty($filter) ? $modx->fromJSON($filter) : array();
$sortby = isset($sortby) ? $sortby : '';
$limit = isset($limit) ? (integer) $limit : 9;
$offset = isset($offset) ? (integer) $offset : 0;
$totalVar = !empty($totalVar) ? $totalVar : 'total';


$output = array();

$images = array();
$imagesRaw = $modx->smugly->getImages(array_merge(
    $scriptProperties
    ,array(
        'AlbumID' => $AlbumID
        ,'AlbumKey' => $AlbumKey
    )
));

if (!empty($filter)) {
    foreach ($imagesRaw as $imageRaw) {
        $diff = array_diff_assoc($filter, $imageRaw);
        if (empty($diff)) {
            $images[] = $imageRaw;
        }
    }
    unset($imagesRaw, $imageRaw);
} else {
    $images =& $imagesRaw;
}

if (!empty($sortby) && isset($images[0][$sortby])) {
    usort($images, function($a, $b) use ($sortby) {
        if ($a[$sortby] == $b[$sortby]) return 0;
        return ($a[$sortby] < $b[$sortby]) ? -1 : 1;
    });
}

$idx = 0;
$cnt = 0;
$modx->setPlaceholder($totalVar, count($images));
foreach ($images as $image) {
    $idx++;
    if ($limit > 0) {
        if ($offset > 0 && $idx < $offset) continue;
        if ($cnt >= $limit) break;
    }
    $output[] = $modx->getChunk($tpl, array_merge($scriptProperties, $image));
    $cnt++;
}

return implode($outputDelimiter, $output);
