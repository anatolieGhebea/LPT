<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('head_title') | LPT </title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/app-custom.css') }}" rel="stylesheet">
    
    @livewireStyles
</head>

<body class="bg-gray-100 mb-2">
    <div>
        @yield('content')
    </div>

    <script src="{{ asset('vendor/livewire/livewire.js?id=5b362d451997b18fadde') }}" data-turbolinks-eval="false"></script>
    <script data-turbolinks-eval="false">
        if (window.livewire) {
            console.warn('Livewire: It looks like Livewire\'s livewireScripts JavaScript assets have already been loaded. Make sure you aren\'t loading them twice.')
        }

        window.livewire = new Livewire();
        window.Livewire = window.livewire;
        window.livewire_app_url = "{{ route('app_url') }}";
        window.livewire_token = 'E828ZyqTot1ggLHbDnam6S0YQ3hF0AzHn0U3jsuH';

        /* Make Alpine wait until Livewire is finished rendering to do its thing. */
        window.deferLoadingAlpine = function (callback) {
            window.addEventListener('livewire:load', function () {
                callback();
            });
        };

        document.addEventListener("DOMContentLoaded", function () {
            window.livewire.start();
        });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>