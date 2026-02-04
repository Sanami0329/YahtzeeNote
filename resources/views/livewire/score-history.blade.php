<div class="pt-8">
    <div class="max-w-4xl mx-auto bg-brand-blue-200 dark:bg-gray-700">
        <h1 class="m-6 pt-4 font-semibold text-lg dark:text-white text-center">スコア履歴</h2>
        <div class="max-w-3xl min-w-sm mx-auto pb-6">
            <flux:table :paginate="$this->scoreHistories">
                <flux:table.columns>
                    <flux:table.column sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection" wire:click="sort('created_at')">日付</flux:table.column>
                    <flux:table.column sortable :sorted="$sortBy === 'total'" :direction="$sortDirection" wire:click="sort('total')">自己スコア</flux:table.column>
                    <flux:table.column>勝者</flux:table.column>
                    <flux:table.column>参加メンバー</flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @foreach ($this->scoreHistories as $score)
                        <flux:table.row :key="$score->id">
                            <flux:table.cell class="text-left whitespace-nowrap">{{ $score->created_at->format('Y-m-d') }}</flux:table.cell>
                            <flux:table.cell class="text-left whitespace-nowrap">{{ $score->total }}</flux:table.cell>
                            {{-- このゲームで一番totalが高かった人を抽出 --}}
                            @php
                                $highestScorePlayer = $score->play->scores->sortByDesc('total')->first();
                            @endphp
                            @if ($highestScorePlayer)
                                <flux:table.cell class="text-left whitespace-nowrap">{{ $highestScorePlayer->player->name }}</flux:table.cell>
                            @endif
                            {{-- 自分以外のプレーヤーを抽出 --}}
                            <flux:table.cell class="text-left whitespace-nowrap">
                                {{ $score->play->scores->where('player_id', '!=', auth()->id())->pluck('player.name')->implode('、') }}
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
        </div>
    </div>
</div>
