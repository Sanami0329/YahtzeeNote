<div>
    {{-- Score Table --}}
    <table class="w-36 font-medium text-gray-800 border-collapse border-1 border-gray-600">
        {{-- Column Headers --}}
        <thead>
            <tr class="h-12 bg-white">
                <th class="border border-gray-600 text-center w-60">{{ $playerName }}</th>
            </tr>
        </thead>

        <tbody>
            {{-- Upper Section --}}
            @foreach([
            ['name' => 'Ones', 'field' => 'ones', 'step' => 1, 'max' => 5],
            ['name' => 'Twos', 'field' => 'twos', 'step' => 2, 'max' => 10],
            ['name' => 'Threes', 'field' => 'threes', 'step' => 3, 'max' => 15],
            ['name' => 'Fours', 'field' => 'fours', 'step' => 4, 'max' => 20],
            ['name' => 'Fives', 'field' => 'fives', 'step' => 5, 'max' => 25],
            ['name' => 'Sixes', 'field' => 'sixes', 'step' => 6, 'max' => 30],
            ] as $row)
            <tr class="h-12 bg-red-100">
                <td class="border border-gray-600">
                    <div class="flex items-center justify-center gap-2 px-3">
                        <flux:button
                            size="xs"
                            wire:click="decrement('{{ $row['field'] }}', {{ $row['step'] }})"
                            class="bg-gray-200! text-gray-600!">
                            -
                        </flux:button>
                        <flux:input
                            type="text"
                            size="xs"
                            wire:model.live="{{ $row['field'] }}"
                            class="w-16 bg-white border-1 border-gray-600"
                            style="text-align: center; color: var(--color-gray-600)"
                            min="0"
                            max="{{ $row['max'] }}" />
                        <flux:button
                            size="xs"
                            wire:click="increment('{{ $row['field'] }}', {{ $row['step'] }}, {{ $row['max'] }})"
                            class="bg-gray-200! text-gray-600!">
                            +
                        </flux:button>
                    </div>
                </td>
            </tr>
            @endforeach

            {{-- Upper Totals --}}
            <tr class="h-12 bg-red-200">
                <td class="border border-gray-600 text-center px-3">{{ $this->getUpperScore() }}</td>
            </tr>
            <tr class="h-12 bg-red-200">
                <td class="border border-gray-600 text-center px-3">{{ $this->getBonus() }}</td>
            </tr>
            <tr class="h-12 bg-red-200">
                <td class="border border-gray-600 text-center px-3">{{ $this->getUpperTotal() }}</td>
            </tr>

            {{-- Lower Section --}}
            @foreach([
            ['name' => '3 of a Kind', 'field' => 'threeKind', 'step' => 1, 'max' => 30, 'desc' => 'Add total of all dice'],
            ['name' => '4 of a Kind', 'field' => 'fourKind', 'step' => 1, 'max' => 30, 'desc' => 'Add total of all dice'],
            ['name' => 'Full House', 'field' => 'fullHouse', 'step' => 25, 'max' => 25, 'desc' => 'Score 25'],
            ['name' => 'Small Straight', 'field' => 'smallStraight', 'step' => 30, 'max' => 30, 'desc' => 'Score 30'],
            ['name' => 'Large Straight', 'field' => 'largeStraight', 'step' => 40, 'max' => 40, 'desc' => 'Score 40'],
            ['name' => 'YAHTZEE', 'field' => 'yahtzee', 'step' => 50, 'max' => 50, 'desc' => 'Score 50'],
            ['name' => 'Chance', 'field' => 'chance', 'step' => 1, 'max' => 30, 'desc' => 'Total of all 5 dice'],
            ] as $row)
            <tr class="h-12 bg-blue-100">
                <td class="border border-gray-600">
                    <div class="flex items-center justify-center gap-2 px-3">
                        <flux:button
                            size="xs"
                            wire:click="decrement('{{ $row['field'] }}', {{ $row['step'] }})"
                            class="bg-gray-200! text-gray-600!">
                            -
                        </flux:button>
                        <flux:input
                            type="text"
                            size="xs"
                            wire:model.live="{{ $row['field'] }}"
                            class="w-16 bg-white border-1 border-gray-600"
                            style="text-align: center; color: var(--color-gray-600)"
                            min="0"
                            max="{{ $row['max'] }}" />
                        <flux:button
                            size="xs"
                            wire:click="increment('{{ $row['field'] }}', {{ $row['step'] }}, {{ $row['max'] }})"
                            class="bg-gray-200! text-gray-600!">
                            +
                        </flux:button>
                    </div>
                </td>
            </tr>
            @endforeach

            {{-- Yahtzee Bonus --}}
            <tr class="h-16 bg-blue-100">
                <td class="border border-gray-600">
                    <div class="flex flex-col items-center gap-2 px-3">
                        <div class="flex gap-2">
                            @for($i = 0; $i < 5; $i++)
                                <flux:checkbox 
                                    wire:model.live="yahtzeeBonusItems.{{ $i }}" 
                                    class="bg-white border border-gray-600" />
                            @endfor
                        </div>
                        <div class="text-center text-gray-600 px-3">
                            {{ $this->getYahtzeeBonus() }}
                        </div>
                    </div>
                </td>
            </tr>

            {{-- Lower Total --}}
            <tr class="h-12 bg-blue-200">
                <td class="border border-gray-600 text-center px-3">{{ $this->getLowerTotal() }}</td>
            </tr>

            {{-- Grand Total --}}
            <tr class="h-16 bg-yellow-200 text-lg border-t-4 border-double border-gray-600">
                <td class="border border-gray-600 text-center px-3">{{ $this->getGrandTotal() }}</td>
            </tr>
        </tbody>
    </table>

</div>