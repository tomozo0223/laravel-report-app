<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">ユーザー一覧</h1>
    </x-slot:header>
    <div class="m-auto w-4/5 max-w-screen-lg">
        <table class="w-full m-auto border border-gray-600">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-blue-300 border-b text-left">ID</th>
                    <th class="py-2 px-4 bg-blue-300 border-b text-left">名前</th>
                    <th class="py-2 px-4 bg-blue-300 border-b text-left">メールアドレス</th>
                    <th class="py-2 px-4 bg-blue-300 border-b text-left">雇用状態</th>
                    <th class="py-2 px-4 bg-blue-300 border-b text-center">登録日</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-100 cursor-pointer" onclick="location.href='#'">
                        <td class="py-2 px-4 border-b text-left">{{ $user->id }}</td>
                        <td class="py-2 px-4 border-b text-left">{{ $user->name }}
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
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
