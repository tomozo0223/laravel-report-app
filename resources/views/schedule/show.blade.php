<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">予定詳細</h1>
    </x-slot:header>
    <div class="max-w-screen-lg md:w-4/5 w-96 m-auto p-4 rounded">
        @if (session('message'))
            <p class="text-red-600">{{ session('message') }}</p>
        @endif
        <div class="border p-4">
            <div class="border-b border-gray-300 mb-4">
                <p class="text-black font-bold">現場名</p>
                <h2 class="text-xl font-bold">{{ $schedule->site->name }}</h2>
            </div>
            <div class="border-b border-gray-300 mb-4">
                <p class="text-black font-bold">住所</p>
                <p>{{ $schedule->site->address }}</p>
            </div>
            <div class="border-b border-gray-300 mb-4">
                <p class="text-black font-bold">作業予定日</p>
                <p>{{ $schedule->working_day }}</p>
            </div>
            <div class="border-b border-gray-300 mb-4">
                <p class="text-black font-bold">メンバー</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                    @foreach ($schedule->users as $user)
                        <p>{{ $user->name }}</p>
                    @endforeach
                </div>
            </div>
            <div class="border-b border-gray-300 mb-4 drop-shadow-lg">
                <p class="text-black mb-2 font-bold">作業内容</p>
                <p class="border p-2">{!! nl2br($schedule->work_details) !!}</p>
            </div>
            <div class="flex justify-end">
                <x-primary-button class="bg-green-600">
                    <a href="{{ route('schedule.edit', $schedule) }}">編集</a>
                </x-primary-button>
                <form action="{{ route('schedule.destroy', ['schedule' => $schedule->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-primary-button class="bg-red-600 ml-2">
                        削除
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
