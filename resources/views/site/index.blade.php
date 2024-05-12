<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">現場一覧</h1>
    </x-slot:header>
    <div class="max-w-screen-lg md:w-4/5 w-96 m-auto p-4 rounded">
        <x-primary-button class="mb-4 bg-blue-500">
            <a href="{{ route('site.create') }}">現場登録</a>
        </x-primary-button>
        @if (session('message'))
            <p class="text-red-600">{{ session('message') }}</p>
        @endif
        <table class="w-full m-auto border border-gray-600 bg-white">
            <thead>
                <tr class="text-sm md:text-base">
                    <th class="p-2 md:py-2 md:px-4 bg-blue-600 border-b text-white text-left">現場名</th>
                    <th class="p-2 md:py-2 md:px-4 bg-blue-600 border-b text-white text-left">現場住所</th>
                    <th class="p-2 md:py-2 md:px-4 bg-blue-600 border-b text-white text-left">登録日</th>
                    <th class="p-2 md:py-2 md:px-4 bg-blue-600 border-b text-white text-center">操作</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sites as $index => $site)
                    <tr class="text-sm md:text-base hover:bg-gray-100 {{ $index % 2 === 1 ? 'bg-blue-100' : '' }}">
                        <td class="w-1/4 text-xs md:text-base p-2 md:py-2 md:px-4 border-b text-left font-bold">
                            {{ $site->name }}
                        </td>
                        <td
                            class="w-1/4 p-1 md:py-2 md:px-4 border-b text-left font-bold max-w-0 overflow-hidden text-ellipsis whitespace-nowrap	">
                            {{ $site->address }}
                        </td>
                        <td class="w-1/4 text-xs md:text-base p-2 md:py-2 md:px-4 border-b text-left font-bold">
                            {{ $site->created_at->format('Y-m-d') }}
                        </td>
                        <td class="w-1/4 text-xs md:text-base p-2 md:py-2 md:px-4 border-b text-center font-bold">
                            <x-update-button class="inline-block">
                                <a href="{{ route('site.edit', ['site' => $site->id]) }}">
                                    編集
                                </a>
                            </x-update-button>
                            <form action="#" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <x-danger-button>
                                    削除
                                </x-danger-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <p>現場はありません。</p>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $sites->links() }}
        </div>
    </div>
</x-app-layout>
