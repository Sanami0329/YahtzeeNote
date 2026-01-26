<div>
    {{-- Score Table --}}
    <table class="w-36 border-collapse border-1 border-gray-600 font-medium text-gray-800">
        {{-- Column Headers --}}
        <thead>
            <tr class="h-10 bg-white">
                <th class="w-60 border border-gray-600 text-center">{{ $playerName }}</th>
            </tr>
        </thead>

        <tbody>
            {{-- Upper Section --}}
            @foreach($this->upperScores as $field)
            <tr class="h-10 bg-red-100">
                <td class="border border-gray-600">
                    <div class="flex items-center justify-center gap-2 px-3">
                        <flux:button
                            size="xs"
                            wire:click="decrement('{{ $field }}')"
                            class="bg-gray-200! text-gray-600!">
                            -
                        </flux:button>
                        <flux:input
                            type="number"
                            size="xs"
                            wire:model.lazy="{{ $field }}"
                            class="w-16 bg-white border-1 border-gray-600"
                            style="text-align: center; color: var(--color-gray-600); appearance: textfield;"
                            max="{{ $this->scoreConfig[$field]['max'] }}"
                            min="0" />
                        <flux:button
                            size="xs"
                            wire:click="increment('{{ $field }}')"
                            class="bg-gray-200! text-gray-600!">
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
                <tr class="h-10 bg-red-200">
                    <td class="border border-gray-600 px-3 text-center">{{ $this->{$item['method']}() }}</td>
                </tr>
            @endforeach

            {{-- Lower Section --}}
            @foreach($this->lowerScores as $field)
            <tr class="h-10 bg-blue-100">
                <td class="border border-gray-600">
                    <div class="flex items-center justify-center gap-2 px-3">
                        <flux:button
                            size="xs"
                            wire:click="decrement('{{ $field }}')"
                            class="bg-gray-200! text-gray-600!">
                            -
                        </flux:button>
                        <flux:input
                            type="number"
                            size="xs"
                            wire:model.lazy="{{ $field }}"
                            class="w-16 bg-white border-1 border-gray-600"
                            style="text-align: center; color: var(--color-gray-600); appearance: textfield;"
                            max="{{ $this->scoreConfig[$field]['max'] }}"
                            min="0" />
                        <flux:button
                            size="xs"
                            wire:click="increment('{{ $field }}')"
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
                    <div class="flex flex-col items-center px-3 gap-2">
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
                <td class="border border-gray-600 px-3 text-center">{{ $this->getLowerTotal() }}</td>
            </tr>

            {{-- Grand Total --}}
            <tr class="h-16 bg-yellow-200 border-t-4 border-double border-gray-600 text-lg font-bold">
                <td class="border border-gray-600 px-3 text-center">{{ $this->getGrandTotal() }}</td>
            </tr>
        </tbody>
    </table>
    <script>
        window.addEventListener('show-validation-error', (event) => {
            alert(event.detail.error);
        });
    </script>
</div>
