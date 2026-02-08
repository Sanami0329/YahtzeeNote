<section class="w-full mt-10">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('パスワードの設定') }}</flux:heading>

    <x-settings.layout :heading="__('パスワードの変更')" :subheading="__('')">
        <form method="POST" wire:submit="updatePassword" class="mt-6 space-y-6">
            <flux:input
                wire:model="current_password"
                :label="__('現在のパスワード')"
                type="password"
                required
                autocomplete="current-password"
            />
            <flux:input
                wire:model="password"
                :label="__('新しいパスワード')"
                type="password"
                required
                autocomplete="new-password"
            />
            <flux:input
                wire:model="password_confirmation"
                :label="__('新しいパスワード（確認用）')"
                type="password"
                required
                autocomplete="new-password"
            />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('保存') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="password-updated">
                    {{ __('保存されました。') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>
