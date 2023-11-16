<x-app-layout>
    <div class="p-5">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center">
                <!-- Buttons for filtering -->
                <div class="absolute">
                    <button class="mx-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-300" data-reservation-type="future">Toekomst</button>
                    <button class="mx-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition duration-300" data-reservation-type="historical">Verleden</button>
                    <button class="mx-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700 transition duration-300" data-reservation-type="expired">Verlopen</button>
                </div>
                <div class="mt-16 reservations-container">
                    <!-- Future Reservations Section -->
                    <div id="future-reservations" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6">
                        @foreach ($future as $reservation)
                            <a href="{{ route('reservation.show', $reservation) }}" class="relative block mb-6 pb-8">
                                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="relative">
                                        <!-- Dark Overlay -->
                                        <div class="absolute inset-0 bg-black bg-opacity-60 rounded-md"></div>
                                        
                                        <!-- Event Image -->
                                        <img src="{{ $reservation->event->image }}" alt="{{ $reservation->event->title }}" class="rounded-md">
                                        
                                        <!-- Text Over Image -->
                                        <div class="absolute inset-0 flex flex-col justify-center items-center p-4">
                                            <h1 class="text-white text-2xl font-bold text-center">{{ $reservation->event->title }}</h1>
                                            <span class="text-white text-3xl font-bold"># {{ $reservation->id }}</span>
                                            <span class="text-white text-lg font-bold"> {{date('d M Y', strtotime($reservation->event->date))}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Historical Reservations Section -->
                    <div id="historical-reservations" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6 hidden">
                        @foreach ($historical as $reservation)
                            <a href="{{ route('reservation.show', $reservation) }}" class="relative block mb-6 pb-8">
                                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="relative">
                                        <!-- Dark Overlay -->
                                        <div class="absolute inset-0 bg-black bg-opacity-60 rounded-md"></div>
                                        
                                        <!-- Event Image -->
                                        <img src="{{ $reservation->event->image }}" alt="{{ $reservation->event->title }}" class="rounded-md">
                                        
                                        <!-- Text Over Image -->
                                        <div class="absolute inset-0 flex flex-col justify-center items-center p-4">
                                            <h1 class="text-white text-2xl font-bold text-center">{{ $reservation->event->title }}</h1>
                                            <span class="text-white text-3xl font-bold"># {{ $reservation->id }}</span>
                                            <span class="text-white text-lg font-bold"> {{date('d M Y', strtotime($reservation->event->date))}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Expired Reservations Section -->
                    <div id="expired-reservations" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6 hidden">
                        @foreach ($expired as $reservation)
                            <a href="{{ route('reservation.show', $reservation) }}" class="relative block mb-6 pb-8">
                                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="relative">
                                        <!-- Dark Overlay -->
                                        <div class="absolute inset-0 bg-black bg-opacity-60 rounded-md"></div>
                                        
                                        <!-- Event Image -->
                                        <img src="{{ $reservation->event->image }}" alt="{{ $reservation->event->title }}" class="rounded-md">
                                        
                                        <!-- Text Over Image -->
                                        <div class="absolute inset-0 flex flex-col justify-center items-center p-4">
                                            <h1 class="text-white text-2xl font-bold text-center">{{ $reservation->event->title }}</h1>
                                            <span class="text-white text-3xl font-bold"># {{ $reservation->id }}</span>
                                            <span class="text-white text-lg font-bold"> {{date('d M Y', strtotime($reservation->event->date))}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

