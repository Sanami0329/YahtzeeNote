<div>
    {{-- Score Table --}}
    <table class="w-36 font-medium text-gray-800 border-collapse border-1 border-gray-600">
        {{-- Column Headers --}}
        <thead>
            <tr class="h-10 bg-white">
                <th class="border border-gray-600 text-center w-60">{{ $playerName }}</th>
            </tr>
        </thead>

        <tbody>
            {{-- Upper Section --}}
            @foreach([
            ['field' => 'ones'],
            ['field' => 'twos'],
            ['field' => 'threes'],
            ['field' => 'fours'],
            ['field' => 'fives'],
            ['field' => 'sixes'],
            ] as $row)
            <tr class="h-10 bg-red-100">
                <td class="border border-gray-600">
                    <div class="flex items-center justify-center gap-2 px-3">
                        <flux:button
                            size="xs"
                            wire:click="decrement('{{ $row['field'] }}')"
                            class="bg-gray-200! text-gray-600!">
                            -
                        </flux:button>
                        <flux:input
                            type="number"
                            size="xs"
                            wire:model.lazy="{{ $row['field'] }}"
                            class="w-16 bg-white border-1 border-gray-600"
                            style="text-align: center; color: var(--color-gray-600); appearance: textfield;" />
                        @error($row['field'])
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <flux:button
                            size="xs"
                            wire:click="increment('{{ $row['field'] }}')"
                            class="bg-gray-200! text-gray-600!">
                            +
                        </flux:button>
                    </div>
                </td>
            </tr>
            @endforeach

            {{-- Upper Totals --}}
            <tr class="h-10 bg-red-200">
                <td class="border border-gray-600 text-center px-3">{{ $this->getUpperScore() }}</td>
            </tr>
            <tr class="h-10 bg-red-200">
                <td class="border border-gray-600 text-center px-3">{{ $this->getBonus() }}</td>
            </tr>
            <tr class="h-10 bg-red-200">
                <td class="border border-gray-600 text-center px-3">{{ $this->getUpperTotal() }}</td>
            </tr>

            {{-- Lower Section --}}
            {{-- 3/4 of a kind --}}
            @foreach([
            ['field' => 'threeKind'],
            ['field' => 'fourKind'],
            ] as $row)
            <tr class="h-10 bg-blue-100">
                <td class="border border-gray-600">
                    <div class="flex items-center justify-center gap-2 px-3">
                        <flux:button
                            size="xs"
                            wire:click="decrement('{{ $row['field'] }}')"
                            class="bg-gray-200! text-gray-600!">
                            -
                        </flux:button>
                        <flux:input
                            type="number"
                            size="xs"
                            wire:model.lazy="{{ $row['field'] }}"
                            class="w-16 bg-white border-1 border-gray-600"
                            style="text-align: center; color: var(--color-gray-600); appearance: textfield;" />
                        @error($row['field'])
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <flux:button
                            size="xs"
                            wire:click="increment('{{ $row['field'] }}')"
                            class="bg-gray-200! text-gray-600!">
                            +
                        </flux:button>
                    </div>
                </td>
            </tr>
            @endforeach

            {{-- others --}}
            @foreach([
            ['field' => 'fullHouse'],
            ['field' => 'smallStraight'],
            ['field' => 'largeStraight'],
            ['field' => 'yahtzee'],
            ] as $row)
            <tr class="h-10 bg-blue-100">
                <td class="border border-gray-600">
                    <div class="flex items-center justify-center gap-2 px-3">
                        <flux:button
                            size="xs"
                            wire:click="decrement('{{ $row['field'] }}')"
                            class="bg-gray-200! text-gray-600!">
                            -
                        </flux:button>
                        <flux:input
                            type="number"
                            size="xs"
                            wire:model.lazy="{{ $row['field'] }}"
                            class="w-16 bg-white border-1 border-gray-600"
                            style="text-align: center; color: var(--color-gray-600); appearance: textfield;" />
                        <flux:button
                            size="xs"
                            wire:click="increment('{{ $row['field'] }}')"
                            class="bg-gray-200! text-gray-600!">
                            +
                        </flux:button>
                    </div>
                </td>
            </tr>
            @endforeach

            {{-- chance --}}
            @php
                $row = ['field' => 'chance'];
            @endphp
            <tr class="h-10 bg-blue-100">
                <td class="border border-gray-600">
                    <div class="flex items-center justify-center gap-2 px-3">
                        <flux:button
                            size="xs"
                            wire:click="decrement('{{ $row['field'] }}')"
                            class="bg-gray-200! text-gray-600!">
                            -
                        </flux:button>
                        <flux:input
                            type="number"
                            size="xs"
                            wire:model.lazy="{{ $row['field'] }}"
                            class="w-16 bg-white border-1 border-gray-600"
                            style="text-align: center; color: var(--color-gray-600); appearance: textfield;" />
                        <flux:button
                            size="xs"
                            wire:click="increment('{{ $row['field'] }}')"
                            class="bg-gray-200! text-gray-600!">
                            +
                        </flux:button>
                    </div>
                </td>
            </tr>

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
            <tr class="h-10 bg-blue-200">
                <td class="border border-gray-600 text-center px-3">{{ $this->getLowerTotal() }}</td>
            </tr>

            {{-- Grand Total --}}
            <tr class="h-16 bg-yellow-200 text-lg border-t-4 border-double border-gray-600">
                <td class="border border-gray-600 text-center px-3">{{ $this->getGrandTotal() }}</td>
            </tr>
        </tbody>
    </table>
</div>
