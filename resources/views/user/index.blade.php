<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-600 pb-2">社員一覧</h1>
    </x-slot:header>
    <div class="m-auto md:w-4/5 w-96 max-w-screen-lg">
        <table class="w-full m-auto border border-gray-600">
            <thead>
                <tr class="text-xs md:text-base">
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-left">ID</th>
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-left">名前</th>
                    <th class="hidden md:table-cell py-2 px-4 bg-blue-600 border-b text-white text-left">メールアドレス</th>
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-left">役割</th>
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-left">雇用状態</th>
                    <th class="py-2 px-4 bg-blue-600 border-b text-white text-center">登録日</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr class="text-xs md:text-base hover:bg-gray-100 cursor-pointer {{ $index % 2 === 1 ? 'bg-blue-100' : '' }}"
                        onclick="location.href='{{ route('user.show', $user) }}'">
                        <td class="py-2 px-4 border-b text-left">{{ $user->id }}</td>
                        <td class="py-2 px-4 border-b text-left">{{ $user->name }}</td>
                        <td class="hidden md:table-cell py-2 px-4 border-b text-left">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b text-left">{{ $user->role === 1 ? '一般' : '管理者' }}</td>
                        <td class="py-2 px-4 border-b text-left">
                            @if ($user->isEnrollment())
                                在籍
                            @else
                                退職
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b text-center">{{ $user->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
