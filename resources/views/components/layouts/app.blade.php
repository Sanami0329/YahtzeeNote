<x-layouts.app.header :title="$title ?? null">
    <flux:main class="px-0">
        {{ $slot }}
    </flux:main>
</x-layouts.app.header>