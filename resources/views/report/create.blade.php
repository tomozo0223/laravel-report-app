<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">日報登録</h1>
    </x-slot:header>
    <div class="w-4/5 m-auto">
        <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="site_name" class="block text-sm font-semibold text-gray-600">現場名:</label>
                @error('site_name')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
                <input type="text" name="site_name" id="site_name" class="w-full p-2 border rounded-md"
                    value="{{ old('site_name') }}">
            </div>
            <div class="mb-4">
                <label for="working_day" class="block text-sm font-semibold text-gray-600">作業日:</label>
                @error('working_day')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
                <input type="date" name="working_day" id="working_day"class="w-full p-2 border rounded-md"
                    value="{{ old('working_day') }}">
            </div>
            <div class="mb-4">
                <label for="start_time" class="block text-sm font-semibold text-gray-600">開始時間:</label>
                @error('start_time')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
                <input type="time" name="start_time" id="start_time" class="w-full p-2 border rounded-md"
                    value="{{ old('start_time') }}">
            </div>
            <div class="mb-4">
                <label for="end_time" class="block text-sm font-semibold text-gray-600">終了時間:</label>
                @error('end_time')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
                <input type="time" name="end_time" id="end_time" class="w-full p-2 border rounded-md"
                    value="{{ old('end_time') }}">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600">作業メンバー:</label>
                @foreach ($users as $index => $user)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="user_id[{{ $index }}]" value="{{ $user->id }}"
                            class="mr-2" @checked(old("user_id.$index"))>
                        {{ $user->name }}
                    </label>
                @endforeach
            </div>
            <div class="mt-4">
                <label for="image" class="block text-sm font-medium text-gray-700">
                    画像を選択
                </label>
                <input type="file" name="image" id="image">
            </div>
            <div class="mb-4 mt-4">
                <label for="body" class="block text-sm font-semibold text-gray-600">作業内容:</label>
                @error('body')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
                <textarea name="body" id="body" cols="30" rows="5" class="w-full p-2 border rounded-md"
                    placeholder="作業内容を記入してください">{{ old('body') }}</textarea>
            </div>
            <div class="text-right mb-8">
                <x-primary-button class="bg-blue-600">
                    登録
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
