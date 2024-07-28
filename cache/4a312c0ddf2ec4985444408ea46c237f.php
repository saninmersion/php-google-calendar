<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PHP Google Calender</title>
</head>
<body>
<main class="h-screen w-screen flex justify-center">
    <div class="flex flex-col justify-center items-center">
        <h1 class="mb-6 font-serif text-4xl font-bold tracking-tighter text-black md:text-8xl lg:text-6xl">
            PHP Google Calender
        </h1>
        <p class="mx-auto text-lg leading-snug text-slate-500">
            View and manage you google calendar events right from the website.
        </p>
        <div class="flex w-full mt-6 max-w-7xl lg:justify-center">
            <div class="mt-3 rounded-lg sm:mt-0">
                <a href="<?php echo e($url); ?>" class="inline-flex items-center px-8 py-3 text-lg text-white transition-all duration-500 ease-in-out transform bg-black border-2 border-black rounded-lg md:mb-2 lg:mb-0 hover:border-white hover:bg-slate-500 focus:ring-2 ring-offset-current ring-offset-2">
                    Login with Google
                </a>
            </div>
        </div>
    </div>
</main>
</body>
</html>
<?php /**PATH /Users/sandipshrestha/Projects/Sandip/PHP/php-google-calendar/views/home.blade.php ENDPATH**/ ?>