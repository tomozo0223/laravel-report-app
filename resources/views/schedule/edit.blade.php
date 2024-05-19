<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">予定更新</h1>
    </x-slot:header>
    <div class="max-w-screen-lg md:w-4/5 w-96 m-auto md:p-0 p-4">
        <form action="{{ route('schedule.update', $schedule) }}" method="POST" class="mb-8">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label for="site_id" class="block text-sm font-semibold text-gray-600">現場:</label>
                <select name="site_id" id="site_id">
                    @foreach ($sites as $site)
                        <option value="{{ $site->id }}" @selected($schedule->site->id === $site->id)>{{ $site->name }}
                        </option>
                    @endforeach
                </select>
                @error('site_name')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="working_day" class="block text-sm font-semibold text-gray-600">作業予定日:</label>
                <input type="date" name="working_day" id="working_day" class="w-full p-2 border rounded-md"
                    value="{{ $schedule->working_day }}">
                @error('working_day')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600 mb-2">作業メンバー:</label>
                <div class="grid md:grid-cols-8 grid-cols-2  gap-4">
                    @foreach ($users as $index => $user)
                        <label class="flex items-center">
                            <input type="checkbox" name="member_id[{{ $index }}]" value="{{ $user->id }}"
                                class="form-checkbox h-4 w-4 text-green-600 border-gray-300 rounded"
                                @checked(in_array($user->id, old('member_id', $schedule->users->pluck('id')->toArray())))>
                            <span class="ml-2 text-sm text-gray-700">{{ $user->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('member_id')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="work_details" class="block text-sm font-semibold text-gray-600">作業内容:</label>
                <textarea name="work_details" id="work_details" cols="30" rows="10" class="w-full p-2 border rounded-md"
                    placeholder="作業内容を記入してください">{{ $schedule->work_details }}</textarea>
                @error('work_details')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="text-right">
                <x-primary-button class="bg-green-500">
                    更新
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
