<div>
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>YahtzeeNote トップページ</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">

        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#3f0d17',
                            'primary-light': '#f7dfe4',
                            secondary: '#7c303f',
                            accent: '#54979c',
                        },
                        fontFamily: {
                            serif: ['"Noto Serif JP"', 'serif'],
                        }
                    }
                }
            }
        </script>

        <style>
            body {
                font-family: "Noto Serif JP", serif;
            }

            .hero-gradient {
                background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
            }

            .text-shadow {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            }

            @media (max-width: 768px) {
                .mobile-menu {
                    display: none;
                }

                .mobile-menu.active {
                    display: block;
                }
            }
        </style>
    </head>

    {{-- ヒーローセクション --}}
    <section class="relative h-screen flex items-center justify-center text-white mt-16 overflow-hidden" style="background: linear-gradient(45deg, #E07987 50%, #7F9ED0 50%);">
        <div class="absolute inset-0 bg-gradient-to-r from-primary to-secondary opacity-90"></div>
        <img src="{{ asset('images/dices_5.jpg') }}" alt="dices" class="absolute w-full" style="opacity: 0.8;">

        <div class="relative w-full z-10 text-center py-8 px-4 mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 text-shadow text-gray-50">
                YahtzeeNote
            </h1>
            <p class="text-lg md:text-xl mb-8 text-shadow text-gray-50">
                紙いらずでYahtzee（ヤッツィー）のスコアを素早く入力、自動計算。<br>
                プレイ履歴やいつものメンバーもまとめて管理。
            </p>
        </div>
    </section>

    {{-- 特徴 --}}
    <section id="practice-areas" class="py-16 bg-white">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-primary">YahtzeeNoteの特徴</h2>
            </div>

            <div class="flex justify-center">
                <ul class="flex flex-col gap-4 text-left">
                    <li>１．スコアの簡単入力、自動計算</li>
                    <li>２．最大６人まで同時プレイ対応</li>
                    <li>３．スコア履歴の保存・閲覧</li>
                    <li>４．メンバーの登録・管理</li>
                </ul>

            </div>
        </div>
    </section>

    {{-- 遊び方と使い方 --}}
    <section id="flow" class="py-16 bg-brand-yellow-200">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-primary">Yahtzeeの遊び方</h2>
            </div>

            <div class="max-w-4xl mx-auto space-y-12">
                @php
                $steps = [
                ['num' => '01', 'title' => 'お問い合わせ', 'subtitle' => 'フォームまたはお電話からご連絡ください。', 'desc' => '初回のご相談は無料です。お気軽にお問い合わせください。'],
                ['num' => '02', 'title' => 'ヒアリング', 'subtitle' => '状況をお伺いし、必要な資料や優先事項を確認します。', 'desc' => '詳しい状況を伺い、最適な解決方法を検討します。'],
                ['num' => '03', 'title' => '方針のご提案', 'subtitle' => '解決までの進め方と費用の目安をご案内します。', 'desc' => '具体的な解決策と、費用の見積もりをご提示します。'],
                ['num' => '04', 'title' => '手続き・交渉', 'subtitle' => '合意形成や手続きを進め、解決を目指します。', 'desc' => '必要な手続きを代行し、スムーズな解決をサポートします。'],
                ];
                @endphp

                @foreach($steps as $index => $step)
                <div class="flex flex-col md:flex-row gap-6 items-start">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-primary text-white rounded-full flex items-center justify-center text-2xl font-bold">
                            {{ $step['num'] }}
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-2">{{ $step['title'] }}</h3>
                        <p class="text-lg mb-3">
                            <span class="bg-yellow-200">{{ $step['subtitle'] }}</span>
                        </p>
                        <p class="text-gray-600 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @if($index < count($steps) - 1)
                    <div class="flex justify-center">
                    <i class="bi bi-arrow-down text-3xl text-primary opacity-30"></i>
            </div>
            @endif
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="#contact" class="inline-block bg-accent hover:bg-accent/80 text-white px-8 py-3 rounded-full font-bold transition">
                ゲームを始める
            </a>
        </div>
</div>
</section>

