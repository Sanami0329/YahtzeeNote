<div class="flex justify-center sm:pt-8">

    <div class="overflow-x-auto min-w-xl h-dvh sm:h-auto bg-gray-50 px-10 pt-4 pb-8 text-zinc-900">

        <h1 class="m-4 font-semibold text-lg text-center">プレーヤーの名前を入力してください</h1>

        <div class="min-w-full p-4">
            <form wire:submit.prevent="save" class="flex flex-col gap-4">

                {{-- user --}}
                <div class="flex !w-md gap-4 mb-4 items-center">
                    <flux:input class="pointer-events-none border-1 border-gray-400 !text-black" name="user" :value="auth()->user()?->name" readonly />
                </div>

                {{-- others --}}
                @foreach($playerArray as $i => $player)
                <div>
                    @if(array_key_exists('isRegistered', $player) && $player['isRegistered'])
                    <div class="flex !w-md gap-4 items-center">
                        <flux:input class="pointer-events-none bg-white border-1 border-gray-400" :value="$player['name']" readonly />
                        <flux:button wire:click="removeInput({{ $i }})" class="w-12 shrink-0 !text-red-400">{{ __('削除') }}</flux:button>
                    </div>
                    @else
                    <div class="flex !w-md gap-4 items-center">
                        <flux:input
                            class="bg-white border-1 border-gray-400"
                            wire:key="player-{{ $i }}"
                            wire:model="playerArray.{{ $i }}.name"
                            placeholder="player{{ $i + 1 }}" />
                        <flux:modal.trigger name="select-subuser">
                            <flux:button class="!w-32 bg-brand-blue-100">{{ __('登録メンバーから選択') }}</flux:button>
                        </flux:modal.trigger>
                        <flux:button wire:click="removeInput({{ $i }})" class="w-12 shrink-0 !text-red-400">{{ __('削除') }}</flux:button>
                    </div>
                    @endif

                    @error("playerArray.$i.name")
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- modal section --}}
                <flux:modal name="select-subuser" class="md:max-w-96">

                    <div class="overflow-x-auto min-w-72 h-dvh sm:h-auto bg-gray-50 px-10 pt-4 pb-8 text-zinc-800">

                        <h1 class="m-4 font-semibold text-lg text-center">登録メンバー</h1>

                        <div class="min-w-full bg-brand-blue-100 p-4">

                            <!-- table -->
                            <div class="bg-brand-blue-100 border-2 rounded-lg overflow-hidden space-y-2">

                                <!-- body -->
                                <div class="space-y-2">
                                    @foreach($subusers as $subuser)
                                    <div
                                        wire:click="selectedSubuser({{ $subuser->id }}, {{ $i }})"
                                        class="flex items-center !justify-center bg-white hover:bg-brand-blue-200 gap-0 rounded-lg overflow-hidden">
                                        <span class="pointer-events-none px-4 py-2 whitespace-nowrap !text-center !arrow-text">{{ $subuser->name }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- pagination --}}
                            <div class="my-4">
                                {{ $subusers->links('vendor.livewire.tailwind') }}
                            </div>

                        </div>
                    </div>
                </flux:modal>
                @endforeach

                @if (count($playerArray) < 5)
                    <div class="!w-md flex justify-end mb-4">
                    <flux:button wire:click="addInput({{ $i }})" class="w-12">
                        {{ __('追加') }}
                    </flux:button>
        </div>
        @endif

        {{-- submit button --}}
        <flux:button type="submit" class="mx-auto w-48 text-lg font-semibold !bg-brand-yellow-400 hover:!bg-brand-yellow-600 hover:!font-bold !text-zinc-900" variant="primary">
            {{ __('このメンバーで始める') }}
        </flux:button>
        </form>
    </div>
</div>
</div>