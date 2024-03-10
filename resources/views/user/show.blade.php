<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">社員詳細</h1>
    </x-slot:header>
    <div class="m-auto w-4/5 max-w-screen-lg">
        <table class="w-full m-auto border border-gray-600">
            <tbody>
                <tr class="md:text-base text-sm">
                    <th class="bg-blue-200 py-2 px-4 border border-gray-600">社員番号</th>
                    <td class="py-2 px-4 border border-gray-600">{{ $user->id }}</td>
                </tr>
                <tr class="md:text-base text-sm">
                    <th class="bg-blue-200 py-2 px-4 border border-gray-600">名前</th>
                    <td class="py-2 px-4 border border-gray-600">{{ $user->name }}</td>
                </tr>
                <tr class="md:text-base text-sm">
                    <th class="bg-blue-200 py-2 px-4 border border-gray-600">メールアドレス</th>
                    <td class="py-2 px-4 border border-gray-600">{{ $user->email }}</td>
                </tr>
                <tr class="md:text-base text-sm">
                    <th class="bg-blue-200 py-2 px-4 border border-gray-600">雇用情報</th>
                    <td class="py-2 px-4 border border-gray-600">
                        @if ($user->isEnrollment())
                            在籍
                        @endif
                    </td>
                </tr>
                <tr class="md:text-base text-sm">
                    <th class="bg-blue-200 py-2 px-4 border border-gray-600">登録日</th>
                    <td class="py-2 px-4 border border-gray-600">{{ $user->created_at->format('Y年m月d日') }}</td>
                </tr>
            </tbody>
        </table>
        @if ($user->id === Auth::id())
            <div class="mt-2 flex justify-end">
                <x-primary-button class="bg-green-600">
                    <a href="{{ route('profile.edit') }}">
                        編集
                    </a>
                </x-primary-button>
            </div>
        @endif
    </div>
</x-app-layout>