{{-- 取扱分野 --}}
    <section id="practice-areas" class="py-16 bg-primary-light">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="text-center mb-12">
                <p class="text-sm text-gray-600 uppercase tracking-wider mb-2">Practice Areas</p>
                <h2 class="text-3xl md:text-4xl font-bold text-primary">取扱分野</h2>
            </div>
            
            <p class="text-center max-w-3xl mx-auto mb-12 leading-relaxed">
                離婚・相続・交通事故・労働問題・借金(債務整理)・企業法務など、幅広いご相談に対応しています。まずは状況を丁寧に伺い、解決までの見通しと選択肢をわかりやすくご説明します。内容により最適な進め方は異なりますので、些細なことでも一人で抱え込まず、お気軽にお問い合わせください。秘密は厳守いたします。
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                $practiceAreas = [
                    ['icon' => 'bi-heartbreak', 'title' => '離婚・男女問題', 'desc' => '離婚協議、財産分与、親権問題など、男女間のトラブルに関する法的サポートを提供します。'],
                    ['icon' => 'bi-journal-text', 'title' => '相続・遺言', 'desc' => '相続手続き、遺言書作成、遺産分割協議など、相続に関する幅広いサポートを行います。'],
                    ['icon' => 'bi-car-front', 'title' => '交通事故', 'desc' => '交通事故の示談交渉、損害賠償請求、後遺障害認定など、被害者の権利を守ります。'],
                    ['icon' => 'bi-person-workspace', 'title' => '労働問題', 'desc' => '不当解雇、残業代請求、ハラスメント問題など、労働者の権利を保護します。'],
                    ['icon' => 'bi-cash-coin', 'title' => '借金・債務整理', 'desc' => '任意整理、個人再生、自己破産など、借金問題の解決をサポートします。'],
                    ['icon' => 'bi-briefcase', 'title' => '企業法務', 'desc' => '契約書作成、コンプライアンス、労務管理など、企業の法的課題に対応します。'],
                ];
                @endphp
                
                @foreach($practiceAreas as $area)
                <div class="bg-white border border-gray-200 p-6 rounded-lg hover:border-primary transition group">
                    <div class="flex items-start space-x-4">
                        <i class="{{ $area['icon'] }} text-3xl text-accent"></i>
                        <div>
                            <h3 class="text-xl font-bold mb-2 group-hover:text-primary transition">{{ $area['title'] }}</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $area['desc'] }}</p>
                            <a href="#" class="inline-block mt-4 text-primary hover:text-secondary transition">詳しくみる →</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 選ばれる理由 --}}
    <section id="why-us" class="py-16 bg-primary text-white">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="text-center mb-12">
                <p class="text-sm text-primary-light uppercase tracking-wider mb-2">Why Choose Us</p>
                <h2 class="text-3xl md:text-4xl font-bold">選ばれる理由</h2>
                <p class="mt-4">初めての方にも、わかりやすく丁寧に対応します。</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                $reasons = [
                    ['num' => '01', 'title' => 'わかりやすい説明', 'desc' => '専門用語はできるだけ避け、状況と選択肢を整理してご説明します。'],
                    ['num' => '02', 'title' => '迅速・丁寧な対応', 'desc' => 'ご相談内容を確認し、できるだけ早く次の動きをご案内します。'],
                    ['num' => '03', 'title' => '秘密厳守', 'desc' => 'ご相談内容や個人情報は厳重に取り扱います。'],
                ];
                @endphp
                
                @foreach($reasons as $reason)
                <div class="bg-white text-gray-800 p-8 rounded-lg relative">
                    <div class="absolute -top-4 -right-4 text-6xl text-primary-light opacity-30 font-bold">#{{ $reason['num'] }}</div>
                    <h3 class="text-2xl font-bold mb-4 relative z-10">{{ $reason['title'] }}</h3>
                    <p class="leading-relaxed relative z-10">{{ $reason['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ご相談の流れ --}}
    <section id="flow" class="py-16">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="text-center mb-12">
                <p class="text-sm text-gray-600 uppercase tracking-wider mb-2">How It Works</p>
                <h2 class="text-3xl md:text-4xl font-bold text-primary">ご相談の流れ</h2>
                <p class="mt-4 text-gray-600">まずは状況を整理し、見通しと方針をご提案します。</p>
            </div>
            
            <div class="max-w-4xl mx-auto space-y-12">
                @php
                $steps = [
                    ['num' => '01', 'title' => 'お問い合わせ', 'subtitle' => 'フォームまたはお電話からご連絡ください。', 'desc' => '初回のご相談は無料です。お気軽にお問い合わせください。'],
                    ['num' => '02', 'title' => 'ヒアリング', 'subtitle' => '状況をお伺いし、必要な資料や優先事項を確認します。', 'desc' => '詳しい状況を伺い、最適な解決方法を検討します。'],
                    ['num' => '03', 'title' => '方針のご提案', 'subtitle' => '解決までの進め方と費用の目安をご案内します。', 'desc' => '具体的な解決策と、費用の見積もりをご提示します。'],
                    ['num' => '04', 'title' => '手続き・交渉', 'subtitle' => '合意形成や手続きを進め、解決を目指します。', 'desc' => '必要な手続きを代行し、スムーズな解決をサポートします。'],
                ];
                @endphp
                
                @foreach($steps as $index => $step)
                <div class="flex flex-col md:flex-row gap-6 items-start">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-primary text-white rounded-full flex items-center justify-center text-2xl font-bold">
                            {{ $step['num'] }}
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-2">{{ $step['title'] }}</h3>
                        <p class="text-lg mb-3">
                            <span class="bg-yellow-200">{{ $step['subtitle'] }}</span>
                        </p>
                        <p class="text-gray-600 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @if($index < count($steps) - 1)
                <div class="flex justify-center">
                    <i class="bi bi-arrow-down text-3xl text-primary opacity-30"></i>
                </div>
                @endif
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="#contact" class="inline-block bg-accent hover:bg-accent/80 text-white px-8 py-3 rounded-full font-bold transition">
                    相談予約 / お問い合わせ
                </a>
            </div>
        </div>
    </section>

    {{-- ご利用料金の目安 --}}
    <section id="pricing" class="py-16 bg-primary text-white">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="text-center mb-12">
                <p class="text-sm text-primary-light uppercase tracking-wider mb-2">Estimated Fees</p>
                <h2 class="text-3xl md:text-4xl font-bold">ご利用料金の目安</h2>
                <p class="mt-4">内容により費用は異なります。まずは目安をご確認ください。</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                @php
                $pricingPlans = [
                    ['title' => 'ライト相談', 'price' => '00,000円〜', 'features' => ['初回の状況整理', '方針のご案内', '所要時間:○分〜']],
                    ['title' => 'スポット対応', 'price' => '00,000円〜', 'features' => ['書面チェック/交渉サポート等', '進め方の提案', '必要に応じて見積']],
                    ['title' => '継続サポート', 'price' => '00,000円〜', 'features' => ['継続的な法的サポート', '定期的なコンサルティング', '優先対応']],
                ];
                @endphp
                
                @foreach($pricingPlans as $plan)
                <div class="bg-white text-gray-800 p-8 rounded-lg">
                    <h3 class="text-2xl font-bold mb-2">{{ $plan['title'] }}</h3>
                    <p class="text-3xl font-bold text-primary mb-6">{{ $plan['price'] }}</p>
                    <ul class="space-y-3">
                        @foreach($plan['features'] as $feature)
                        <li class="flex items-start">
                            <i class="bi bi-check-circle-fill text-accent mr-2 mt-1"></i>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
            
            <div class="text-center">
                <a href="#" class="inline-block bg-white hover:bg-gray-100 text-primary px-8 py-3 rounded-full font-bold transition">
                    もっと詳しくみる
                </a>
            </div>
        </div>
    </section>

    {{-- お客様の声 --}}
    <section id="testimonials" class="py-16 bg-primary-light">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="text-center mb-12">
                <p class="text-sm text-gray-600 uppercase tracking-wider mb-2">Customer Testimonials</p>
                <h2 class="text-3xl md:text-4xl font-bold text-primary">お客様の声</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                $testimonials = [
                    ['name' => '会社員 / 30代', 'comment' => '説明がわかりやすく、安心して進められました。'],
                    ['name' => '会社員 / 30代', 'comment' => 'こちらの状況を丁寧に聞いてくれて、方針が明確になりました。'],
                    ['name' => '会社員 / 30代', 'comment' => '対応が早く、次に何をすべきか迷わず動けました。'],
                ];
                @endphp
                
                @foreach($testimonials as $testimonial)
                <div class="bg-white p-6 rounded-lg border border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                            <i class="bi bi-person-fill text-2xl text-gray-400"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">{{ $testimonial['name'] }}</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed">{{ $testimonial['comment'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- よく頂く質問 --}}
    <section id="faq" class="py-16 bg-secondary text-white">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="text-center mb-12">
                <p class="text-sm text-primary-light uppercase tracking-wider mb-2">FAQ</p>
                <h2 class="text-3xl md:text-4xl font-bold">よく頂く質問</h2>
            </div>
            
            <div class="max-w-3xl mx-auto space-y-4">
                @php
                $faqs = [
                    ['q' => '初回相談は無料ですか?', 'a' => 'はい、初回相談は無料です。お気軽にお問い合わせください。'],
                    ['q' => '相談内容は秘密にしてもらえますか?', 'a' => 'はい、守秘義務により、ご相談内容は厳重に管理いたします。'],
                    ['q' => '土日や夜間の相談も可能ですか?', 'a' => '事前にご予約いただければ、土日や夜間のご相談も承ります。'],
                ];
                @endphp
                
                @foreach($faqs as $faq)
                <details class="bg-white text-gray-800 rounded-lg">
                    <summary class="p-6 cursor-pointer font-bold flex items-center justify-between hover:bg-gray-50 transition">
                        <span>{{ $faq['q'] }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </summary>
                    <div class="px-6 pb-6 text-gray-600 leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- お知らせ --}}
    <section class="py-16">
        <div class="container mx-auto px-4 lg:px-16">
            <h2 class="text-3xl font-bold text-primary mb-8">お知らせ</h2>
            
            <div class="space-y-4">
                @php
                $news = [
                    ['date' => '2026/02/06', 'content' => '弁護士/行政書士/社労士/税理士/コンサル等向け 無料ホームページテンプレート tp_professionals1 公開。'],
                    ['date' => '2025/00/00', 'content' => 'サンプルテキスト。サンプルテキスト。サンプルテキスト。'],
                ];
                @endphp
                
                @foreach($news as $item)
                <div class="flex flex-col md:flex-row gap-4 pb-4 border-b border-gray-200">
                    <div class="text-sm text-gray-600 md:w-32 flex-shrink-0">{{ $item['date'] }}</div>
                    <div class="flex-1">{{ $item['content'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

{{-- フッター --}}
<footer class="bg-primary text-white py-12">
    <div class="container mx-auto px-4 lg:px-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <h3 class="text-2xl font-bold mb-4">法律事務所ロゴ</h3>
                <p class="mb-4">
                    〒000-0000 東京足立区XXXXXX1丁目1号<br>
                    Tel：000-0000-0000<br>
                    受付時間：月曜日から金曜日の8時から18時まで
                </p>

                <div class="flex space-x-4 mb-6">
                    <a href="#" class="text-2xl hover:text-primary-light transition"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-2xl hover:text-primary-light transition"><i class="bi bi-line"></i></a>
                    <a href="#" class="text-2xl hover:text-primary-light transition"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="text-2xl hover:text-primary-light transition"><i class="bi bi-instagram"></i></a>
                </div>

                <div class="space-x-4">
                    <a href="#" class="hover:text-primary-light transition">会社概要</a>
                    <a href="#" class="hover:text-primary-light transition">採用情報</a>
                    <a href="#" class="hover:text-primary-light transition">お問い合わせ</a>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold mb-4">アクセス</h3>
                <div class="aspect-video rounded overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3241.0448418561778!2d139.74267721573196!3d35.675897837870934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188b89b2e1c8b1%3A0x59a123e3d5ac5ab6!2z44CSMTAwLTAwMTQg5p2x5Lqs6YO95Y2D5Luj55Sw5Yy65rC455Sw55S677yR5LiB55uu77yX4oiS77yR!5e0!3m2!1sja!2sjp!4v1545036128899"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-6 border-t border-white/20 text-center text-sm">
            <p>Copyright© あなたのサイト名 All Rights Reserved.</p>
        </div>
    </div>
</footer>

{{-- ページトップボタン --}}
<a href="#" id="page-top" class="fixed bottom-8 right-8 bg-black/20 text-white w-14 h-14 rounded-full flex items-center justify-center hover:bg-black/40 transition opacity-0 pointer-events-none">
    <i class="bi bi-arrow-up text-2xl"></i>
</a>

<script>
    // モバイルメニュートグル
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('active');
    });

    // ページトップボタン
    window.addEventListener('scroll', function() {
        const pageTop = document.getElementById('page-top');
        if (window.scrollY > 300) {
            pageTop.classList.remove('opacity-0', 'pointer-events-none');
            pageTop.classList.add('opacity-100');
        } else {
            pageTop.classList.add('opacity-0', 'pointer-events-none');
            pageTop.classList.remove('opacity-100');
        }
    });

    // スムーススクロール
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // モバイルメニューを閉じる
                document.getElementById('mobile-menu').classList.remove('active');
            }
        });
    });
</script>
</body>

</html>
</div>