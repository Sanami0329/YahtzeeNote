<div class="overflow-x-auto mx-auto">
    <form wire:submit="save">
        <div class="flex justify-center gap-0">
            {{-- score name&description --}}
            <table class="w-auto border-collapse border-1 border-gray-600 font-normal text-gray-800">
                {{-- Column Headers --}}
                <thead>
                    <tr class="h-10 bg-white">
                        <th class="min-w-48 border border-gray-600 text-left font-semibold"></th>
                        <th class="min-w-60 border border-gray-600 text-center font-semibold">How to Score</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Upper Section --}}
                    @foreach([
                    ['name' => 'Ones', 'dice' => '⚀', 'desc' => 'Count and add only Ones'],
                    ['name' => 'Twos', 'dice' => '⚁', 'desc' => 'Count and add only Twos'],
                    ['name' => 'Threes', 'dice' => '⚂', 'desc' => 'Count and add only Threes'],
                    ['name' => 'Fours', 'dice' => '⚃', 'desc' => 'Count and add only Fours'],
                    ['name' => 'Fives', 'dice' => '⚄', 'desc' => 'Count and add only Fives'],
                    ['name' => 'Sixes', 'dice' => '⚅', 'desc' => 'Count and add only Sixes'],
                    ] as $row)
                    <tr class="h-10 bg-red-100">
                        <th class="min-w-48 border border-gray-600 font-semibold">
                            <div class="flex items-center px-3 gap-4">
                                <span class="w-12 text-left">{{ $row['name'] }}</span>
                                <span class="text-3xl font-light">{{ $row['dice'] }}</span>
                            </div>
                        </th>
                        <td class="border border-gray-600 px-3">
                            {{ $row['desc'] }}
                        </td>
                    </tr>
                    @endforeach

                    {{-- Upper Totals --}}
                    @foreach ([
                    ['name' => 'UPPER SCORE', 'desc' => ''],
                    ['name' => 'BONUS', 'desc' => 'Score 35 if upper-score ≧ 63'],
                    ['name' => 'UPPER TOTAL', 'desc' => ''],
                    ] as $item)
                        <tr class="h-10 bg-red-200">
                            <th class="min-w-48 px-3 border border-gray-600 font-semibold text-lg text-left">{{ $item['name'] }}</th>
                            <td class="min-w-60 px-3 border border-gray-600">{{ $item['desc'] }}</td>
                        </tr>
                    @endforeach


                    {{-- Lower Section --}}
                    @foreach([
                    ['name' => '3 of a Kind', 'desc' => 'Add total of all dice'],
                    ['name' => '4 of a Kind', 'desc' => 'Add total of all dice'],
                    ['name' => 'Full House', 'desc' => 'Score 25'],
                    ['name' => 'Small Straight', 'desc' => 'Score 30'],
                    ['name' => 'Large Straight', 'desc' => 'Score 40'],
                    ['name' => 'YAHTZEE', 'desc' => 'Score 50'],
                    ['name' => 'Chance', 'desc' => 'Total of all 5 dice'],
                    ] as $row)
                    <tr class="bg-blue-100 h-10">
                        <th class="min-w-48 px-3 border border-gray-600 text-left font-semibold">{{ $row['name'] }}</th>
                        <td class="min-w-60 px-3 border border-gray-600">{{ $row['desc'] }}</td>
                    </tr>
                    @endforeach

                    {{-- Yahtzee Bonus --}}
                    <tr class="h-16 bg-blue-100">
                        <th class="min-w-48 px-3 border border-gray-600 text-left font-semibold">YAHTZEE BONUS</th>
                        <td class="min-w-60 px-3 border border-gray-600">Score 100 each</td>
                    </tr>

                    {{-- Lower Total --}}
                    <tr class="h-10 bg-blue-200">
                        <th class="min-w-48 px-3 border border-gray-600 text-left font-semibold text-lg">LOWER TOTAL</th>
                        <td class="min-w-60 px-3 border border-gray-600"></td>
                    </tr>

                    {{-- Grand Total --}}
                    <tr class="h-16 bg-yellow-200 border-t-4 border-double border-gray-600 font-bold text-xl">
                        <th class="min-w-48 py-4 px-3 border border-gray-600 text-left font-bold">GRAND TOTAL</th>
                        <td class="min-w-60 p-4 px-3 border border-gray-600 font-bold"></td>
                    </tr>
                </tbody>
            </table>

            {{-- Score Columns --}}
            <div class="flex">
                @foreach($players as $player)
                @php
                $key = 'score-column-' . $player['id'];
                @endphp
                <div wire:key="{{ $key }}">
                    <livewire:score-column
                        :key="$key"
                        :play-id="$playId"
                        :player-id="$player['id']"
                        :player-name="$player['name']" />
                </div>
                @endforeach
            </div>
        </div>
        <div class="flex items-center justify-center mt-6 mb-2 gap-8">
            <!-- <flux:button wire:click="" class="w-24 text-lg font-semibold">中止</flux:button> -->
            <flux:button type="submit" class="w-24 text-lg font-semibold" variant="primary" color="yellow">登録</flux:button>
            <!-- <flux:button wire:click="resetScore" class="w-24 text-lg font-semibold">リセット</flux:button> -->
        </div>
    </form>
    <script>
        // バリデーションエラーのアラート表示
        window.addEventListener('show-validation-error', (event) => {
            alert(event.detail.error); // detailでカスタムイベントのデータを受け取る
        });
    </script>
</div>
