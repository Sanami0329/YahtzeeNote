<section class="w-full mt-10">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('プロフィール') }}</flux:heading>

    <x-settings.layout :heading="__('プロフィール')" :subheading="__('')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('名前')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('メールアドレス')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('メールアドレスが認証されていません') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('認証用メールの送信') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('保存') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('保存されました。') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
