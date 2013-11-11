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
 * Default English Lexicon Entries for Smugly
 *
 * @package smugly
 * @subpackage lexicon
 */
$_lang['smugly'] = 'Smugly';

/* Settings */
$_lang['setting_smugly.cache_key'] = 'Smugly Cache Partition Key';
$_lang['setting_smugly.cache_key_desc'] = 'The cache key identifying the MODX cache partition to cache results to.';

$_lang['setting_smugly.cache_request'] = 'Smugly Cache API Requests';
$_lang['setting_smugly.cache_request_desc'] = 'Indicates if API requests are to be cached.';

$_lang['setting_smugly.cache_expires'] = 'Smugly Cache Expires';
$_lang['setting_smugly.cache_expires_desc'] = 'Indicates how many seconds Smugly API requests are cached for.';

$_lang['setting_smugly.login'] = 'Smugly Login Type';
$_lang['setting_smugly.login_desc'] = 'The account login type for accessing the SmugMug API. Valid types are \'anonymously\', \'withPassword\', or \'withHash\'';
