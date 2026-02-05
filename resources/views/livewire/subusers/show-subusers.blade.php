<div class="flex justify-center sm:pt-8">

    <div class="overflow-x-auto min-w-xl h-dvh sm:h-auto bg-gray-50 px-10 pt-4 pb-8 text-zinc-800">

        <nav aria-label="breadcrumb" class="text-sm text-zinc-500">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ url('/home') }}" class="hover:underline">{{ __('ホーム') }}</a>
                </li>
                <li class="text-zinc-500">></li>
                <li class="font-medium">{{ __('登録メンバー') }}</li>
            </ol>
        </nav>

        <h1 class="m-4 font-semibold text-lg text-center">登録メンバー</h1>

        <div class="flex justify-end mb-4">
            <flux:button
                class="w-36 !border-gray-300 !bg-white hover:!bg-brand-blue-200 hover:!font-bold !text-gray-800 text-center">
                {{ __('＋  メンバー追加') }}
            </flux:button>
        </div>


        <div class="min-w-full bg-brand-blue-100 p-4">
            <!-- テーブル全体のコンテナ -->
            <div class="bg-brand-blue-100 border-2 rounded-lg overflow-hidden space-y-2">

                <!-- ヘッダー行 -->
                <div class="bg-brand-blue-300 grid grid-cols-[auto_1fr]  rounded-lg gap-0">
                    <div class="px-4 py-2 text-center rounded-l-lg">No.</div>
                    <div class="px-4 py-2 text-center rounded-r-lg">名前</div>
                </div>

                <!-- ボディ部分 -->
                <div class="space-y-2">
                    @foreach($subusers as $i => $subuser)
                        <div
                            wire:click="moveEdit({{ $subuser->id }})"
                            class="flex items-center bg-white hover:bg-brand-blue-200 grid grid-cols-[auto_1fr] gap-0 rounded-lg overflow-hidden">
                                <span class="px-4 py-2 whitespace-nowrap text-center">{{ $i + 1 }}</span>
                                <span class="px-4 py-2 whitespace-nowrap text-center">{{ $subuser->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

        {{-- ページネーション --}}
        <div class="my-4">
            {{ $subusers->links('vendor.livewire.tailwind') }}
        </div>

    </div>
</div>
