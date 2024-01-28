<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @include('super_admin.layouts.partials.css_files')
        @yield('custom_css')  
    </head>
    <body >
        <div class="container-scroller">
            @include('super_admin.layouts.partials.header')

            <div class="container-fluid page-body-wrapper">
                @include('super_admin.layouts.partials.sidebar')
                <div class="main-panel">
                    @yield('content')   
                    @include('super_admin.layouts.partials.footer')
                </div>
            </div>
        </div>
        @include('super_admin.layouts.partials.js_files')
        @yield('custom_script')  
    </body>
</html>
