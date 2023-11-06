<x-app-layout>
    <div class="p-5 flex justify-center">
        <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <form method="POST" action="{{ route('admin.events.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 gap-6 mt-4">
                        <div>
                            <label for="title" class="block text-white">Title</label>
                            <input type="text" id="title" name="title" class="mt-1 block w-full" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="date" class="block text-white">Date</label>
                            <input type="date" id="date" name="date" class="mt-1 block w-full" value="{{ old('date') }}" required>
                            @error('date')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="time" class="block text-white">Time</label>
                            <input type="time" id="time" name="time" class="mt-1 block w-full" value="{{ old('time') }}" required>
                            @error('time')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="location" class="block text-white">Location</label>
                            <input type="text" id="location" name="location" class="mt-1 block w-full" value="{{ old('location') }}" required>
                            @error('location')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="image" class="block text-white">Image URL</label>
                            <input type="text" id="image" name="image" class="mt-1 block w-full" value="{{ old('image') }}" required>
                            @error('image')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="trix-white-icons">
                            <label for="description" class="block text-black">Description</label>
                            <input id="description" type="hidden" name="description" value="{{ old('description') }}" required>
                            <trix-editor input="description" class="trix-content"></trix-editor>
                            @error('description')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="price" class="block text-white">Price</label>
                            <input type="number" id="price" name="price" class="mt-1 block w-full" value="{{ old('price') }}" required>
                            @error('price')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-lg text-white">Create Event</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
