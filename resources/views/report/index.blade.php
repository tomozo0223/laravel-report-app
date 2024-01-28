<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">日報一覧</h1>
    </x-slot:header>
    <div class="w-4/5 m-auto">
        @if (session('message'))
            <p class="text-red-500 font-bold">{{ session('message') }}
            </p>
        @endif
        <table class="w-full m-auto border border-gray-600 bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-blue-300 border-b text-left">ID</th>
                    <th class="py-2 px-4 bg-blue-300 border-b text-left">日付</th>
                    <th class="py-2 px-4 bg-blue-300 border-b text-left">現場名</th>
                    <th class="py-2 px-4 bg-blue-300 border-b text-left">作業責任者</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b text-left">{{ $report->id }}</td>
                        <td class="py-2 px-4 border-b text-left"><a
                                href="{{ route('report.show', $report) }}"><strong>{{ $report->working_day }}</strong></a>
                        </td>
                        <td class="py-2 px-4 border-b text-left">{{ $report->site_name }}</td>
                        <td class="py-2 px-4 border-b text-left">{{ $report->user->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $reports->links() }}
</x-app-layout>
