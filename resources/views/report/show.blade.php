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
        <div class="bg-gray-300 p-8 h-screen">
            <div class="w-3/5 m-auto mt-8">
                <h1 class="text-2xl font-bold text-center mb-8">日報詳細</h1>
                @if (session('message'))
                    {{ session('message') }}
                @endif
                <div class="bg-white p-8 mb-4 rounded-md shadow-lg">
                    <div class="flex justify-between items-center mb-4 border-b pb-2">
                        <h2 class="text-xl font-bold">
                            {{ $report->site_name }}
                        </h2>
                        <div class="text-right">
                            <h3 class="font-bold">{{ $report->working_day }}</h3>
                            <p class="text-gray-500">作業責任者: {{ $report->user->name }}</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex justify-end text-gray-500 mb-2">
                            <p>開始時間: {{ $report->start_time }}</p>
                            <p class="ml-4">終了時間: {{ $report->end_time }}</p>
                        </div>
                        <div class="flex justify-end text-gray-500 mb-2">
                            <div>
                                <h4 class="text-lg font-bold mb-1">作業メンバー</h4>
                                <ul>
                                    @foreach ($report->users as $user)
                                        <li>・{{ $user->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="mb-4">
                            @if ($report->image_path)
                                <img src="{{ Storage::url($report->image_path) }}" alt="現場画像"
                                    class="w-3/12 h-auto m-auto rounded-md">
                            @endif
                        </div>
                        <div class="border-t p-2 border">
                            <p>{!! nl2br($report->body) !!}</p>
                        </div>
                        <div class="mt-4 flex justify-end">
                            @if ($report->user->id === Auth::id())
                                <x-primary-button>
                                    <a href="{{ route('report.edit', $report) }}">更新</a>
                                </x-primary-button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
</x-app-layout>
