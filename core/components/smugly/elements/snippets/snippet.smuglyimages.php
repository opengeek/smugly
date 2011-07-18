<?php
/**
 * SmuglyImages
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
 * A snippet to iterate images from a SmugMug Album.
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
$filter = isset($filter) ? $modx->fromJSON($filter) : array();
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
    $output[] = $modx->getChunk($tpl, $image);
    $cnt++;
}

return implode($outputDelimiter, $output);