<div>
    <x-layouts.app :title="__('Dashboard')">
        @if (session('success'))
            <div class="flex justify-center mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="max-w-4xl min-w-200 flex flex-col items-center justify-between mx-auto my-8 py-8 gap-6">

            <flux:card class="max-w-2xl h-12 flex justify-between items-center gap-40 p-6 bg-white rounded-lg shadow-md">
                <div class="w-24 text-center text-lg font-bold text-gray-800">{{ __('総プレイ数') }}</div>
                <div class="w-16 text-center text-lg text-gray-800">{{ $playCount }}</div>
            </flux:card>
            <flux:card class="max-w-2xl h-12 flex justify-between items-center gap-40 p-6 bg-white rounded-lg shadow-md">
                <div class="w-24 text-center text-lg font-bold text-gray-800">{{ __('最高スコア') }}</div>
                <div class="w-16 text-center text-lg text-gray-800">{{ $highestScore }}</div>
            </flux:card>
            <flux:card class="max-w-2xl h-12 flex justify-between items-center gap-40 p-6 bg-white rounded-lg shadow-md">
                <div class="w-24 text-center text-lg font-bold text-gray-800">{{ __('登録メンバー') }}</div>
                <div class="w-16 text-center text-lg text-gray-800">{{ $registeredMembers }}</div>
            </flux:card>
            <flux:card class="max-w-2xl h-12 flex justify-between items-center gap-40 p-6 bg-white rounded-lg shadow-md">
                <div class="w-24 text-center text-lg font-bold text-gray-800">{{ __('登録グループ') }}</div>
                <div class="w-16 text-center text-lg text-gray-800">{{ $registeredGroups }}</div>
            </flux:card>
        </div>
        <div class="flex justify-center">
            <flux:button icon="play" :href="route('play.create')" wire:navigate class="flex justify-center w-48 text-lg font-semibold px-4 py-3 !bg-brand-yellow-200 hover:!bg-brand-yellow-100 hover:!font-bold !text-black rounded-lg shadow-md">
                {{ __('ゲームを始める') }}
            </flux:button>
        </div>
    </x-layouts.app>
</div>
