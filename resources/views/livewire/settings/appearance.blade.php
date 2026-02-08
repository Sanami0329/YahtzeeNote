<section class="w-full mt-10">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('画面設定') }}</flux:heading>

    <x-settings.layout :heading="__('スクリーンモード')" :subheading=" __('')">
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('ライト') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('ダーク') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('自動') }}</flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</section>
