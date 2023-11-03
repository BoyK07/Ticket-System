<x-app-layout>
    <div class="p-5">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 lg:grid-cols-5 gap-4">
                    @foreach ($events as $event)
                    @if ($event->date >= now()->toDateString())
                        <a href="{{ route('event.show', $event->id) }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-2 border-white block">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <img src="{{ $event->image }}" alt="{{ $event->title }}" class="rounded-md shadow-lg imageHover">
                                <div class="mt-4">
                                    <h2 class="text-lg font-bold">{{ $event->title }}</h2>
                                    <p class="text-sm">{{ Str::limit($event->description, 150) }}</p>
                                    <p class="text-xs mt-2">{{ date('H:i', strtotime($event->time)) }} | {{ $event->location }}</p>
                                </div>
                            </div>
                        </a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
