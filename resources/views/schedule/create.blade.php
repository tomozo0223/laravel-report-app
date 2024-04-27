<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">予定登録</h1>
    </x-slot:header>
    <div class="max-w-screen-lg md:w-4/5 w-96 m-auto md:p-0 p-4">
        <form action="{{ route('schedule.store') }}" method="POST" class="mb-8">
            @csrf
            <div class="mb-4">
                <label for="site_name" class="block text-sm font-semibold text-gray-600">現場:</label>
                <input type="text" name="site_name" id="site_name" class="w-full p-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-semibold text-gray-600">住所:</label>
                <input type="text" name="address" id="address" class="w-full p-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600">作業メンバー:</label>
                <div class="grid md:grid-cols-8 grid-cols-2  gap-4">
                    @foreach ($users as $user)
                        <label class="flex items-center">
                            <input type="checkbox" name="member_id[]" value="{{ $user->id }}"
                                class="form-checkbox h-4 w-4 text-green-600 border-gray-300 rounded">
                            <span class="ml-2 text-sm text-gray-700">{{ $user->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="mb-4">
                <label for="working_day" class="block text-sm font-semibold text-gray-600">作業予定日:</label>
                <input type="date" name="working_day" id="working_day" class="w-full p-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label for="work_details" class="block text-sm font-semibold text-gray-600">作業内容:</label>
                <textarea name="work_details" id="work_details" cols="30" rows="10" class="w-full p-2 border rounded-md"
                    placeholder="作業内容を記入してください"></textarea>
            </div>
            <div class="text-right">
                <x-primary-button class="bg-blue-500">
                    登録
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
