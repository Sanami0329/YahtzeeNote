@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="YahtzeeNote" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-white">
            <x-app-logo-icon class="size-5 fill-current text-black" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="YahtzeeNote" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-white">
            <x-app-logo-icon class="size-5 fill-current text-black" />
        </x-slot>
    </flux:brand>
@endif
