<div class="">

    <div class="overflow-x-auto min-w-xs sm:w-md h-dvh sm:h-auto bg-zinc-50 sm:mt-14 my-6 mx-auto py-6 px-10 text-zinc-600">

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
                <li class="font-medium">{{ __('メンバー追加') }}</li>
            </ol>
        </nav>

        <h1 class="m-4 font-semibold text-lg text-center">メンバー追加</h1>

        <div class="min-w-full bg-brand-yellow-200 p-6 p-4">
            <form wire:submit.prevent="save" class="flex flex-col gap-4">
                <flux:input wire:model.lazy="subuserName" class="bg-white border border-zinc-400 !text-zinc-600 !text-semibold" />
                @error('subuserName')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <div class="flex justify-center my-2 gap-4">
                    <flux:button
                        :href="route('subusers.show')"
                        wire:navigate
                        size="base"
                        :loading="false"
                        class="">
                        {{ __('戻る') }}
                    </flux:button>

                    <flux:button
                        type="submit"
                        size="base"
                        :loading="false"
                        class="hover:!bg-green-100">
                        {{ __('保存') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</div>