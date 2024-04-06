<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">社員詳細</h1>
    </x-slot:header>
    <div class="max-w-screen-lg md:w-4/5 w-96 m-auto">
        @can('update', $user)
            <form action="{{ route('admin.update', $user) }}" method="POST">
                @csrf
                @method('PATCH')
                <table class="w-full m-auto border border-gray-600">
                    <tbody>
                        <tr class="md:text-base text-xs">
                            <th class="bg-blue-200 py-2 px-4 border border-gray-600">社員番号</th>
                            <td class="py-2 px-4 border border-gray-600">{{ $user->id }}</td>
                        </tr>
                        <tr class="md:text-base text-xs">
                            <th class="bg-blue-200 py-2 px-4 border border-gray-600">名前</th>
                            <td class="py-2 px-4 border border-gray-600"><input type="text" name="name"
                                    value="{{ $user->name }}"></td>
                        </tr>
                        <tr class="md:text-base text-xs">
                            <th class="bg-blue-200 py-2 px-4 border border-gray-600">メールアドレス</th>
                            <td class="py-2 px-4 border border-gray-600"><input type="email" name="email"
                                    value="{{ $user->email }}"></td>
                        </tr>
                        <tr class="md:text-base text-xs">
                            <th class="bg-blue-200 py-2 px-4 border border-gray-600">雇用情報</th>
                            <td class="py-2 px-4 border border-gray-600">
                                <select name="employmentStatus">
                                    <option value="1" {{ $user->isEnrollment() ? 'selected' : '' }}>在籍</option>
                                    <option value="0" {{ !$user->isEnrollment() ? 'selected' : '' }}>退職</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="md:text-base text-sm">
                            <th class="bg-blue-200 py-2 px-4 border border-gray-600">登録日</th>
                            <td class="py-2 px-4 border border-gray-600">{{ $user->created_at->format('Y年m月d日') }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-2 flex justify-end">
                    <x-primary-button class="bg-green-600">
                        更新
                    </x-primary-button>
            </form>
        </div>
    @endcan
    </div>
</x-app-layout>
