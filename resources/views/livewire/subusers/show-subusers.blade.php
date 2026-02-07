<div class="">
    <div class="overflow-x-auto min-w-xs sm:w-md h-dvh sm:h-auto bg-zinc-50 sm:mt-14 my-6 mx-auto py-6 px-10 text-zinc-800">

        <nav aria-label="breadcrumb" class="text-sm text-zinc-500">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ url('/home') }}" class="hover:underline">{{ __('ホーム') }}</a>
                </li>
                <li class="text-zinc-500">></li>
                <li class="font-medium">{{ __('登録メンバー') }}</li>
            </ol>
        </nav>

        @foreach ([
            'addStatus'    => ['bg' => 'bg-green-100', 'text' => 'text-green-600'],
            'editStatus'   => ['bg' => 'bg-green-100',  'text' => 'green-100'],
            'editErrorStatus'   => ['bg' => 'bg-red-100',   'text' => 'text-red-600'],
            'deleteStatus' => ['bg' => 'bg-red-100',   'text' => 'text-zinc-600'],
        ] as $key => $style)

            @if (session($key))
                <div class="mt-2 text-sm text-center {{ $style['bg'] }} {{ $style['text'] }}">
                    {{ session($key) }}
                </div>
            @endif

        @endforeach

        <h1 class="m-4 font-semibold text-lg text-center">登録メンバー</h1>

        <div class="flex justify-end mb-4">
            <flux:button
                :href="route('add.subuser')"
                wire:navigate
                class="w-32 !border-zinc-300 !bg-white hover:!bg-brand-red-200 hover:!font-bold !text-zinc-800 text-center">
                {{ __('＋  メンバー追加') }}
            </flux:button>
        </div>


        <div class="w-auto bg-brand-blue-100 p-4">
            <!-- table -->
            <div class="border-2 rounded-lg overflow-hidden space-y-2">

                <!-- header -->
                <div class="bg-brand-blue-300 grid grid-cols-[auto_1fr]  rounded-lg gap-0">
                    <div class="w-16 pl-2 py-2 text-center rounded-l-lg">No.</div>
                    <div class="px-4 py-2 text-center rounded-r-lg">名前</div>
                </div>

                <!-- body -->
                <div class="space-y-2">
                    @foreach($subusers as $i => $subuser)
                    <div
                        wire:click="moveEdit({{ $subuser->id }})"
                        class="flex items-center bg-white hover:bg-brand-blue-200 grid grid-cols-[auto_1fr] gap-0 rounded-lg overflow-hidden">
                        <span class="w-16 pl-2 py-2 whitespace-nowrap text-center">{{ $i + 1 }}</span>
                        <span class="px-4 py-2 whitespace-nowrap text-center">{{ $subuser->name }}</span>
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
</div>