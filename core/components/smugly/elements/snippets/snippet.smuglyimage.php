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
 * A snippet to retrieve information about a SmugMug Image.
 *
 * @package smugly
 */
/** @var $modx modX */
/** @var $scriptProperties array */
if (!$modx->getService('smugly', 'smugly.Smugly', $modx->getOption('smugly.core_path', $scriptProperties, $modx->getOption('core_path') . 'components/smugly/') . 'model/', $scriptProperties) 
    || !($modx->smugly instanceof Smugly)
) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'SmuglyImage: Could not load smugly service.');
    return '';
}

/* setup default properties */
$ImageID = $modx->smugly->getOption('ImageID', $scriptProperties);
$ImageKey = $modx->smugly->getOption('ImageKey', $scriptProperties);

$image = $scriptProperties;
if (!empty($ImageID) && !empty($ImageKey)) {
    $image = $modx->smugly->getImageInfo(array_merge(
        $image
        ,array(
            'ImageID' => $ImageID
            ,'ImageKey' => $ImageKey
        )
    ));
} elseif ($modx->smugly->getOption('debug', $scriptProperties, false)) {
    $modx->log(modX::LOG_LEVEL_ERROR, "An empty ImageID or ImageKey was provided.", 'HTML', 'SmuglyImage', __FILE__, __LINE__);
}
return $modx->getChunk($tpl, $image);
