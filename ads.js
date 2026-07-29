// This script handles the registration of the ad-related service worker.
if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    navigator.serviceWorker.register('/ads-service-worker.js').then(function(registration) {
      console.log('Ad ServiceWorker registration successful with scope: ', registration.scope);
    }).catch(function(err) {
      console.log('Ad ServiceWorker registration failed: ', err);
    });
  });
}