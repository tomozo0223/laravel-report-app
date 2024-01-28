<x-app-layout>
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ユーザー一覧ページ</title>
    </head>

    <body>
        <div class="bg-gray-300 h-screen">
            <div class="w-screen m-auto mt-8">
                <h1 class="text-2xl font-bold text-center mb-8">ユーザー一覧</h1>
                <div class="w-4/5 mx-auto p-8 bg-white border rounded-md shadow-md">
                    <table class="w-4/5 m-auto border border-gray-600">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 bg-gray-200 border-b text-left">ID</th>
                                <th class="py-2 px-4 bg-gray-200 border-b text-left">名前</th>
                                <th class="py-2 px-4 bg-gray-200 border-b text-left">メールアドレス</th>
                                <th class="py-2 px-4 bg-gray-200 border-b text-left">雇用状態</th>
                                <th class="py-2 px-4 bg-gray-200 border-b text-center">登録日</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-100">
                                    <td class="py-2 px-4 border-b text-left">{{ $user->id }}</td>
                                    <td class="py-2 px-4 border-b text-left"><a href="#">{{ $user->name }}</a>
                                    </td>
                                    <td class="py-2 px-4 border-b text-left">{{ $user->email }}</td>
                                    <td class="py-2 px-4 border-b text-left">
                                        @if ($user->isEnrollment())
                                            在籍
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b text-center">{{ $user->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </body>

    </html>
</x-app-layout>
