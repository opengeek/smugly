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
 * A snippet to retrieve SmugMug Album data and set as placeholders.
 *
 * @package smugly
 */
/** @var $modx modX */
/** @var $scriptProperties array */
if (!$modx->getService('smugly', 'smugly.Smugly', $modx->getOption('smugly.core_path', $scriptProperties, $modx->getOption('core_path') . 'components/smugly/') . 'model/', $scriptProperties)
    || !($modx->smugly instanceof Smugly)
) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'SmuglyAlbum: Could not load smugly service.');
    return '';
}

/* setup default properties */
$AlbumID = $modx->smugly->getOption('AlbumID', $scriptProperties);
$AlbumKey = $modx->smugly->getOption('AlbumKey', $scriptProperties);

$output = array();

if (!empty($AlbumKey) && !empty($AlbumID)) {
    $album = $modx->smugly->getAlbumInfo(array_merge(
        $scriptProperties
        ,array(
            'AlbumID' => $AlbumID
            ,'AlbumKey' => $AlbumKey
        )
    ));
    $modx->toPlaceholders($album, 'Album');
} elseif ($modx->smugly->getOption('debug', $scriptProperties, false)) {
    $modx->log(modX::LOG_LEVEL_ERROR, "An empty AlbumID or AlbumKey was provided.", 'HTML', 'SmuglyAlbum', __FILE__, __LINE__);
}

return '';
