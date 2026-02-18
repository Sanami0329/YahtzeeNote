<div class="overflow-x-auto">
    <form wire:submit="checkBeforeSave" class="h-auto mx-auto mt-10">
        <!-- table -->
        <div class="min-w-full mx-auto flex md:justify-center gap-0 mb-12 md:mb-2">
            {{-- score name&description --}}
            <table class="border-collapse border border-zinc-600 font-normal text-zinc-600">
                {{-- Column Headers --}}
                <thead>
                    <tr class="h-10 bg-white">
                        <th class="min-w-48 px-4 border border-zinc-600 text-center font-medium">{{ __('スコア項目') }}</th>
                        <th class="min-w-66 px-4 border border-zinc-600 text-center font-normal">{{ __('得点ルール') }}</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Upper Section --}}
                    @foreach([
                    ['name' => 'エース', 'eng_name' => 'Ones', 'dice' => '⚀', 'desc' => '1の目の合計', 'eng_desc' => 'Count and add only Ones'],
                    ['name' => 'ツー', 'eng_name' => 'Twos', 'dice' => '⚁', 'desc' => '2の目の合計', 'eng_desc' => 'Count and add only Twos'],
                    ['name' => 'スリー', 'eng_name' => 'Threes', 'dice' => '⚂', 'desc' => '3の目の合計', 'eng_desc' => 'Count and add only Threes'],
                    ['name' => 'フォー', 'eng_name' => 'Fours', 'dice' => '⚃', 'desc' => '4の目の合計', 'eng_desc' => 'Count and add only Fours'],
                    ['name' => 'ファイブ', 'eng_name' => 'Fives', 'dice' => '⚄', 'desc' => '5の目の合計', 'eng_desc' => 'Count and add only Fives'],
                    ['name' => 'シックス', 'eng_name' => 'Sixes', 'dice' => '⚅', 'desc' => '6の目の合計', 'eng_desc' => 'Count and add only Sixes'],
                    ] as $row)
                    <tr class="h-10 bg-brand-red-100">
                        <th class="min-w-48 border border-zinc-600">
                            <div class="flex items-center px-4 gap-2">
                                <span class="w-16 overflow-hidden text-left font-medium">{{ __($row['name']) }}</span>
                                <span class="text-3xl font-thin">{{ $row['dice'] }}</span>
                            </div>
                        </th>
                        <td class="min-w-66 border border-zinc-600 px-4 font-normal">{{ __($row['desc']) }}</td>
                    </tr>
                    @endforeach

                    {{-- Upper Totals --}}
                    @foreach ([
                    ['name' => '上段スコア合計', 'eng_name' => 'UPPER SCORE', 'desc' => '', 'eng_desc' => ''],
                    ['name' => 'ボーナス', 'eng_name' => 'BONUS', 'desc' => '上段スコア合計が63点以上で35点', 'eng_desc' => 'Score 35 if upper-score ≧ 63'],
                    ['name' => '上段合計', 'eng_name' => 'UPPER TOTAL', 'desc' => '', 'eng_desc' => ''],
                    ] as $item)
                    <tr class="h-10 bg-brand-red-300">
                        <th class="min-w-48 px-4 border border-zinc-600 text-left font-semibold">{{ __($item['name']) }}</th>
                        <td class="min-w-66 px-4 border border-zinc-600 font-normal">{{ __($item['desc']) }}</td>
                    </tr>
                    @endforeach


                    {{-- Lower Section --}}
                    @foreach([
                    ['name' => '3コンボ', 'eng_name' => '3 of a Kind', 'desc' => '同じ目が3つ以上で全部の合計', 'eng_desc' => 'Add total of all dice'],
                    ['name' => '4コンボ', 'eng_name' => '4 of a Kind', 'desc' => '同じ目が4つ以上で全部の合計', 'eng_desc' => 'Add total of all dice'],
                    ['name' => 'フルハウス', 'eng_name' => 'Full House', 'desc' => '同じ目が3つと2つで25点', 'eng_desc' => 'Score 25'],
                    ['name' => 'スモール・ストレート', 'eng_name' => 'Small Straight', 'desc' => '4つの連続した目が揃えば30点', 'eng_desc' => 'Score 30'],
                    ['name' => 'ラージ・ストレート', 'eng_name' => 'Large Straight', 'desc' => '5つの連続した目が揃えば30点', 'eng_desc' => 'Score 40'],
                    ['name' => 'YAHTZEE（ヤッツィー）', 'eng_name' => 'YAHTZEE', 'desc' => '同じ目が5つで50点', 'eng_desc' => 'Score 50'],
                    ['name' => 'チャンス', 'eng_name' => 'Chance', 'desc' => '全部の目の合計', 'eng_desc' => 'Total of all 5 dice'],
                    ] as $row)
                    <tr class="bg-brand-blue-100 h-10">
                        <th class="min-w-48 px-4 border border-zinc-600 text-left font-medium">{{ $row['name'] }}</th>
                        <td class="min-w-66 px-4 border border-zinc-600 font-normal">{{ __($row['desc']) }}</td>
                    </tr>
                    @endforeach

                    {{-- Yahtzee Bonus --}}
                    <tr class="h-16 bg-brand-blue-100">
                        <th class="min-w-48 px-4 border border-zinc-600 text-left font-medium">{{ __('YAHTZEEボーナス') }}</th>
                        <td class="min-w-66 px-4 border border-zinc-600 font-normal">{{ __('2回目以降は1回100点') }}</td>
                    </tr>

                    {{-- Lower Total --}}
                    <tr class="h-10 bg-brand-blue-300">
                        <th class="min-w-48 px-4 border border-zinc-600 text-left font-semibold">{{ __('下段合計') }}</th>
                        <td class="min-w-66 px-4 border border-zinc-600 font-normal"></td>
                    </tr>

                    {{-- Grand Total --}}
                    <tr class="h-14 bg-brand-yellow-400 border-t-4 border-double border-zinc-600">
                        <th class="min-w-48 p-4 border border-zinc-600 text-left font-bold text-lg">{{ __('合計') }}</th>
                        <td class="min-w-66 p-4 border border-zinc-600 font-normal">{{ __('上段合計＋下段合計') }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- Score Columns --}}
            {{-- kebab-case→camelCaseに自動変換されて、score-columnのlivewireコンポーネントに値が渡される --}}
            <div class="flex">
                @foreach ($playerArray as $i => $player)
                <livewire:plays.score-column
                    :key="'score-column-' . $player['playerNumber']"
                    :play-id="$playId"
                    :player-Data="$player" />
                @endforeach
            </div>
        </div>

        <!-- button -->
        <div class="w-fit mx-auto rounded-lg fixed bottom-0 right-0 left-0 md:static my-4 py-2 px-4 flex justify-center items-center gap-4">
            <flux:button wire:click="quitGame"
                wire:navigate
                wire:confirm="ゲームを中止しますか？"
                :loading="false"
                class="w-18 md:w-20 !bg-white !text-red-600 hover:!bg-red-500 hover:!text-zinc-50 hover:!font-bold">中止</flux:button>
            <flux:button wire:click="resetScores"
                wire:confirm="スコアを保存せずにリセットしますか？"
                :loading="false"
                class="w-18 md:w-20 !bg-white hover:!bg-zinc-100 !text-zinc-600 hover:!font-bold">リセット</flux:button>
            <flux:button type="submit"
                :loading="false"
                class="w-18 md:w-20 !bg-green-100 !text-zinc-600 hover:!font-bold">保存</flux:button>
        </div>
    </form>
    <script>
        // エラーのアラート表示()
        window.addEventListener('show-error', (event) => {
            alert(event.detail.error); // detailでカスタムイベントのデータを受け取る
        });

        window.addEventListener('confirm-save', (event) => {
            if (confirm('スコアを保存しますか？')) {
                Livewire.dispatch('request-save');
            }
        });
    </script>
</div>