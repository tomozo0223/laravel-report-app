<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">予定一覧</h1>
    </x-slot:header>
    <div class="max-w-screen-lg md:w-4/5 w-96 m-auto p-4 rounded">
        <table class="w-full m-auto border border-gray-600 bg-white">
            <thead>
                <tr class="text-sm md:text-base">
                    <th class="p-2 md:py-2 md:px-4 bg-green-600 border-b text-white text-left">現場名</th>
                    <th class="p-2 md:py-2 md:px-4 bg-green-600 border-b text-white text-left">住所</th>
                    <th class="p-2 md:py-2 md:px-4 bg-green-600 border-b text-white text-left">作業予定日</th>
                    <th class="p-2 md:py-2 md:px-4 bg-green-600 border-b text-white text-left">メンバー</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($schedules as $index => $schedule)
                    <tr
                        class="text-sm md:text-base hover:bg-gray-100 cursor-pointer {{ $index % 2 === 1 ? 'bg-green-100' : '' }}">
                        {{-- onclick="location.href='{{ route('schedule.show', $schedule) }}'"> --}}
                        <td class="w-1/4 text-xs md:text-base p-2 md:py-2 md:px-4 border-b text-left font-bold">
                            {{ $schedule->site->name }}
                        </td>
                        <td
                            class="w-1/4 text-xs md:text-base p-2 md:py-2 md:px-4 border-b text-left font-bold  max-w-0 overflow-hidden text-ellipsis whitespace-nowrap	">
                            {{ $schedule->work_details }}
                        </td>
                        <td class="w-1/4 text-xs md:text-base p-2 md:py-2 md:px-4 border-b text-left font-bold">
                            {{ $schedule->working_day }}
                        </td>
                        <td class="w-1/4 text-xs md:text-base p-2 md:py-2 md:px-4 border-b text-left font-bold">
                            @foreach ($schedule->users as $user)
                                {{ Str::limit($user->name, 5, '') }}
                            @endforeach
                        </td>
                    </tr>
                @empty
                    <p>予定はありません。</p>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $schedules->links() }}
        </div>
    </div>
</x-app-layout>
