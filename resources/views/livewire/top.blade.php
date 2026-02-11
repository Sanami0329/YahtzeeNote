<div class="text-zinc-900">
    <!-- ヒーローセクション -->
    <section class="relative h-screen flex items-center justify-center text-white mt-6 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary to-secondary opacity-90"></div>
        <img
            src="{{ asset('images/top_image_dices.jpg') }}"
            alt="dices"
            class="absolute w-full h-dvh object-cover object-center"
            style="opacity: 0.8;">

        <div class="lg:w-4/5 lg:h-3/4 xl:px-20 lg:pt-10 mx-auto felx items-center bg-white/40 backdrop-blur-sm text-center">
            <div class="mx-auto my-20 py-6 flex flex-col gap-10 w-3xl">
                <h1 class="mx-auto pt-6 text-4xl lg:text-5xl font-bold text-zinc-900 text-shadow">
                    YahtzeeNote
                </h1>
                <p class="mx-auto text-sm lg:text-lg px-8 text-shadow text-zinc-900 font-semibold">
                    Yahtzee（ヤッツィー）のスコアを紙要らずで素早く入力、自動計算。<br>
                    プレイ履歴やいつものメンバーもまとめて管理。
                </p>
                @auth
                <flux:link
                    class="mx-auto px-4 lg:text-xl text-zinc-700 mb-8"
                    :current="request()->routeIs('top')"
                    :href="route('dashboard')"
                    wire:navigate>
                    {{ __('使ってみる') }}
                </flux:link>
                @endauth
                @guest
                <flux:link
                    class="mx-auto px-4 lg:text-xl text-zinc-700 mb-8"
                    :current="request()->routeIs('top')"
                    :href="route('login')"
                    wire:navigate>
                    {{ __('使ってみる') }}
                </flux:link>
                @endguest
            </div>
        </div>
    </section>

    <!-- Yahtzeeとは -->
    <section id="practice-areas" class="py-16 bg-white">
        <div class="container mx-auto px-2 lg:px-16">
            <div class="text-center mb-10">
                <h2 class="text-2xl lg:text-3xl font-bold">Yahtzee（ヤッツィー）とは？</h2>
            </div>

            <div class="flex flex-col items-center">
                <p class="text-center text-base lg:text-base text-sm mb-8">
                    Yahtzeeとは、5つのサイコロを振って決められた<br class="sm:hidden">組み合わせ（役）を作り、得点を競うゲームです。<br>
                    13種類のスコア項目をすべて埋めた時点で、<br class="sm:hidden">合計点が最も高い人が勝ちとなります。<br>
                    ルールは簡単！子どもから大人まで気軽に楽しむことができます。
                </p>

                <flux:link class="mx-auto !font-normal text-sm text-zinc-600 hover:text-zinc-800 mb-8" :href="route('howtoplay')" wire:navigate>
                    {{ __('遊び方・ルールはこちら') }}
                </flux:link>

                <p class="text-center font-semibold lg:text-lg">
                    YahtzeeNoteはストレスのない入力・自動計算により、テンポのよい快適なプレイをサポートします。
                </p>
            </div>

        </div>
    </section>

    <!-- YahtzeeNoteの特徴 -->
    <section id="practice-areas" class="p-4 lg:px-16 pt-6 pb-10 bg-brand-yellow-200">

        <div class="container mx-auto text-center">

            <div class="lg:flex lg:items-center gap-20">

                <div class="bg-white/50 flex flex-col items-center lg:px-8 lg:py-16 py-4 text-center text-center">

                    <h2 class="lg:w-72 mb-6 lg:mb-10 text-2xl lg:text-3xl font-bold">YahtzeeNoteの特徴</h2>

                    <ul class="lg:w-72 space-y-2 text-center pl-6 gap-2 text-left list-disc text-base lg:text-xl">
                        <li>
                            <h3>スコアの簡単入力、自動計算</h3>
                            <p></p>
                        </li>
                        <li>
                            <h3>最大６人まで同時プレイ可能</h3>
                            <p></p>
                        </li>
                        <li>
                            <h3>スコア履歴の保存・閲覧</h3>
                            <p></p>
                        </li>
                        <li>
                            <h3>メンバーの登録・管理</h3>
                            <p></p>
                        </li>
                    </ul>
                </div>

                <div class="w-full lg:w-7/10 my-10">
                    <video width="100%" height="auto" controls autoplay muted playsinline loop>
                        <source src="{{ asset('videos/input_scores.mp4') }}" type="video/mp4">
                        <p>動画を再生できないブラウザを使用しています。</p>
                    </video>
                </div>

            </div>

            @auth
            <flux:button
                variant="primary"
                icon="play"
                class="lg:mt-12 lg:w-32 lg:h-12 text-center border bg-white !text-zinc-600 hover:!bg-brand-yellow-600 !font-semibold hover:!font-bold"
                :href="route('play.create')"
                :current="request()->routeIs('top')"
                wire:navigate>
                {{ __('ゲームを始める') }}
            </flux:button>
            @endauth

            @guest
            <flux:button
                variant="primary"
                icon="play"
                class="lg:mt-12 lg:w-32 lg:h-12 text-center border bg-white !text-zinc-600 hover:!bg-brand-yellow-600 !font-semibold hover:!font-bold"
                :href="route('login')"
                :current="request()->routeIs('top')"
                wire:navigate>
                {{ __('ゲームを始める') }}
            </flux:button>
            @endguest

        </div>
    </section>
</div>