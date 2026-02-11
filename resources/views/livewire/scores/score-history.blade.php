<div class="">
    <div class="overflow-x-auto bg-zinc-50 max-w-4xl min-w-2xl h-dvh sm:h-auto sm:mt-14 my-6 mx-auto py-6 px-10 text-zinc-600">

        <nav aria-label="breadcrumb" class="text-sm text-zinc-500">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ url('/home') }}" class="hover:underline">{{ __('ホーム') }}</a>
                </li>
                <li class="text-zinc-500">></li>
                <li class="font-medium">{{ __('スコア履歴') }}</li>
            </ol>
        </nav>

        <h1 class="m-4 font-semibold text-lg text-center">スコア履歴</h1>

        <div class="min-w-full bg-brand-yellow-200 p-4">
            <!-- テーブル全体のコンテナ -->
            <div class="rounded-lg overflow-x-auto">
                <div class="grid grid-cols-[128px_128px_168px_1fr] gap-y-2">
                    <!-- ヘッダー行 -->
                    <div class="contents col-span-4">
                        <div class="bg-brand-yellow-400 py-2 text-center rounded-l-lg">
                            日付
                            <button wire:click="sort('created_at')" class="text-xs ml-1">
                                @if($sortBy === 'created_at')
                                {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                                @else
                                △
                                @endif
                            </button>
                        </div>
                        <div class="bg-brand-yellow-400 py-2 text-center">
                            自己スコア
                            <button wire:click="sort('total')" class="text-xs ml-1">
                                @if($sortBy === 'total')
                                {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                                @else
                                △
                                @endif
                            </button>
                        </div>
                        <div class="bg-brand-yellow-400 py-2 text-center">勝者</div>
                        <div class="bg-brand-yellow-400 py-2 text-left md:text-center rounded-r-lg">参加メンバー</div>
                    </div>

                    <!-- ボディ部分 -->
                    @foreach ($scoreHistories as $score)
                    <div class="contents">
                        <span class="whitespace-nowrap flex items-center justify-center bg-white border-y border-l border-brand-yellow-400 py-2 text-center rounded-l-lg">{{ $score->created_at->format('Y-m-d') }}</span>
                        <span class="whitespace-nowrap flex items-center justify-center bg-white border-y border-brand-yellow-400 py-2 text-center">{{ $score->total }}</span>
                        @php
                        $highestScorePlayer = $score->play->scores->sortByDesc('total')->first();
                        @endphp
                        <span class="whitespace-nowrap flex items-center justify-center bg-white border-y border-brand-yellow-400 py-2 text-center">
                            @if ($highestScorePlayer)
                            {{ $highestScorePlayer->player->name }}
                            @endif
                        </span>
                        <span class="whitespace-nowrap flex items-center justify-center bg-white border-y border-r border-brand-yellow-400 py-2 text-left md:text-center rounded-r-lg">
                            {{ $score->play->scores->where('player_id', '!=', auth()->id())->pluck('player.name')->implode('、') }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ページネーション --}}
        <div class="mt-4 mb-4">
            {{ $scoreHistories->links('vendor.livewire.tailwind') }}
        </div>
    </div>
</div>