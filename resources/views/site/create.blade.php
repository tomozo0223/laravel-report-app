<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">現場登録</h1>
    </x-slot:header>
    <div class="max-w-screen-lg md:w-2/5 w-96 m-auto p-4 rounded">
        <form action="{{ route('site.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-2">
                <label for="name" class="block text-sm font-semibold text-gray-600">現場名:</label>
                <input type="text" name="name" id="name" class="w-full p-2 border rounded-md"
                    value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="address" class="block text-sm font-semibold text-gray-600">現場住所:</label>
                <input type="text" name="address" id="address" class="w-full p-2 border rounded-md"
                    value="{{ old('address') }}">
                @error('address')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="text-right">
                <x-primary-button class="bg-blue-500">
                    登録
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
