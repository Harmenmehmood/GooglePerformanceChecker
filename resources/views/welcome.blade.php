<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Google Lighthouse Performance Checker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-roboto">
    <div id="app" class="flex items-center justify-center min-h-screen">
        <div v-if="!isLoggedIn" class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
            <google-login></google-login>
        </div>

        <div v-else class="w-full max-w-3xl bg-white shadow-lg rounded-lg p-8">
            <lighthouse-check></lighthouse-check>
        </div>
    </div>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
</body>

</html>