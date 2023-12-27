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
        <div class="bg-gray-300 p-8">
            <div class="w-3/5 m-auto mt-8">
                <h1 class="text-2xl font-bold text-center mb-8">業務日報一覧</h1>
                @foreach ($reports as $report)
                    <div class="bg-white p-8 mb-4 rounded-md shadow-md">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold"><a href="#">{{ $report->site_name }}</a></h2>
                            <div class="ml-4">
                                <p class="text-gray-500">作業責任者:{{ $report->user->name }}</p>
                                <p class="text-gray-500">作業日:{{ $report->working_day }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $reports->links() }}
            </div>
        </div>
    </body>

    </html>
</x-app-layout>
