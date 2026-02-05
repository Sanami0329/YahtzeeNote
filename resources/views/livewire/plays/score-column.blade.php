<div class="pt-8">
    {{-- Score Table --}}
    <table class="border-collapse border-1 border-gray-600 font-normal text-zinc-800">
        {{-- Column Headers --}}
        <thead>
            <tr class="max-w-44 h-10 bg-white">
                <th class="border border-gray-600 text-center font-semibold">{{ $playerName }}</th>
            </tr>
        </thead>

        <tbody>
            {{-- Upper Section --}}
            @foreach($this->upperScoreArray as $field)
            <tr class="h-10 bg-brand-red-100">
                <td class="border border-gray-600">
                    <div class="flex items-center justify-center gap-2 px-2">
                        <flux:button
                            size="xs"
                            wire:click="decrement('{{ $field }}')"
                            class="!bg-gray-200 !text-zinc-800 border-1 !border-gray-600"
                            style="width: 24px">
                            -
                        </flux:button>
                        <flux:input
                            type="number"
                            size="xs"
                            wire:model.lazy="{{ $field }}"
                            class="!w-14 bg-white border-1 border-gray-600"
                            style="text-align: center; color: var(--color-gray-600);"
                            max="{{ $this->scoreConfig[$field]['max'] }}"
                            min="0" />
                        <flux:button
                            size="xs"
                            wire:click="increment('{{ $field }}')"
                            class="!bg-gray-200 !text-zinc-800 !border-1 !border-gray-600"
                            style="width: 24px">
                            +
                        </flux:button>
                    </div>
                </td>
            </tr>
            @endforeach

            {{-- Upper Totals --}}
            @foreach ([
                ['name' => 'UPPER SCORE', 'method' => 'getUpperScore'],
                ['name' => 'BONUS', 'method' => 'getBonus'],
                ['name' => 'UPPER TOTAL', 'method' => 'getUpperTotal'],
            ] as $item)
                <tr class="h-10 bg-brand-red-300">
                    <td class="border border-gray-600 px-4 text-center font-semibold">{{ $this->{$item['method']}() }}</td>
                </tr>
            @endforeach

            {{-- Lower Section --}}
            @foreach($this->lowerScoreArray as $field)
            <tr class="h-10 bg-brand-blue-100">
                <td class="border border-gray-600">
                    <div class="flex items-center justify-center gap-2 px-4">
                        <flux:button
                            size="xs"
                            wire:click="decrement('{{ $field }}')"
                            class="!bg-gray-200 !text-zinc-800 border-1 !border-gray-600"
                            style="width: 24px">
                            -
                        </flux:button>
                        <flux:input
                            type="number"
                            size="xs"
                            wire:model.lazy="{{ $field }}"
                            class="!w-14 bg-white border-1 border-gray-600"
                            style="text-align: center; color: var(--color-gray-600);"
                            max="{{ $this->scoreConfig[$field]['max'] }}"
                            min="0" />
                        <flux:button
                            size="xs"
                            wire:click="increment('{{ $field }}')"
                            class="!bg-gray-200 !text-zinc-800 border-1 !border-gray-600"
                            style="width: 24px">
                            +
                        </flux:button>
                    </div>
                </td>
            </tr>
            @endforeach

            {{-- Yahtzee Bonus --}}
            <tr class="h-16 bg-brand-blue-100">
                <td class="border border-gray-600">
                    <div class="flex flex-col items-center px-4 gap-2">
                        <div class="flex gap-2">
                            @for($i = 0; $i < 5; $i++)
                                <flux:checkbox
                                wire:model.live="yahtzeeBonusItems.{{ $i }}"
                                class="bg-white border border-gray-600" />
                            @endfor
                        </div>
                        <div class="text-center text-zinc-800 px-4">
                            {{ $this->getYahtzeeBonus() }}
                        </div>
                    </div>
                </td>
            </tr>

            {{-- Lower Total --}}
            <tr class="h-10 bg-brand-blue-300">
                <td class="border border-gray-600 px-4 text-center font-semibold">{{ $this->getLowerTotal() }}</td>
            </tr>

            {{-- Grand Total --}}
            <tr class="h-14 bg-brand-yellow-300 border-t-4 border-double border-gray-600 text-lg font-bold">
                <td class="border border-gray-600 p-4 text-center">{{ $this->getGrandTotal() }}</td>
            </tr>
        </tbody>
    </table>
</div>
