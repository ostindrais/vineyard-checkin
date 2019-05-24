<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles from Quasar for the beautiful Material Design look -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/animate.css@^3.5.2/animate.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quasar-framework@^0.17.0/dist/umd/quasar.mat.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="app">
        <q-layout view="lHh Lpr fff">
                <q-layout-header>
                        <q-toolbar class="glossy">
                          <q-toolbar-title>
                            {{ config('app.name', 'Laravel') }}
                          </q-toolbar-title>
                        </q-toolbar>
                      </q-layout-header>
        <q-layout-drawer
        :content-class="'bg-grey-3'"
      >
        <q-list no-border link inset-delimiter>
          <q-list-header>{{ Auth::user() ? Auth::user()->name : "Guest" }}</q-list-header>
          <q-item @click="event.preventDefault();
          document.getElementById('logout-form').submit();">
            <q-item-side icon="power_settings_new"></q-item-side>
            <q-item-main label="Logout"></q-item-main>
          </q-item>
          <q-item>
            <q-item-side icon="child_care"></q-item-side>
            <q-item-main label="Start Check-In"></q-item-main>
          </q-item>
        </q-list>
      </q-layout-drawer>
        <main class="py-4">
            @yield('content')
        </main>
        </q-layout>
    </div>
    <!-- Quasar scripts -->
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/quasar-framework@^0.17.0/dist/umd/quasar.ie.polyfills.umd.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/quasar-framework@^0.17.0/dist/umd/quasar.mat.umd.min.js" defer></script>
</body>
</html>
