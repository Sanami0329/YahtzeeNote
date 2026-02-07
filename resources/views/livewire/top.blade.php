<div class="text-zinc-900">
    <!-- ヒーローセクション -->
    <section class="relative h-screen flex items-center justify-center text-white mt-6 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary to-secondary opacity-90"></div>
        <img
            src="{{ asset('images/top_image_dices2.jpg') }}"
            alt="dices"
            class="absolute w-full h-dvh object-cover object-center"
            style="opacity: 0.8;">

        <div class="md:w-2/3 md:h-1/2 mx-auto felx items-center bg-white/30 backdrop-blur-sm text-center">
            <div class="my-auto flex flex-col gap-10 pt-14 pb-6">
                <h1 class="mx-auto text-4xl md:text-5xl font-bold text-zinc-900 text-shadow">
                    YahtzeeNote
                </h1>
                <p class="mx-auto text-base md:text-lg px-8 text-shadow text-zinc-900 ">
                    Yahtzee（ヤッツィー）のスコアを紙要らずで素早く入力、自動計算。<br>
                    プレイ履歴やいつものメンバーもまとめて管理。
                </p>
                <flux:button variant="primary" class="mx-auto w-24">{{ __('使ってみる') }}</flux:button>
            </div>
        </div>
    </section>

    <!-- Yahtzeeとは -->
    <section id="practice-areas" class="py-16 bg-white">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-primary">Yahtzee（ヤッツィー）とは？</h2>
            </div>

            <div class="flex flex-col items-center">
                <p class="text-center text-base">
                    Yahtzeeとは、5つのサイコロを使って組み合わせ（役）を作り、得点を競うゲームです。<br>
                    13種類のスコア項目をすべて埋めた時点で、合計点が最も高い人が勝ちとなります。<br>
                    ルールは簡単！子どもから大人まで気軽に楽しむことができます。
                </p>

                <p class="mt-16 text-center font-semibold text-lg">
                    YahtzeeNoteはストレスのない入力・自動計算により、テンポのよい快適なプレイをサポートします。
                </p>
            </div>

        </div>
    </section>

    <!-- YahtzeeNoteの特徴 -->
    <section id="practice-areas" class="py-16 bg-brand-yellow-200">
        <div class="container mx-auto px-4 lg:px-16">

            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-primary">YahtzeeNoteの特徴</h2>

                <ul class="flex flex-col gap-4 text-left list-disc text-lg">
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

                <flux:button variant="primary" class="mx-auto w-24">{{ __('ゲームを始める') }}</flux:button>
                
            </div>
        </div>
    </section>
</div>