<x-app-layout>
    <div class="p-5">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center">
                <div class="flex flex-col absolute p-6 dark:text-white font-bold">
                    <span class="font-2xl">Reservering nummer: #{{$reservation->id}}</span>
                    <span class="font-2xl">Totaalbedrag: &euro;{{$reservation->tickets->count() * $reservation->event->price}}</span>
                </div>
                <div class="mt-24 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6">
                    @foreach ($reservation->tickets as $ticket)
                        <div class="relative border-white border-2 rounded-md shadow-lg">
                            <div class="absolute inset-0 bg-black bg-opacity-50 rounded-md"></div>
                            <img src="{{$ticket->reservation->event->image}}" alt="{{$ticket->reservation->event->title}}" class="rounded-md">
                            <a href="{{route('event.show', $ticket->reservation->event)}}" class="absolute inset-0 flex justify-center items-center">
                                <span class="font-bold text-4xl text-white z-10"># {{$ticket->id}}</span>
                            </a>
                            <div class="p-6">
                                <div class="mt-4">
                                    <h2 class="text-lg font-bold">{{ $ticket->reservation->event->title }}</h2>
                                    <p class="text-xs mt-2 flex items-center">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        {{ $ticket->reservation->event->location }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
