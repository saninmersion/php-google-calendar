<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PHP Google Calender</title>
</head>
<body class="h-screen w-screen">
<header class='flex shadow py-4 px-4 sm:px-10 bg-white font-[sans-serif] min-h-[70px] tracking-wide relative z-50'>
    <div class='flex flex-wrap items-center justify-end gap-5 w-full'>
        <div class='flex max-lg:ml-auto space-x-3'>
            <a href="/logout" class='w-full py-2 px-4 bg-indigo-600 text-white font-bold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2'>
                Logout
            </a>
        </div>
    </div>
</header>
<main class="flex justify-center py-8">
    <div class="flex flex-col justify-center items-center w-[80vw]">
        <h1 class="mb-6 font-serif text-6xl font-bold tracking-tighter text-black">
            Events List
        </h1>
        <div class="w-full flex flex-nowrap justify-between gap-8">
            {{--Add Event Form--}}
            <div class="w-1/2 bg-white p-4 shadow-lg">
                <h2 class="text-xl font-bold mb-4">Add Event</h2>
                <form id="eventForm" method="POST" action="/events">
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" id="title" name="title" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               value="Test event 4">
                    </div>
                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-700">Event Date</label>
                        <input type="date"
                               name="event_date"
                               id="event_date"
                               class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               value="2024-07-28"
                        >
                    </div>

                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-700">Start Time - End Time</label>
                        <div class="flex justify-between gap-4 items-center nowrap">
                            <input type="time" name="start_time" id="start_time" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                   value="07:00:00"
                            >
                            <input type="time" name="end_time" id="end_time" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                   value="17:00:00"
                            >
                        </div>
                    </div>
                    <input type="text" hidden="" id="timezoneInput" name="timezone">
                    <button type="submit"
                            class="w-full py-2 px-4 bg-indigo-600 text-white font-bold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Add Event
                    </button>
                </form>
            </div>

            {{--Event List--}}
            <div class="w-1/2 min-h-64 overflow-y-scroll bg-white p-4 shadow-lg">
                <ul class="space-y-4">
                    @foreach($events as $event)
                        <li class="border-b pb-2 relative">
                            <h2 class="text-lg font-bold">{{$event['summary']}}</h2>
                            <p class="text-sm text-gray-500">Date: {{$event['eventDateTime']}}</p>
                            <a href="/events/delete?id={{$event['id']}}" class="absolute right-4 top-2 cursor-pointer hover:underline">
                                Delete
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</main>
<script>
    document.getElementById("timezoneInput").value = Intl.DateTimeFormat().resolvedOptions().timeZone
</script>
</body>
</html>
