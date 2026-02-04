<div class="flex justify-center sm:pt-8">
    <div class="min-w-2xl h-dvh sm:h-auto bg-brand-blue-200 py-4 text-center text-zinc-800">
        <h1 class="m-6 font-semibold text-lg">登録メンバー</h1>

        <div class="flex flex-col items-center">
            @foreach($subusers as $i => $subuser)
                <div class="min-w-56 h-10 flex items-center border-1 border-gray-300 rounded-lg bg-white gap-4 mb-2 px-2">
                    <span class="text-left">{{ $i + 1 }}</span>
                    <span class="text-left">{{ $subuser->name }}</span>
                </div>
            @endforeach
        </div>

        {{-- ページネーション --}}
        <div class="mb-4">
            {{ $subusers->links('vendor.livewire.tailwind') }}
        </div>

        <div class="flex justify-center mb-4">
            <flux:button class="w-72 !border-gray-300 !bg-gray-50 hover:!bg-white hover:!font-bold !text-gray-800">{{ __('メンバー追加') }}</flux:button>
        </div>

    </div>
</div>
