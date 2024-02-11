<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-600 pb-2">社員一覧</h1>
    </x-slot:header>
    <div class="m-auto w-4/5 max-w-screen-lg">
        <table class="w-full m-auto border border-gray-600">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-left">ID</th>
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-left">名前</th>
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-left">メールアドレス</th>
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-left">雇用状態</th>
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-center">登録日</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr class="hover:bg-gray-100 cursor-pointer {{ $index % 2 === 1 ? 'bg-blue-100' : '' }}"
                        onclick="location.href='{{ route('user.show', $user) }}'">
                        <td class="py-2 px-4 border-b text-left">{{ $user->id }}</td>
                        <td class="py-2 px-4 border-b text-left">{{ $user->name }}
                        </td>
                        <td class="py-2 px-4 border-b text-left">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b text-left">
                            @if ($user->isEnrollment())
                                在籍
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b text-center">{{ $user->created_at->format('Y年m月d日') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
