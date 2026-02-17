<div class="">
    <div class="overflow-x-auto min-w-xs sm:w-md h-dvh sm:h-auto bg-zinc-50 sm:mt-14 my-6 mx-auto py-6 px-10 text-zinc-600">

        <nav aria-label="breadcrumb" class="text-sm text-zinc-500">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ url('/home') }}" class="hover:underline">{{ __('ホーム') }}</a>
                </li>
                <li class="">></li>
                <li class="font-medium">{{ __('登録メンバー') }}</li>
            </ol>
        </nav>

        @foreach ([
        'addStatus' => ['bg' => 'bg-green-100', 'text' => 'text-green-600'],
        'editStatus' => ['bg' => 'bg-green-100', 'text' => 'green-100'],
        'editErrorStatus' => ['bg' => 'bg-red-100', 'text' => 'text-red-600'],
        'deleteStatus' => ['bg' => 'bg-red-100', 'text' => 'text-zinc-600'],
        ] as $key => $style)

        @if (session($key))
        <div class="mt-2 text-sm text-center {{ $style['bg'] }} {{ $style['text'] }}">
            {{ session($key) }}
        </div>
        @endif

        @endforeach

        <h1 class="m-4 font-semibold !text-xl text-center">登録メンバー</h1>

        <div class="flex justify-end mb-4">
            <flux:button
                :href="route('add.subuser')"
                wire:navigate
                class="w-fit px-6 !bg-white hover:!bg-brand-yellow-400 !border hover:!border-brand-yellow-600 hover:!font-bold !text-zinc-600 text-center">
                {{ __('＋  メンバー追加') }}
            </flux:button>
        </div>

        <!-- table -->
        <div class="w-auto bg-brand-yellow-200 pt-6 p-4 space-y-2">

            <!-- header -->
            <div class="flex items-center bg-brand-yellow-500 rounded-lg">
                <span class="w-16 p-2 text-center rounded-l-lg">No.</span>
                <span class="w-full px-4 py-2 text-center rounded-r-lg">名前</span>
            </div>

            <!-- body -->
            <div class="space-y-2">
                @foreach($subusers as $i => $subuser)
                <div
                    wire:click="moveEdit({{ $subuser->id }})"
                    class="flex items-center bg-white hover:bg-brand-yellow-400 border border-brand-yellow-400 hover:border-brand-yellow-600 rounded-lg">
                    <span class="w-16 p-2 whitespace-nowrap text-center">{{ $i + 1 }}</span>
                    <span class="w-full px-4 py-2 whitespace-nowrap text-center cursor-pointer">{{ $subuser->name }}</span>
                </div>
                @endforeach
            </div>

            {{-- pagination --}}
            <div class="my-4">
                {{ $subusers->links('vendor.livewire.tailwind') }}
            </div>

        </div>
    </div>
</div>