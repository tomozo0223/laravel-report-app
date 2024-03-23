<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-600 pb-2">日報一覧</h1>
    </x-slot:header>
    <div class="max-w-screen-lg md:w-4/5 w-96 m-auto">
        <div class="mb-4">
            <form action="{{ route('report.index') }}">
                <input type="text" name="keyword" placeholder="現場名" value={{ Request::query('keyword') }}>
                <input type="date" name="report_date" value={{ Request::query('report_date') }}>
                <x-primary-button class="mt-2">検索</x-primary-button>
                <x-primary-button class="bg-green-500 mt-2"><a href="{{ route('report.index') }}">クリア</a></x-primary-button>
            </form>
        </div>
        @if (session('message'))
            <p class="text-red-500 font-bold">{{ session('message') }}
            </p>
        @endif
        <table class="w-full
                    m-auto border border-gray-600 bg-white">
            <thead>
                <tr class="text-sm md:text-base">
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-left">日付</th>
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-left">現場名</th>
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-left">作業責任者</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $index => $report)
                    <tr class="text-sm md:text-base hover:bg-gray-100 cursor-pointer {{ $index % 2 === 1 ? 'bg-blue-100' : '' }}"
                        onclick="location.href='{{ route('report.show', $report) }}'">
                        <td class="py-2 px-4 border-b text-left font-bold">
                            {{ $report->working_day }}
                        </td>
                        <td class="py-2 px-4 border-b text-left font-bold">
                            {{ $report->site_name }}
                        </td>
                        <td class="py-2 px-4 border-b text-left font-bold">
                            {{ $report->user->name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $reports->links() }}
        </div>
    </div>
</x-app-layout>
