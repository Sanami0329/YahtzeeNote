<div class="flex justify-center sm:pt-8">
    <div class="overflow-x-auto max-w-4xl min-w-2xl h-dvh sm:h-auto bg-gray-50 px-10 py-4 text-zinc-800">

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

        <div class="min-w-full bg-brand-blue-100 p-4">
            <!-- テーブル全体のコンテナ -->
            <div class="rounded-lg overflow-x-auto">
                <div class="grid grid-cols-[128px_128px_168px_1fr] gap-y-2">
                    <!-- ヘッダー行 -->
                    <div class="col-span-4 contents">
                        <div class="bg-brand-blue-300 py-2 text-center rounded-l-lg">
                            日付
                            <button wire:click="sort('created_at')" class="text-xs ml-1">
                                @if($sortBy === 'created_at')
                                    {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                                @else
                                    △
                                @endif
                            </button>
                        </div>
                        <div class="bg-brand-blue-300 py-2 text-center">
                            自己スコア
                            <button wire:click="sort('total')" class="text-xs ml-1">
                                @if($sortBy === 'total')
                                    {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                                @else
                                    △
                                @endif
                            </button>
                        </div>
                        <div class="bg-brand-blue-300 py-2 text-center">勝者</div>
                        <div class="bg-brand-blue-300 py-2 text-left rounded-r-lg">参加メンバー</div>
                    </div>

                    <!-- ボディ部分 -->
                    @foreach ($scoreHistories as $score)
                        <div class="contents">
                            <span class="bg-white py-2 whitespace-nowrap text-center flex items-center justify-center rounded-l-lg">{{ $score->created_at->format('Y-m-d') }}</span>
                            <span class="bg-white py-2 whitespace-nowrap text-center flex items-center justify-center">{{ $score->total }}</span>
                            @php
                                $highestScorePlayer = $score->play->scores->sortByDesc('total')->first();
                            @endphp
                            <span class="bg-white py-2 whitespace-nowrap text-center flex items-center justify-center">
                                @if ($highestScorePlayer)
                                    {{ $highestScorePlayer->player->name }}
                                @endif
                            </span>
                            <span class="bg-white py-2 whitespace-nowrap text-left flex items-center rounded-r-lg">
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
