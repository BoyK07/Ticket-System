<x-app-layout>
    <div class="p-5">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            <div class="mb-4">
                <input type="text" id="eventSearch" placeholder="Zoek naar events..." class="w-full border-2 border-gray-300 h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none dark:bg-gray-800 dark:text-white">
            </div>
            <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6">
                    @foreach ($events as $event)
                        <div class="event-card relative bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-2 border-white block mb-6 pb-8">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <img src="{{ $event->image }}" alt="{{ $event->title }}" class="rounded-md shadow-lg imageHover">
                                <div class="mt-4">
                                    <h2 class="event-title text-lg font-bold">{{ $event->title }}</h2>
                                    <p class="text-sm">{!! Str::limit(html_entity_decode(strip_tags($event->description, '<b><i><strong><em>')), 150) !!}</p>
                                    <p class="text-xs mt-2 flex items-center">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        {{ $event->location }}
                                    </p>
                                </div>
                            </div>
                            <div class="absolute bottom-0 left-0 w-full bg-blue-500 text-white text-md p-2 flex justify-between">
                                <span>{{ date('d M Y', strtotime($event->date)) }}</span>
                                <span>{{ date('H:i', strtotime($event->time)) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
