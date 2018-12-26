# Vue App

Basic vue app integrated within the Wordpress theme. App scripts are conditionally enqueued in includes/theme/enqueue.php. The app is mounted into #vue-app in page-templates/vue-app.php.

## Install
```
npm install
```

## Developing Locally

The below script starts a local server that compiles and hot-reloads. During dev it must run at the same time as the WP server.

```
npm run serve
```

## Building For Production

Compiles and minifies for production. Will produce the vendor and main files necessary for the app to run on a live server.

```
npm run build
```