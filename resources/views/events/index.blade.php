<x-app-layout>
    <div class="pl-64 pr-64 p-5">
        <div class="bg-white dark:bg-black overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white bg-cover bg-no-repeat bg-center rounded-md shadow-lg relative" style="background-image: url('{{ $event->image }}');">
                <!-- Dark Tint Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-60"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 z-10">
                    <!-- Left Side  -->
                    <div class="left-side mb-6 pb-8 col-span-1">
                        <div class="relative p-4">
                            <h1 class="text-2xl font-bold">{{ $event->title }}</h1>
                            <p class="text-sm font-bold mt-5">{{ $event->description }}</p>
                            <div class="flex mt-16 items-center">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <p class="text-sm">{{ $event->location }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Side -->
                    <div class="right-side mb-6 pb-8 col-span-1 flex justify-end mr-20">
                        <div class="relative p-4">
                            <div class="w-auto">
                                <div class="flex flex-col items-center mb-10">
                                    <h1 class="text-3xl font-bold mb-5">Bestellen</h1>
                                    <span class="font-bold">{{ date('d M Y', strtotime($event->date)) }}</span>
                                    <span class="font-bold">{{ date('H:i', strtotime($event->time)) }}</span>
                                
                                    <form action="{{route('tickets.purchase')}}" method="POST" class="flex items-center mt-5">
                                        @csrf
                                        <input type="hidden" name="event_id" value="{{ $event->id }}" />
                                        <div class="flex flex-col">
                                            <div class="mb-3">
                                                <button type="button" data-action="decrement" class="px-3 py-1 border rounded-2xl border-transparent bg-red-800">-</button>
                                                
                                                <input type="text" id="ticketCount" name="ticket_count" value="1" readonly class="mx-2 text-center border-transparent border rounded-md w-16 bg-black" data-price="{{ $event->price }}" />
                                                
                                                <button type="button" data-action="increment" class="px-3 py-1 border rounded-2xl border-transparent bg-green-800">+</button>
                                            </div>
                                            <!-- Display Total Price -->
                                            <span id="totalPrice" class="ml-4 text-lg font-bold mt-6 mb-3 justify-center">&euro; {{ $event->price }}</span>
                                            
                                            @if (Auth::check())
                                            <button type="submit" class="text-center px-5 py-2 ml-4 border border-transparent rounded-md bg-blue-600 text-white">Buy</button>
                                            @else
                                            <a href="{{route('login')}}" class="text-center px-5 py-2 ml-4 border border-transparent rounded-md bg-blue-600 text-white">Login</a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
