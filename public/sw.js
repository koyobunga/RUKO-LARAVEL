
var staticCacheName = "pwa-v1";
const urlToCache = [
    '/',
    // '/mobile/asn',
    // '/mobile/rencana',
    '/mobile/offline',
    '/offline.html',
];


self.addEventListener("install", event => {

        this.skipWaiting();
    
        event.waitUntil(
    
        caches.open(staticCacheName)
        
        .then(cache => {
            console.log('INSTALL SUCCESS');
             return cache.addAll(urlToCache);
        
        })
        
        )
    
    });


// // Clear cache on activate

self.addEventListener("activate", async event => {

    event.waitUntil(
    
      caches.keys().then(cacheNames => {
    
      return Promise.all(    
          cacheNames.filter(function(cacheName){
            return cacheName != staticCacheName;
          }).map(function(cacheName){
            return caches.delete(cacheName);
          })     
      );
    
    })
    
    );
    
    });


    // Serve from Cache



self.addEventListener('fetch', function(e){
  var request = e.request;
  var url = new URL(request.url);

  if(url.origin != location.origin){
    e.respondWith(
      caches.match(request).then(function(response){
        return response || fetch(request);
      })
    )
  }else{
    e.respondWith(
      caches.open(staticCacheName).then(function(cache){
        return fetch(request).then(function(liveResponse){
          cache.put(request, liveResponse.clone());
          return liveResponse;
        }).catch(function(){
          return caches.match(request).then(function(response){
            if(response) return response;
            return caches.match('/mobile/offline');
          })
        })
      })
    );
  }
});