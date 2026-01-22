<x-layouts.app.header :title="$title ?? null">
    <flux:main class="flex justify-center items-center min-h-screen">
            <flux:field class="flex flex-col items-center">
                <flux:label class="pb-8 text-xl">プレーヤーの名前を入力してください</flux:label>
                <flux:input name="user" :value="auth()->user()?->name" class="w-full max-w-96 pointer-events-none" readonly />
                <flux:input name="subuser1" placeholder="player1" class="w-full max-w-96"  />
                <flux:input name="subuser2" placeholder="player2" class="w-full max-w-96"  />
                <flux:input name="subuser3" placeholder="playe3" class="w-full max-w-96"  />
                <flux:input name="subuser4" placeholder="playe4" class="w-full max-w-96"  />
                <flux:input name="subuser5" placeholder="player5" class="w-full max-w-96"  />
                <flux:button class="mx-auto mt-8 w-48 font-semibold" variant="primary" color="yellow">このメンバーで始める</flux:button>
            </flux:field>
    </flux:main>
</x-layouts.app.header>
