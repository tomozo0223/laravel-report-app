<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">現場更新</h1>
    </x-slot:header>
    <div class="max-w-screen-lg md:w-2/5 w-96 m-auto p-4 rounded">
        <form action="{{ route('site.update', $site) }}" method="POST" class="mb-4">
            @csrf
            @method('PATCH')
            <div class="mb-2">
                <label for="name" class="block text-sm font-semibold text-gray-600">現場名:</label>
                <input type="text" name="name" id="name" class="w-full p-2 border rounded-md"
                    value="{{ old('name', $site->name) }}">
                @error('name')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="address" class="block text-sm font-semibold text-gray-600">現場住所:</label>
                <input type="text" name="address" id="address" class="w-full p-2 border rounded-md"
                    value="{{ old('address', $site->address) }}">
                @error('address')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="text-right">
                <x-primary-button class="bg-blue-500">
                    更新
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
