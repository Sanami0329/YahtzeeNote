<div>
    <div class="overflow-x-auto mt-14">
        @if (session('success'))
        <div class="flex justify-center mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
        @endif

        <div class="mx-auto my-4 py-6 px-10">
            <div class="flex flex-col items-center gap-6">

                <flux:card class="max-w-2xl h-12 flex justify-between items-center gap-20 p-6 bg-brand-blue-100 rounded-lg">
                    <div class="w-24 text-left text-base font-semibold text-zinc-700">{{ __('総プレイ数') }}</div>
                    <div class="w-16 text-right text-base text-zinc-700">{{ $playCount }}</div>
                </flux:card>
                <a href="{{ route('score.history') }}" class="block">
                    <flux:card class="max-w-2xl h-12 flex justify-between items-center gap-20 p-6 bg-white hover:bg-brand-blue-200 rounded-lg shadow-md">
                        <div class="w-24 text-left text-base font-semibold hover:font-bold text-zinc-700">{{ __('最高スコア') }}</div>
                        <div class="w-16 text-right text-base text-zinc-700">{{ $highestScore }}</div>
                    </flux:card>
                </a>
                <a href="{{ route('subusers.show') }}" class="block">
                    <flux:card class="max-w-2xl h-12 flex justify-between items-center gap-20 p-6 bg-white hover:bg-brand-blue-200 rounded-lg shadow-md">
                        <div class="w-24 text-left text-base font-semibold hover:font-bold text-zinc-700">{{ __('登録メンバー') }}</div>
                        <div class="w-16 text-right text-base text-zinc-700">{{ $registeredMembers }}</div>
                    </flux:card>
                </a>

                {{-- <a href="{{ route('play.create') }}" class="block">
                <flux:card class="max-w-2xl h-12 flex justify-between items-center gap-20 p-6 bg-zinc-50 rounded-lg shadow-md">
                    <div class="w-24 text-left text-base font-semibold text-zinc-700">{{ __('登録グループ') }}</div>
                    <div class="w-16 text-right text-base text-zinc-700">{{ $registeredGroups }}</div>
                </flux:card>
                </a> --}}

            </div>
        </div>

        <div class="sm:hidden flex justify-center">
            <flux:button icon="play" :href="route('play.create')" wire:navigate class="flex justify-center w-48 !text-base font-semibold px-4 py-6 !bg-brand-yellow-400 hover:!bg-brand-yellow-600 hover:!font-bold !text-zinc-900 rounded-lg shadow-md">
                {{ __('ゲームを始める') }}
            </flux:button>
        </div>
    </div>
</div>