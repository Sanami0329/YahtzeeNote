<div class="flex justify-center sm:pt-8">

    <div class="overflow-x-auto min-w-xl h-dvh sm:h-auto bg-gray-50 px-10 pt-4 pb-8 text-zinc-900">

        <nav aria-label="breadcrumb" class="text-sm text-zinc-500">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ url('/home') }}" class="hover:underline">{{ __('ホーム') }}</a>
                </li>
                <li class="text-zinc-500">></li>
                <li>
                    <a href="{{ url('/members/show') }}" class="hover:underline">{{ __('登録メンバー') }}</a>
                </li>
                <li class="text-zinc-500">></li>
                <li class="font-medium">{{ __('メンバー編集') }}</li>
            </ol>
        </nav>

        <h1 class="m-4 font-semibold text-lg text-center">メンバー編集</h1>

        <div class="min-w-full bg-brand-blue-300 p-4">
            <form wire:submit.prevent="save" class="flex flex-col gap-4">
                <flux:input wire:model.lazy="subuserName" class="bg-white !text-zinc-900 !text-semibold" />
                @error('subuserName')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <div class="flex justify-center my-2 gap-4">
                    <flux:button
                        wire:click="detele"
                        wire:confirm="本当に削除しますか？"
                        variant="danger"
                        size="base"
                        class="">
                        削除
                    </flux:button>
                    <flux:button
                        type="submit"
                        size="base"
                        class="">
                        保存
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</div>
