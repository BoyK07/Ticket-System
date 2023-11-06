<x-app-layout>
    <div class="p-5">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                <div class="flex justify-between">
                    <div class="mb-4 text-left">
                        <p class="text-2xl font-bold">Evenementen</p>
                    </div>
                    @if (session()->has('succes'))
                        <div class="alert alert-success text-green-400">
                            {{session('succes')}}
                        </div>
                    @endif
                    <div class="mb-4 text-right">
                        <a href="{{ route('admin.events.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Evenement aanmaken</a>
                    </div>
                </div>
                <table class="w-full min-w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Titel</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Datum</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Tijd</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Locatie</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Beschrijving</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Prijs</th>
                            <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Aanpassen</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        @foreach ($events as $event)
                            <tr class="hover:bg-gray-700">     
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ date('H:i', strtotime($event->time)) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->location }}</td>
                                <td class="px-6 py-4">{!! Str::limit(html_entity_decode(strip_tags($event->description, '<b><i><strong><em>')), 50) !!}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $event->price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('admin.events.edit', $event->id) }}">
                                        <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
