<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $allCities = @json(config('cities'));
        
                function getCity() {
                    var selectElement = document.getElementById("province");
                    var selectedValue = selectElement.value;
                    var cities = $allCities[selectedValue];
        
                    // Get the select element for cities
                    var citySelect = document.getElementById("city");
        
                    // Clear previous options
                    citySelect.innerHTML = "";
        
                    // Iterate over the cities array and create options
                    cities.forEach(function(city) {
                        var option = document.createElement("option");
                        option.value = city;
                        option.text = city;
                        citySelect.appendChild(option);
                    });
                }
        
                // Attach event listener programmatically
                document.getElementById('province').addEventListener('change', getCity);
            });
        </script>
    </body>
</html>
