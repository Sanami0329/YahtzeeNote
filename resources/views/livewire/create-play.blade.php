<div>
    <form wire:submit="save" class="flex justify-center items-center min-h-screen">
        <flux:field class="w-full max-w-96 min-w-72 flex flex-col">

            {{-- label --}}
            <div class="w-full text-center mb-8">
                <flux:label class="text-xl!">プレーヤーの名前を入力してください</flux:label>
            </div>

            {{-- user --}}
            <div class="flex gap-4 items-center mb-4">
                <flux:input class="flex-1 pointer-events-none" name="user" :value="auth()->user()?->name" readonly />
                <div class="w-12 shrink-0"></div>
            </div>

            {{-- subusers(players) --}}
            @foreach($subusers as $i => $subuser)
            <div class="mb-4">
                <div class="flex gap-4 items-center">
                    <flux:input class="flex-1" wire:model="subusers.{{ $i }}" placeholder="player{{ $i + 1 }}" />
                    <flux:button wire:click="removeInput({{ $i }})" class="w-12 shrink-0 text-red-400!">削除</flux:button>
                </div>
                @error("subusers.$i")
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            @endforeach

            @if (count($subusers) < 6)
                <div class="flex justify-end mb-4">
                    <flux:button wire:click="addInput" class="w-12">追加</flux:button>
                </div>
            @endif


            {{-- submit button --}}
            <flux:button type="submit" class="mx-auto w-48 text-lg font-semibold" variant="primary" color="yellow">
                このメンバーで始める
            </flux:button>
        </flux:field>
    </from>
</div>
