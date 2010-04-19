<?php
/**
 * SmuglyAlbum
 *
 * Copyright 2010 by Jason Coward <modx@opengeek.com>
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
 * A snippet to retrieve information about a SmugMug Album.
 *
 * @package smugly
 */
if (!$modx->getService('smugly', 'smugly.Smugly', $modx->getOption('smugly.core_path', $scriptProperties, $modx->getOption('core_path') . 'components/smugly/') . 'model/', $scriptProperties) 
    || !($modx->smugly instanceof Smugly)
    || !($modx->smugly->login($scriptProperties))
) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'SmuglyAlbum: Could not load smugly service.');
    return '';
}

/* setup default properties */
$AlbumID = $modx->smugly->getOption('AlbumID', $_REQUEST, $modx->smugly->getOption('AlbumID', $scriptProperties));
$AlbumKey = $modx->smugly->getOption('AlbumKey', $_REQUEST, $modx->smugly->getOption('AlbumKey', $scriptProperties));

$output = array();

$album = $modx->smugly->getAlbumInfo(array_merge(
    $scriptProperties
    ,array(
        'AlbumID' => $AlbumID
        ,'AlbumKey' => $AlbumKey
    )
));
$modx->toPlaceholders($album, 'Album');

return '';