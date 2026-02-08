@props([
'sidebar' => false,
])

@if($sidebar)
<flux:sidebar.brand name="YahtzeeNote" {{ $attributes }}>
    <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center font-bold rounded-md">
        <x-app-logo-icon width="30" height="30" class="fill-current" />
    </x-slot>
</flux:sidebar.brand>
@else
<flux:brand name="YahtzeeNote" {{ $attributes }}>
    <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center font-bold rounded-md">
        <x-app-logo-icon width="30" height="30" class="fill-current" />
    </x-slot>
</flux:brand>
@endif