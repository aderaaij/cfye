/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/js/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 62);
/******/ })
/************************************************************************/
/******/ ({

/***/ 62:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


// Stolen from: https://github.com/aarontgrogg/aarontgrogg/tree/master/src/scripts
// TODO: Ideally Gulp replaces this version with the current cache-buster
var cacheStorage = 'cfye.com';
var cacheBuster = 'CACHE_BUSTER';
var version = cacheStorage + '.' + cacheBuster;
var staticCacheName = version + '.static';
var pagesCacheName = version + '.pages';
var imagesCacheName = version + '.images';
var themeName = 'cfye-2017';

var updateStaticCache = function updateStaticCache() {
    return caches.open(staticCacheName).then(function (cache) {
        // These items won't block the installation of the Service Worker
        cache.addAll(['/about/']);
        // These items must be cached for the Service Worker to complete installation
        return cache.addAll(['/content/themes/' + themeName + '/assets/js/script.js', '/content/themes/' + themeName + '/assets/css/screen.css', '/']);
    });
};

var stashInCache = function stashInCache(cacheName, request, response) {
    caches.open(cacheName).then(function (cache) {
        cache.put(request, response);
    });
};

// Limit the number of items in a specified cache.
var trimCache = function trimCache(cacheName, maxItems) {
    caches.open(cacheName).then(function (cache) {
        cache.keys().then(function (keys) {
            if (keys.length > maxItems) {
                cache.delete(keys[0]).then(trimCache(cacheName, maxItems));
            }
        });
    });
};

// Remove caches whose name is no longer valid
var clearOldCaches = function clearOldCaches() {
    return caches.keys().then(function (keys) {
        return Promise.all(keys
        // .filter(key => key.indexOf(version) !== 0)
        .map(function (key) {
            return caches.delete(key);
        }));
    });
};

self.addEventListener('install', function (event) {
    event.waitUntil(updateStaticCache().then(function () {
        return self.skipWaiting();
    }));
});

self.addEventListener('activate', function (event) {
    event.waitUntil(clearOldCaches().then(function () {
        return self.clients.claim();
    }));
});

self.addEventListener('message', function (event) {
    if (event.data.command == 'trimCaches') {
        trimCache(pagesCacheName, 20);
        trimCache(imagesCacheName, 20);
    }
});

self.addEventListener('fetch', function (event) {
    var request = event.request;
    var url = new URL(request.url);

    // Only deal with requests to my own server
    if (url.origin !== location.origin) {
        return;
    }

    // Ignore requests to some directories (admin pages, includes files, and post previews)
    if (request.url.indexOf('/wp-admin') !== -1 || request.url.indexOf('/wp-includes') !== -1 || request.url.indexOf('preview=true') !== -1) {
        return;
    }

    // For non-GET requests, try the network first, fall back to the offline page
    if (request.method !== 'GET') {
        event.respondWith(fetch(request).catch(function () {
            return caches.match('/offline/');
        }));
        return;
    }

    // For HTML requests, try the network first, fall back to the cache, finally the offline page
    if (request.headers.get('Accept').indexOf('text/html') !== -1) {
        event.respondWith(fetch(request).then(function (response) {
            // NETWORK
            // Stash a copy of this page in the pages cache
            var copy = response.clone();
            stashInCache(pagesCacheName, request, copy);
            return response;
        }).catch(function () {
            return (
                // CACHE or FALLBACK
                caches.match(request).then(function (response) {
                    return response || caches.match('/offline/');
                })
            );
        }));
        return;
    }

    // For non-HTML requests, look in the cache first, fall back to the network
    event.respondWith(caches.match(request).then(function (response) {
        return (
            // CACHE
            response || fetch(request).then(function (response) {
                // NETWORK
                // If the request is for an image, stash a copy of this image in the images cache
                if (request.headers.get('Accept').indexOf('image') !== -1) {
                    var copy = response.clone();
                    stashInCache(imagesCacheName, request, copy);
                }
                return response;
            }).catch(function () {
                // OFFLINE
                // If the request is for an image, show an offline placeholder
                if (request.headers.get('Accept').indexOf('image') !== -1) {
                    return new Response('<svg role="img" aria-labelledby="offline-title" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg"><title id="offline-title">Offline</title><g fill="none" fill-rule="evenodd"><path fill="#D8D8D8" d="M0 0h400v300H0z"/><text fill="#9B9B9B" font-family="Helvetica Neue,Arial,Helvetica,sans-serif" font-size="72" font-weight="bold"><tspan x="93" y="172">offline</tspan></text></g></svg>', { headers: { 'Content-Type': 'image/svg+xml' } });
                }
            })
        );
    }));
});

/***/ })

/******/ });
//# sourceMappingURL=service-worker.js.map