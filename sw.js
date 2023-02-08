self.addEventListener('install', function(event) {
  // Cache all necessary files on install
  event.waitUntil(
    caches.open('my-pwa-cache').then(function(cache) {
      return cache.addAll([
        '/',
        '/css/app.css',
        '/js/app.js'
      ]);
    })
  );
});

self.addEventListener('fetch', function(event) {
  // Serve cached files if network is unavailable
  event.respondWith(
    caches.match(event.request).then(function(response) {
      return response || fetch(event.request);
    })
  );
});
