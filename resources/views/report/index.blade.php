<x-app-layout>
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>日報一覧</title>
    </head>

    <body>
        <x-reports.layout title="日報一覧">
            @if (session('message'))
                <p class="text-red-500 font-bold">{{ session('message') }}
                </p>
            @endif
            <table class="w-4/5 m-auto border border-gray-600">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200 border-b text-left">ID</th>
                        <th class="py-2 px-4 bg-gray-200 border-b text-left">日付</th>
                        <th class="py-2 px-4 bg-gray-200 border-b text-left">現場名</th>
                        <th class="py-2 px-4 bg-gray-200 border-b text-left">作業責任者</th>
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
            {{ $reports->links() }}
        </x-reports.layout>
    </body>

    </html>
</x-app-layout>
