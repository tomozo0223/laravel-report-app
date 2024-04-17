<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">日報詳細</h1>
    </x-slot:header>
    <div class="max-w-screen-lg md:w-4/5 w-96 m-auto border-2 border-blue-300 p-4 rounded">
        @if (session('message'))
            <p class="text-red-500 font-bold">{{ session('message') }}</p>
        @endif
        <div class="flex justify-between items-center mb-4 border-b-4 border-blue-300 pb-2">
            <h2 class="md:text-2xl text-base font-bold">
                {{ $report->site->name }}
            </h2>
            <div class="text-right">
                <h3 class="text-gray-500 md:text-base text-xs">{{ $report->working_day }}</h3>
                <p class="md:text-base text-xs font-bold ">作業責任者: {{ $report->user->name }}</p>
            </div>
        </div>
        <div class="mb-4">
            <div class="flex justify-start mb-2">
                <p class="md:text-base text-xs">開始時間: {{ $report->start_time }}</p>
                <p class="ml-4 md:text-base text-xs">終了時間: {{ $report->end_time }}</p>
            </div>
            <div class="mb-2">
                <h4 class="md:text-lg text-base font-bold mb-1">作業メンバー</h4>
                <ul class="flex md:text-base text-xs">
                    @foreach ($report->users as $user)
                        <li>・{{ $user->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mb-4">
                @if ($report->image_path)
                    <img src="{{ asset(Storage::url($report->image_path)) }}" alt="現場画像"
                        class="w-3/12 h-auto m-auto rounded-md">
                @endif
            </div>
            <p class="font-bold px-2 md:text-lg text-base">作業内容</p>
            <div class="border-b-2 border-blue-300 p-2">
                <p class="md:text-base text-xs">{!! nl2br($report->body) !!}</p>
            </div>
            <div class="mt-4 flex justify-end">
                @can('update', $report)
                    <x-primary-button class="bg-green-600 md:px-4 px-2">
                        <a href="{{ route('report.edit', $report) }}">編集</a>
                    </x-primary-button>
                @endcan
                @can('delete', $report)
                    <form action="{{ route('report.destroy', $report) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-primary-button class="bg-red-600 ml-2 md:px-4 px-2">
                            削除
                        </x-primary-button>
                    </form>
                @endcan
            </div>
        </div>

        <div class="w-full">
            <p class="font-semibold md:text-lg text-base">コメント投稿</p>
            @if (session('commentMessage'))
                <p class="text-red-500 font-bold">{{ session('commentMessage') }}</p>
            @endif
            <form action="{{ route('comment.store', $report) }}" method="POST">
                @csrf
                <div class="block w-full">
                    @error('body')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                    <input type="text" name="body" id="body" class="w-full rounded">
                </div>
                <div class="mt-2 flex justify-end">
                    <x-primary-button class="bg-blue-600 md:px-4 px-2 text-xs">
                        投稿
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div class="bg-white p-4 mb-4 rounded shadow-lg">
            <p class="font-semibold mb-4 md:text-lg text-base">コメント一覧<i class="fa-regular fa-comment ml-1"></i></p>
            @if (session('deleteMessage'))
                <p class="text-red-500 font-bold">{{ session('deleteMessage') }}</p>
            @endif
            @forelse ($comments as $comment)
                <div class="border p-4 mb-4">
                    <div class="flex justify-between items-center">
                        <h3 class="mb-2 font-bold md:text-base text-xs">投稿者: {{ $comment->user->name }}</h3>
                        <p class="text-right md:text-base text-xs">{{ $comment->created_at }}</p>
                    </div>
                    <hr>
                    <p class="text-gray-700 mt-2 md:text-base text-xs">{{ $comment->body }}</p>
                    @can('delete', $comment)
                        <form action="{{ route('comment.destroy', $comment) }}" method="POST" class="text-right">
                            @csrf
                            @method('DELETE')
                            <x-primary-button class="bg-red-600 md:px-4 px-2 text-xs">
                                削除
                            </x-primary-button>
                        </form>
                    @endcan

                </div>
            @empty
                <p>コメントはありません。</p>
            @endforelse
            {{ $comments->links() }}
        </div>
    </div>
</x-app-layout>
