<?php
/**
 * Smugly
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
 * The main Smugly service class.
 *
 * @package smugly
 */
class Smugly {
    public $modx = null;
    public $namespace = 'smugly';
    public $cache = null;
    protected $options = array();

    public function __construct(modX &$modx, array $options = array()) {
        $this->modx =& $modx;
        $this->namespace = $this->getOption('namespace', $options, 'smugly');

        $corePath = $this->getOption('core_path', $options, $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/smugly/');
        $assetsPath = $this->getOption('assets_path', $options, $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH) . 'components/smugly/');
        $assetsUrl = $this->getOption('assets_url', $options, $this->modx->getOption('assets_url', null, MODX_ASSETS_URL) . 'components/smugly/');

        /* loads some default paths for easier management */
        $this->options = array_merge(array(
                'namespace' => $this->namespace
                ,'core_path' => $corePath
                ,'model_path' => $corePath . 'model/'
                ,'chunks_path' => $corePath . 'elements/chunks/'
                ,'snippets_path' => $corePath . 'elements/snippets/'

                ,'assets_path' => $assetsPath
                ,'assets_url' => $assetsUrl

                ,'debug' => false
                
                ,'cache_request' => true
                ,'cache_expires' => 86400
                ,'cache_path' => $this->modx->getCachePath()

                ,'APIEndpoint' => 'http://api.smugmug.com/hack/json/1.2.0'
                ,'APIKey' => 'RIAiI7A2V5LusZHJmAHWbcg69stcVPyu'
                ,'APISecret' => 'ef782678a86cc64777d22a79c5142901'
                ,'SessionID' => ''
            )
            ,$options
        );

        $this->modx->addPackage('smugly', $this->getOption('model_path'));
        if ($this->getOption('debug')) {
            $this->startTime = $this->modx->getMicroTime();
        }
    }

