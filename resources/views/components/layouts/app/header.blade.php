<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Potta+One&display=swap"
        rel="stylesheet">

</head>

<body class="min-h-screen w-full bg-white dark:bg-zinc-800">

    <flux:header
        container
        class="fixed w-full border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 pt-2 lg:pt-0">

        <flux:sidebar.toggle class="lg:hidden !mr-2" icon="bars-2" inset="left" />

        <x-app-logo href="{{ route('top') }}" wire:navigate />

        {{-- Desktop Navbar --}}
        <flux:navbar class="-mb-px max-lg:hidden border-b-0">

            @guest
            <flux:navbar.item class="after:hidden after:content-none" :href="route('top')" wire:navigate>
                <x-slot:icon>
                    <x-icons.home class="w-5 h-5" />
                </x-slot:icon>
                {{ __('ホーム') }}
            </flux:navbar.item>
            @endguest

            @auth
            <flux:navbar.item class="after:hidden after:content-none" :href="route('dashboard')" wire:navigate>
                <x-slot:icon>
                    <x-icons.notebook class="w-5 h-5" />
                </x-slot:icon>
                {{ __('マイノート') }}
            </flux:navbar.item>
            @endauth

            <flux:navbar.item class="after:hidden after:content-none" :href="route('howtoplay')" wire:navigate>
                <x-slot:icon>
                    <x-icons.question-mark class="w-5 h-5" />
                </x-slot:icon>
                {{ __('遊び方') }}
            </flux:navbar.item>

        </flux:navbar>

        <flux:spacer />

        <div class="hidden sm:flex">
            @auth
            {{-- Play Button --}}
            <flux:button
                icon="play"
                class="mr-4 border hover:font-bold hover:!bg-brand-yellow-600 dark:hover:!text-zinc-800"
                :href="route('play.create')"
                wire:navigate>
                {{ __('ゲームを始める') }}
            </flux:button>
            @endauth
        </div>

        <div class="flex items-center">
            @auth
            <x-desktop-user-menu />
            @endauth
        </div>

        @guest
        <flux:button
            :href="route('login')"
            wire:navigate
            class="after:hidden after:content-none dark:hover:!bg-zinc-600">
            {{ __('ログイン') }}
        </flux:button>
        @endguest
    </flux:header>

    {{-- Mobile Sidebar --}}
    <flux:sidebar
        collapsible="mobile"
        sticky
        class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">

        <flux:sidebar.header>
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>

            <flux:sidebar.group :heading="__('Platform')">

                <div class="sm:hidden">
                    @auth
                    <flux:button
                        icon="play"
                        class="!bg-brand-yellow-400 hover:!bg-brand-yellow-600 hover:!font-bold !text-zinc-900 mb-4"
                        :href="route('play.create')"
                        wire:navigate>
                        {{ __('ゲームを始める') }}
                    </flux:button>
                    @endauth
                </div>


                <flux:navbar.item
                    icon="home"
                    class="after:hidden after:content-none mb-4"
                    :href="route('top')"
                    wire:navigate>
                    <x-slot:icon>
                        <x-icons.home class="w-5 h-5" />
                    </x-slot:icon>
                    {{ __('ホーム') }}
                </flux:navbar.item>

                @auth
                <flux:navbar.item
                    icon="home"
                    class="after:hidden after:content-none mb-4"
                    :href="route('dashboard')"
                    wire:navigate>
                    <x-slot:icon>
                        <x-icons.notebook class="w-5 h-5" />
                    </x-slot:icon>
                    {{ __('マイノート') }}
                </flux:navbar.item>
                @endauth

                <flux:navbar.item
                    icon="book-open-text"
                    class="after:hidden after:content-none mb-4"
                    :href="route('howtoplay')"
                    wire:navigate>
                    <x-slot:icon>
                        <x-icons.question-mark class="w-5 h-5" />
                    </x-slot:icon>
                    {{ __('遊び方') }}
                </flux:navbar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        <div class="p-4">
            @auth
            <flux:text size="sm" class="text-zinc-500">
                {{ auth()->user()->name }}
            </flux:text>
            @endauth

            @guest
            <flux:button
                :href="route('login')"
                wire:navigate
                class="w-full dark:hover:!bg-zinc-600">
                {{ __('ログイン') }}
            </flux:button>
            @endguest
        </div>
    </flux:sidebar>


    {{ $slot }}

    @fluxScripts
    @livewireScripts
</body>

</html>