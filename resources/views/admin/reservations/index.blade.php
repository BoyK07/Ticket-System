<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="p-5">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            @if(session('success'))
                <div class="pl-10 pt-5 text-xl font-bold text-center text-green-600">
                    {{ session('success') }}
                </div>
                @endif
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center">
                <table class="w-full min-w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Titel</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Datum</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Tijd</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Locatie</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Prijs</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Scan Reset</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Verwijderen</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        @foreach($reservations as $reservation)
                            <tr class="hover:bg-gray-700">      
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{route('reservation.show', $reservation)}}">
                                        {{ $reservation->event->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ date('d M Y', strtotime($reservation->event->date)) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ date('H:i', strtotime($reservation->event->time)) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->event->location }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ ($reservation->tickets->count()) * ($reservation->event->price) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button class="reset-scan-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-reservation-id="{{ $reservation->id }}">Reset Scan</button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.reservations.delete', $reservation) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Verwijderen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