    /**
     * Get a local configuration option or a namespaced system setting by key.
     *
     * @param string $key The option key to search for.
     * @param array $options An array of options that override local options.
     * @param mixed $default The default value returned if the option is not found locally or as a
     * namespaced system setting; by default this value is null.
     * @return mixed The option value or the default value specified.
     */
    public function getOption($key, $options = array(), $default = null) {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("{$this->namespace}.{$key}", $this->modx->config)) {
                $option = $this->modx->getOption("{$this->namespace}.{$key}");
            }
        }
        return $option;
    }
    
    public function getAlbumInfo(array $parameters) {
        $reqParams = array(
            'method' => 'smugmug.albums.getInfo'
            ,'SessionID' => $this->getOption('SessionID', $parameters)
            ,'AlbumID' => $this->getOption('AlbumID', $parameters)
            ,'AlbumKey' => $this->getOption('AlbumKey', $parameters)
        );
        if ($this->getOption('Password', $parameters)) $reqParams['Password'] = $this->getOption('Password', $parameters);
        if ($this->getOption('SitePassword', $parameters)) $reqParams['SitePassword'] = $this->getOption('SitePassword', $parameters);
        $response = $this->request($reqParams);
        $album = null;
        if (isset($response['stat']) && $response['stat'] == 'ok' && isset($response['Album'])) {
            $album = $response['Album'];
        }
        return $album;
    }
    
    public function getAlbums(array $parameters) {
        $reqParams = array(
            'method' => 'smugmug.albums.get'
            ,'SessionID' => $this->getOption('SessionID', $parameters)
            ,'NickName' => $this->getOption('NickName', $parameters)
        );
        if ($this->getOption('Heavy', $parameters)) $reqParams['Heavy'] = $this->getOption('Heavy', $parameters);
        if ($this->getOption('SitePassword', $parameters)) $reqParams['SitePassword'] = $this->getOption('SitePassword', $parameters);
        $response = $this->request($reqParams);
        $albums = array();
        if (isset($response['stat']) && $response['stat'] == 'ok' && isset($response['Albums'])) {
            $albums = $response['Albums'];
        }
        return $albums;
    }
    
    public function getImages(array $parameters) {
        $reqParams = array(
            'method' => 'smugmug.images.get'
            ,'SessionID' => $this->getOption('SessionID', $parameters)
            ,'AlbumID' => $this->getOption('AlbumID', $parameters)
            ,'AlbumKey' => $this->getOption('AlbumKey', $parameters)
        );
        if ($this->getOption('Heavy', $parameters)) $reqParams['Heavy'] = $this->getOption('Heavy', $parameters);
        if ($this->getOption('Password', $parameters)) $reqParams['Password'] = $this->getOption('Password', $parameters);
        if ($this->getOption('SitePassword', $parameters)) $reqParams['SitePassword'] = $this->getOption('SitePassword', $parameters);
        $response = $this->request($reqParams);
        $images = array();
        if (isset($response['stat']) && $response['stat'] == 'ok' && isset($response['Images'])) {
            $images = $response['Images'];
        }
        return $images;
    }
    
    public function getImageInfo(array $parameters) {
        $reqParams = array(
            'method' => 'smugmug.images.getInfo'
            ,'SessionID' => $this->getOption('SessionID', $parameters)
            ,'ImageID' => $this->getOption('ImageID', $parameters)
            ,'ImageKey' => $this->getOption('ImageKey', $parameters)
        );
        if ($this->getOption('Password', $parameters)) $reqParams['Password'] = $this->getOption('Password', $parameters);
        if ($this->getOption('SitePassword', $parameters)) $reqParams['SitePassword'] = $this->getOption('SitePassword', $parameters);
        $response = $this->request($reqParams);
        $image = null;
        if (isset($response['stat']) && $response['stat'] == 'ok' && isset($response['Image'])) {
            $image = $response['Image'];
        }
        return $image;
    }
    
    public function login(array $parameters = array()) {
        $session_id = '';
        $type = $this->getOption('login', $parameters, 'anonymously');
        $reqParams = array();
        switch ($type) {
            case 'withPassword':
                $reqParams = array(
                    'method' => 'smugmug.login.withPassword'
                    ,'EmailAddress' => $this->getOption('EmailAddress', $parameters)
                    ,'Password' => $this->getOption('Password', $parameters)
                    ,'APIKey' => $this->getOption('APIKey', $parameters)
                );
                break;
            case 'withHash':
                $reqParams = array(
                    'method' => 'smugmug.login.withHash'
                    ,'UserID' => $this->getOption('UserID', $parameters)
                    ,'PasswordHash' => $this->getOption('PasswordHash', $parameters)
                    ,'APIKey' => $this->getOption('APIKey', $parameters)
                );
                break;
            case 'anonymously':
            default:
                $reqParams = array(
                    'method' => 'smugmug.login.anonymously'
                    ,'APIKey' => $this->getOption('APIKey', $parameters)
                );
                break;
        }
        // $reqParams['cache_request'] = false;
        $response = $this->request($reqParams);
        if (!empty($response) && isset($response['Login']) && isset($response['Login']['Session']) && isset($response['Login']['Session']['id'])) {
            $session_id = $response['Login']['Session']['id'];
            $this->options['SessionID'] = $session_id;
        }
        return $session_id;
    }

    public function request(array $parameters) {
        $response = null;
        $url = $this->getOption('APIEndpoint', $parameters);
        $fromCache = false;
        if (!empty($url) && !empty($parameters)) {
            $qs = array();
            foreach ($parameters as $paramKey => $paramVal) $qs[] = "{$paramKey}=" . urlencode($paramVal);
            $url .= '?' . implode('&', $qs);
            if ($this->getCache($parameters)) {
                $response = $this->cache->get($this->namespace . '/' . md5($url));
                if (!empty($response)) $fromCache = true;
            }
            if (!$fromCache) {
                $response = file_get_contents($url);
                if (!empty($response) && $this->getCache($parameters)) {
                    $this->cache->set($this->namespace . '/' . md5($url), $response, $this->getOption('cache_expires', $parameters));
                }
            }
            if (!empty($response)) {
                $response = $this->modx->fromJSON($response);
            }
        }
        return $response;
    }

    public function & getCache(array $options = array()) {
        if ($this->cache === null) {
            if ($this->getOption('cache_request', $options, true) && $this->modx->getCacheManager()) {
                $this->cache = $this->modx->cacheManager->getCacheProvider($this->namespace, array_merge($this->options, $options));
            }
        }
        return $this->cache;
    }
}