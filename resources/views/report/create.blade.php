<x-app-layout>
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>日報登録</title>
    </head>

    <body>
        <div class="bg-gray-300 p-8">
            <div class="w-3/5 m-auto mt-8">
                <h1 class="text-2xl font-bold text-center mb-8">業務日報登録</h1>
                <div class="max-w-md mx-auto p-8 bg-white border rounded-md shadow-md">
                    <form action="#" method="GET">
                        <div class="mb-4">
                            <label for="site_name" class="block text-sm font-semibold text-gray-600">現場名:</label>
                            <input type="text" name="site_name" id="site_name" class="w-full p-2 border rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="working_day" class="block text-sm font-semibold text-gray-600">作業日:</label>
                            <input type="date" name="working_day" id="working_day"
                                class="w-full p-2 border rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="start_time" class="block text-sm font-semibold text-gray-600">開始時間:</label>
                            <input type="time" name="start_time" id="start_time"
                                class="w-full p-2 border rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="end" class="block text-sm font-semibold text-gray-600">終了時間:</label>
                            <input type="time" name="end" id="end" class="w-full p-2 border rounded-md">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-600">作業メンバー:</label>
                            @foreach ($users as $user)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="users_id[]" value="{{ $user->id }}" class="mr-2">
                                    {{ $user->name }}
                                </label>
                            @endforeach
                        </div>
                        <div class="mb-4">
                            <label for="body" class="block text-sm font-semibold text-gray-600">作業内容:</label>
                            <textarea name="body" id="body" cols="30" rows="5" class="w-full p-2 border rounded-md"
                                placeholder="作業内容を記入してください"></textarea>
                        </div>
                        <div class="text-right">
                            <x-primary-button>
                                登録
                            </x-primary-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </body>

    </html>
</x-app-layout>