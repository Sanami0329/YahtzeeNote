<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Potta+One&display=swap" rel="stylesheet">

</head>

<<body>
    <div class="overflow-x-auto">
        <form wire:submit="checkBeforeSave" class="h-dvh sm:h-auto mx-auto mt-6 my-6 py-6">
            <!-- table -->
            <div class="min-w-full mx-auto flex md:justify-center gap-0">
                {{-- score name&description --}}
                <table class="border-collapse border-1 border-zinc-600 font-normal text-zinc-800">
                    {{-- Column Headers --}}
                    <thead>
                        <tr class="h-10 bg-white">
                            <th class="min-w-48 border border-zinc-600 text-left font-medium"></th>
                            <th class="min-w-60 border border-zinc-600 text-center font-normal">{{ __('スコアの説明') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Upper Section --}}
                        @foreach([
                        ['name' => 'Ones', 'dice' => '⚀', 'desc' => '1の目の合計', 'eng_desc' => 'Count and add only Ones'],
                        ['name' => 'Twos', 'dice' => '⚁', 'desc' => '2の目の合計', 'eng_desc' => 'Count and add only Twos'],
                        ['name' => 'Threes', 'dice' => '⚂', 'desc' => '3の目の合計', 'eng_desc' => 'Count and add only Threes'],
                        ['name' => 'Fours', 'dice' => '⚃', 'desc' => '4の目の合計', 'eng_desc' => 'Count and add only Fours'],
                        ['name' => 'Fives', 'dice' => '⚄', 'desc' => '5の目の合計', 'eng_desc' => 'Count and add only Fives'],
                        ['name' => 'Sixes', 'dice' => '⚅', 'desc' => '6の目の合計', 'eng_desc' => 'Count and add only Sixes'],
                        ] as $row)
                        <tr class="h-10 bg-brand-red-100">
                            <th class="min-w-48 border border-zinc-600">
                                <div class="flex items-center px-4 gap-4">
                                    <span class="w-12 text-left font-medium">{{ __($row['name']) }}</span>
                                    <span class="text-3xl font-thin">{{ $row['dice'] }}</span>
                                </div>
                            </th>
                            <td class="border border-zinc-600 px-4 font-normal">{{ __($row['desc']) }}</td>
                        </tr>
                        @endforeach

                        {{-- Upper Totals --}}
                        @foreach ([
                        ['name' => 'UPPER SCORE', 'desc' => '', 'eng_desc' => ''],
                        ['name' => 'BONUS', 'desc' => '上段合計が63点以上で35点', 'eng_desc' => 'Score 35 if upper-score ≧ 63'],
                        ['name' => 'UPPER TOTAL', 'desc' => '', 'eng_desc' => ''],
                        ] as $item)
                        <tr class="h-10 bg-brand-red-300">
                            <th class="min-w-48 px-4 border border-zinc-600 text-left font-semibold">{{ __($item['name']) }}</th>
                            <td class="min-w-60 px-4 border border-zinc-600 font-normal">{{ __($item['desc']) }}</td>
                        </tr>
                        @endforeach


                        {{-- Lower Section --}}
                        @foreach([
                        ['name' => '3 of a Kind', 'desc' => '同じ目が3つ以上で全部の合計', 'eng_desc' => 'Add total of all dice'],
                        ['name' => '4 of a Kind', 'desc' => '同じ目が4つ以上で全部の合計', 'eng_desc' => 'Add total of all dice'],
                        ['name' => 'Full House', 'desc' => '同じ目が3つと2つで25点', 'eng_desc' => 'Score 25'],
                        ['name' => 'Small Straight', 'desc' => '連番4つで30点', 'eng_desc' => 'Score 30'],
                        ['name' => 'Large Straight', 'desc' => '連番5つで40点', 'eng_desc' => 'Score 40'],
                        ['name' => 'YAHTZEE', 'desc' => '同じ目が5つで50点', 'eng_desc' => 'Score 50'],
                        ['name' => 'Chance', 'desc' => '全部の目の合計', 'eng_desc' => 'Total of all 5 dice'],
                        ] as $row)
                        <tr class="bg-brand-blue-100 h-10">
                            <th class="min-w-48 px-4 border border-zinc-600 text-left font-medium">{{ $row['name'] }}</th>
                            <td class="min-w-60 px-4 border border-zinc-600 font-normal">{{ __($row['desc']) }}</td>
                        </tr>
                        @endforeach

                        {{-- Yahtzee Bonus --}}
                        <tr class="h-16 bg-brand-blue-100">
                            <th class="min-w-48 px-4 border border-zinc-600 text-left font-medium">YAHTZEE BONUS</th>
                            <td class="min-w-60 px-4 border border-zinc-600 font-normal">{{ __('2回目以降は1回100点') }}</td>
                        </tr>

                        {{-- Lower Total --}}
                        <tr class="h-10 bg-brand-blue-300">
                            <th class="min-w-48 px-4 border border-zinc-600 text-left font-semibold">LOWER TOTAL</th>
                            <td class="min-w-60 px-4 border border-zinc-600 font-normal"></td>
                        </tr>

                        {{-- Grand Total --}}
                        <tr class="h-14 bg-brand-yellow-300 border-t-4 border-double border-zinc-600 text-lg">
                            <th class="min-w-48 p-4 border border-zinc-600 text-left font-bold">GRAND TOTAL</th>
                            <td class="min-w-60 p-4 border border-zinc-600 font-normal"></td>
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

            <!-- button (固定表示) -->
            <div class="md:w-full md:mx-auto fixed md:static bottom-0 right-0 left-0 my-6">
                <div class="flex justify-center items-center gap-4">
                    <flux:button wire:click="quitGame"
                        wire:navigate
                        wire:confirm="ゲームを中止しますか？"
                        class="w-20 !bg-white text-lg !text-red-500 font-medium hover:!font-bold hover:!text-white hover:!bg-red-500">中止</flux:button>
                    <flux:button wire:click="resetScores"
                        wire:navigate
                        wire:confirm="スコアを保存せずにリセットしますか？"
                        class="w-20 !bg-white text-lg !text-zinc-900 font-medium hover:!font-bold hover:!bg-zinc-200">リセット</flux:button>
                    <flux:button type="submit"
                        class="w-20 !bg-brand-yellow-400 !text-zinc-900 !font-bold hover:!bg-brand-yellow-700 hover:!font-bold" variant="primary">保存</flux:button>
                </div>
            </div>
        </form>
        <script>
            // エラーのアラート表示()
            window.addEventListener('show-error', (event) => {
                alert(event.detail.error); // detailでカスタムイベントのデータを受け取る
            });
        </script>
    </div>
    </body>

</html>