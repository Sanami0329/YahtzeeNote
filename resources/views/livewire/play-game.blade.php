<div class="overflow-x-auto mx-auto">
    <form wire:submit="save">
        <div class="flex gap-0 border-collapse justify-center">
            {{-- score name&description --}}
            <table class="w-auto font-normal text-gray-800 border-collapse border-1 border-gray-600">
                {{-- Column Headers --}}
                <thead>
                    <tr class="bg-white h-10">
                        <th class="font-semibold border border-gray-600 min-w-48 text-left"></th>
                        <th class="font-semibold border border-gray-600 min-w-60 text-center">How to Score</th>
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
                    <tr class="bg-red-100 h-10">
                        <th class="font-semibold border border-gray-600 min-w-48">
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
                    <tr class="bg-red-200 h-10">
                        <th class="font-semibold text-lg border border-gray-600 min-w-48 px-3 text-left">UPPER SCORE</th>
                        <td class="border border-gray-600 min-w-60 px-3"></td>
                    </tr>
                    <tr class="bg-red-200 h-10">
                        <th class="font-semibold text-lg border border-gray-600 min-w-48 px-3 text-left">BONUS</th>
                        <td class="border border-gray-600 min-w-60 px-3">Score 35 if upper-score ≧ 63</td>
                    </tr>
                    <tr class="bg-red-200 h-10">
                        <th class="font-semibold text-lg border border-gray-600 min-w-48 px-3 text-left">UPPER TOTAL</th>
                        <td class="border border-gray-600 min-w-60 px-3"></td>
                    </tr>

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
                        <th class="font-semibold border border-gray-600 min-w-48 px-3 text-left">{{ $row['name'] }}</th>
                        <td class="border border-gray-600 min-w-60 px-3">{{ $row['desc'] }}</td>
                    </tr>
                    @endforeach

                    {{-- Yahtzee Bonus --}}
                    <tr class="bg-blue-100 h-16">
                        <th class="font-semibold border border-gray-600 min-w-48 px-3 text-left">YAHTZEE BONUS</th>
                        <td class="border border-gray-600 min-w-60 px-3">Score 100 each</td>
                    </tr>

                    {{-- Lower Total --}}
                    <tr class="bg-blue-200 h-10">
                        <th class="font-semibold text-lg border border-gray-600 min-w-48 px-3 text-left">LOWER TOTAL</th>
                        <td class="border border-gray-600 min-w-60 px-3"></td>
                    </tr>

                    {{-- Grand Total --}}
                    <tr class="bg-yellow-200 font-bold text-xl border-t-4 border-double border-gray-600 h-16">
                        <th class="border border-gray-600 min-w-48 py-4 px-3 text-left">GRAND TOTAL</th>
                        <td class="border border-gray-600 min-w-60 p-4 px-3"></td>
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
        @if ($errorMsg)
        <div class="flex justify-center text-red-600 font-semibold">
            {{ $errorMsg }}
        </div>
        @endif
    </form>
</div>
