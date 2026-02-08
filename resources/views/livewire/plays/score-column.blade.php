<div class="">
    {{-- Score Table --}}
    <table class="border-collapse border-t-1 border-b-1 border-r-1 font-normal !text-zinc-600">
        {{-- Column Headers --}}
        <thead>
            <tr class="max-w-44 h-10 bg-white">
                <th class="border-t-1 border-b-1 border-r-1 border-zinc-600 text-center font-semibold">{{ $playerName }}</th>
            </tr>
        </thead>

        <tbody>
            {{-- Upper Section --}}
            @foreach($this->upperScoreArray as $field)
            <tr class="h-10 bg-brand-red-100">
                <td class="border-t-1 border-b-1 border-r-1 border-zinc-600">
                    <div class="flex items-center justify-center gap-2 px-2">
                        <flux:button
                            size="xs"
                            wire:click="decrement('{{ $field }}')"
                            :loading="false"
                            class="w-6 !bg-zinc-200 !text-zinc-600 border !border-zinc-600 select-none">
                            -
                        </flux:button>
                        <flux:input
                            type="number"
                            size="xs"
                            wire:model.lazy="{{ $field }}"
                            class="!w-14 bg-white border border-zinc-600"
                            style="text-align: center;"
                            max="{{ $this->scoreConfig[$field]['max'] }}"
                            min="0" />
                        <flux:button
                            size="xs"
                            wire:click="increment('{{ $field }}')"
                            :loading="false"
                            class="w-6 !bg-zinc-200 !text-zinc-600 border !border-zinc-600 select-none">
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
                <td class="border-t-1 border-b-1 border-r-1 border-zinc-600 px-4 text-center font-semibold">{{ $this->{$item['method']}() }}</td>
            </tr>
            @endforeach

            {{-- Lower Section --}}
            @foreach($this->lowerScoreArray as $field)
            <tr class="h-10 bg-brand-blue-100">
                <td class="border-t-1 border-b-1 border-r-1 border-zinc-600">
                    <div class="flex items-center justify-center gap-2 px-4">
                        <flux:button
                            size="xs"
                            wire:click="decrement('{{ $field }}')"
                            :loading="false"
                            class="w-6 !bg-zinc-200 !text-zinc-600 border !border-zinc-600 select-none">
                            -
                        </flux:button>
                        <flux:input
                            type="number"
                            size="xs"
                            wire:model.lazy="{{ $field }}"
                            class="!w-14 bg-white border border-zinc-600"
                            style="text-align: center;"
                            max="{{ $this->scoreConfig[$field]['max'] }}"
                            min="0" />
                        <flux:button
                            size="xs"
                            wire:click="increment('{{ $field }}')"
                            :loading="false"
                            class="w-6 !bg-zinc-200 !text-zinc-600 border !border-zinc-600 select-none">
                            +
                        </flux:button>
                    </div>
                </td>
            </tr>
            @endforeach

            {{-- Yahtzee Bonus --}}
            <tr class="h-16 bg-brand-blue-100">
                <td class="border-t-1 border-b-1 border-r-1 border-zinc-600">
                    <div class="flex flex-col items-center px-4 gap-2">
                        <div class="flex gap-2">
                            @for($i = 0; $i
                            < 5; $i++)
                                <flux:checkbox
                                wire:model.live="yahtzeeBonusItems.{{ $i }}"
                                class="bg-white border border-zinc-600" />
                            @endfor
                        </div>
                        <div class="text-center text-zinc-600 px-4">
                            {{ $this->getYahtzeeBonus() }}
                        </div>
                    </div>
                </td>
            </tr>

            {{-- Lower Total --}}
            <tr class="h-10 bg-brand-blue-300">
                <td class="border-t-1 border-b-1 border-r-1 border-zinc-600 px-4 text-center font-semibold">{{ $this->getLowerTotal() }}</td>
            </tr>

            {{-- Grand Total --}}
            <tr class="h-14 bg-brand-yellow-400 border-t-4 border-double border-zinc-600 text-lg font-bold">
                <td class="border-t-1 border-b-1 border-r-1 border-zinc-600 p-4 text-center">{{ $this->getGrandTotal() }}</td>
            </tr>
        </tbody>
    </table>
</div>