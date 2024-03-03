<x-app-layout>
    <x-slot:header>
        <h1 class="inline border-b-4 border-blue-300 pb-2">日報詳細</h1>
    </x-slot:header>
    <div class="max-w-screen-lg w-4/5 m-auto border-2 border-blue-300 p-4 rounded">
        @if (session('message'))
            <p class="text-red-500 font-bold">{{ session('message') }}</p>
        @endif
        <div class="flex justify-between items-center mb-4 border-b-4 border-blue-300 pb-2">
            <h2 class="text-2xl font-bold">
                {{ $report->site_name }}
            </h2>
            <div class="text-right">
                <h3 class="font-bold text-xl">{{ $report->working_day }}</h3>
                <p class="text-gray-500 text-xl">作業責任者: {{ $report->user->name }}</p>
            </div>
        </div>
        <div class="mb-4">
            <div class="flex justify-start mb-2">
                <p>開始時間: {{ $report->start_time }}</p>
                <p class="ml-4">終了時間: {{ $report->end_time }}</p>
            </div>
            <div class="mb-2">
                <h4 class="text-lg font-bold mb-1">作業メンバー</h4>
                <ul class="flex">
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
            <p class="font-bold px-2">作業内容</p>
            <div class="border-b-2 border-blue-300 p-2">
                <p>{!! nl2br($report->body) !!}</p>
            </div>
            <div class="mt-4 flex justify-end">
                @if ($report->user->id === Auth::id())
                    <x-primary-button class="bg-blue-600">
                        <a href="{{ route('report.edit', $report) }}">編集</a>
                    </x-primary-button>
                    <form action="{{ route('report.destroy', $report) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-primary-button class="bg-red-600 ml-2">
                            削除
                        </x-primary-button>
                    </form>
                @endif
            </div>
        </div>

        <div class="w-full">
            <p class="font-semibold">コメント投稿</p>
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
                    <x-primary-button class="bg-blue-600 px-4 text-xs">
                        投稿
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div class="bg-white p-4 mb-4 rounded shadow-lg">
            <p class="font-semibold mb-4">コメント一覧<i class="fa-regular fa-comment ml-1"></i></p>
            @if (session('deleteMessage'))
                <p class="text-red-500 font-bold">{{ session('deleteMessage') }}</p>
            @endif
            @forelse ($comments as $comment)
                <div class="border p-4 mb-4">
                    <div class="flex justify-between items-center">
                        <h3 class="mb-2 font-bold">投稿者: {{ $comment->user->name }}</h3>
                        <p class="text-right">{{ $comment->created_at }}</p>
                    </div>
                    <hr>
                    <p class="text-gray-700 mt-2">{{ $comment->body }}</p>
                    @if (Auth::id() === $comment->user->id)
                        <form action="{{ route('comment.destroy', $comment) }}" method="POST" class="text-right">
                            @csrf
                            @method('DELETE')
                            <x-primary-button class="bg-red-600 px-4 text-xs">
                                削除
                            </x-primary-button>
                        </form>
                    @endif
                </div>
            @empty
                <p>コメントはありません。</p>
            @endforelse
            {{ $comments->links() }}
        </div>
    </div>
</x-app-layout>
