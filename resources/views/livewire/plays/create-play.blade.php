<div class="">
    <div class="overflow-x-auto max-w-xl min-w-sm h-dvh sm:h-auto bg-zinc-50 sm:mt-14 my-6 mx-auto py-6 px-10 !bg-brand-yellow-100 text-zinc-600">

        <h1 class="my-6 font-semibold !text-xl text-center">プレイヤーの名前を入力してください</h1>

        <div class="min-w-full">
            <form wire:submit.prevent="save" class="flex flex-col gap-6">

                {{-- user --}}
                <div class="min-w-84 flex gap-2 items-center">
                    <flux:input style="color: var(--color-zinc-600) !important;" class="pointer-events-none bg-zinc-50 !text-black" name="user" :value="auth()->user()?->name" readonly />
                </div>

                {{-- others --}}
                @foreach($playerArray as $i => $player)
                <div>
                    @if(array_key_exists('playerIsRegistered', $player) && $player['playerIsRegistered'])
                    <div class="min-w-84 flex gap-2 items-center">
                        <flux:input style="color: var(--color-zinc-600) !important;" class="pointer-events-none bg-white border border-zinc-400" :value="$player['playerName']" readonly />
                        <flux:button wire:click="removeInput({{ $i }})" class="w-10 shrink-0 !bg-white !text-red-600 hover:!bg-zinc-100 hover:!font-semibold">{{ __('削除') }}</flux:button>
                    </div>
                    @else
                    <div class="min-w-84 flex gap-2 items-center">
                        <flux:input
                            style="color: var(--color-zinc-600) !important;"
                            class="bg-white border border-zinc-400"
                            wire:key="player-{{ $i }}"
                            wire:model="playerArray.{{ $i }}.playerName"
                            placeholder="player{{ $i + 1 }}" />
                        <flux:modal.trigger name="select-subuser">
                            <flux:button
                                class="!w-fit !bg-white hover:!bg-brand-yellow-300 !font-medium !text-xs !text-zinc-500 hover:!text-zinc-700 hover:!font-semibold">
                                {{ __('登録メンバーから選択') }}
                            </flux:button>
                        </flux:modal.trigger>
                        <flux:button wire:click="removeInput({{ $i }})" class="w-10 shrink-0 !bg-white !text-red-600 hover:!bg-zinc-100 hover:!font-semibold">{{ __('削除') }}</flux:button>
                    </div>
                    @endif

                    @error("playerArray.$i.playerName")
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror

                    {{-- modal section --}}
                    <flux:modal name="select-subuser" class="md:max-w-96">

                        <div class="overflow-x-auto min-w-72 sm:h-auto bg-zinc-50 m-6 p-6 text-zinc-600">

                            <h1 class="mb-4 font-semibold text-lg text-center">登録メンバー</h1>

                            <div class="min-w-full bg-brand-yellow-200 pt-8 p-6 space-y-2">

                                @foreach($subusers as $subuser)
                                <div
                                    wire:click="selectedSubuser({{ $subuser->id }}, {{ $i }})"
                                    class="!h-12 flex items-center !justify-center bg-white hover:bg-brand-yellow-400 border border-brand-yellow-400 hover:border-brand-yellow-600 rounded-lg">
                                    <span class="cursor-pointer px-2 py-2 whitespace-nowrap !text-center !arrow-text">{{ $subuser->name }}</span>
                                </div>
                                @endforeach

                                {{-- pagination --}}
                                <div class="my-4">
                                    {{ $subusers->links('vendor.livewire.tailwind') }}
                                </div>

                            </div>
                        </div>
                    </flux:modal>
                </div>
                @endforeach

                @if (count($playerArray) < 5)
                    <div class="min-w-84 flex justify-end mb-4">
                    <flux:button wire:click="addInput({{ $i }})" class="w-10 shrink-0 !bg-white hover:!bg-zinc-100 !text-zinc-600 hover:!font-bold">
                        {{ __('追加') }}
                    </flux:button>
        </div>
        @endif

        {{-- submit button --}}
        <div class="flex justify-center">
            <flux:button
                type="submit"
                :loading="false"
                class="w-fit mx-auto my-4 px-6 text-lg font-semibold text-zinc-500 hover:!text-zinc-700 bg-brand-yellow-400 hover:!bg-brand-yellow-600 hover:!border-2 hover:!font-bold"
                variant="primary">
                {{ __('このメンバーで始める') }}
            </flux:button>
        </div>
        </form>
    </div>
</div>
</div>