<div class="mx-auto px-4 py-10 bg-brand-yellow-200 text-zinc-700 text-left">
    <div class="w-full sm:w-96 sm:w-xl sm:mx-auto">

        <h1 class="block w-fit mx-auto sm:mx-0 my-8 text-xl sm:text-2xl font-bold">Yahtzee（ヤッツィー）の遊び方</h1>

        <!-- ゲームの準備 -->
        <div class="mb-4">
            <h2 class="bg-brand-yellow-400 px-2 py-4 font-semibold text-xl">⚀ ゲームの準備 ⚀</h2>
            <div class="bg-zinc-50 p-4">
                <div class="mb-4">
                    <h3 class="font-semibold text-lg mb-2">プレイヤー人数</h3>
                    <ul class="list-disc text-left pl-6">
                        <li>1人～（通常2人～4人）</li>
                    </ul>
                </div>
                <div class="mb-4">
                    <h3 class="font-semibold text-lg mb-2">準備するもの</h3>
                    <ul class="list-disc text-left pl-6">
                        <li>サイコロ５つ</li>
                        <li>カップ（あれば便利）<br>
                            <span>サイコロが四方に散らばるのを防ぎます</span>
                        </li>
                        <li>YahtzeeNoteアプリ</li>
                        <li>Yahtzeeを楽しむ心</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ゲームの進め方 -->
        <div class="mb-4">
            <h2 class="bg-brand-yellow-400 px-2 py-4 font-semibold text-xl">⚁ ゲームの進め方 ⚁</h2>
            <div class="bg-zinc-50 p-4">
                <p class="mb-2">Yahtzeeは全13ラウンド。<br class="sm:hidden">1ラウンドごとに全プレイヤーが必ず1回プレイします。</p>
                <ol class="px-6 list-decimal text-left">
                    <li class="mb-4">
                        <h3 class="font-semibold text-lg mb-2">サイコロを振る</h3>
                        <ul class="px-6 list-disc">
                            <li>5つのサイコロを同時に振ります</li>
                        </ul>
                    </li>

                    <li class="mb-4">
                        <h3 class="font-semibold text-lg mb-2">サイコロを振り直す（2回まで）</h3>
                        <ul class="px-6 list-disc">
                            <li>振って出たサイコロの目が気に入らない場合は、最大2回振り直しができます。（1ターン合計3回まで）</li>
                            <li>好きなサイコロを残し、気に入らないサイコロだけ振り直すことができます。</li>
                        </ul>
                    </li>

                    <li class="mb-4">
                        <h3 class="font-semibold text-lg mb-2">スコア項目を選ぶ</h3>
                        <p class="mb-2">1ターンごとに必ず1つスコア項目を埋めます</p>
                        <ul class="px-6 list-disc">
                            <li>
                                振ったサイコロの目を見て、どのスコア項目に得点を入れるか決めます。
                            </li>
                            <p class="sm:w-md my-2 py-2 px-4 border bg-zinc-100 text-sm sm:text-base">
                                例<br>
                                2 2 5 5 5<br>
                                →選択肢1：フルハウスとして得点を獲得<br>
                                →選択肢2：ファイブ(5)として得点を獲得
                            </p>

                            <li>
                                既に使用したスコア項目へ得点を入れることはできません。
                            </li>
                            <p class="sm:w-md my-2 py-2 px-4 border bg-zinc-100 text-sm sm:text-base">
                                例<br>
                                1 3 4 4 4 ：既にフォー(4)が埋まっている<br>
                                →3コンボとして得点を獲得<br>
                            </p>

                            <li>
                                得点を獲得できない場合も、いずれか1つスコア項目を選び、<br>
                                0点を入れてそのターンを終了します。
                            </li>
                            <p class="sm:w-md my-2 py-2 px-4 border bg-zinc-100 text-sm sm:text-base">
                                例<br>
                                2 2 2 3 4 ：既にツー(2)や3コンボが埋まっている<br>
                                →選択肢1：エース(1)に「0」を入れる<br>
                                →選択肢2：獲得する見込みの薄いYahtzeeに「0」を入れる
                            </p>
                        </ul>
                    </li>
                </ol>
            </div>
        </div>

        <!-- スコア項目・得点ルール -->
        <div class="mb-4">
            <h2 class="bg-brand-yellow-400 px-2 py-4 font-semibold text-xl">⚂ スコア項目・得点ルール ⚂</h2>
            <div class="bg-zinc-50 p-4 overflow-x-auto">
                <table class="border-collapse border border-zinc-600 text-zinc-800">
                    {{-- Column Headers --}}
                    <thead>
                        <tr class="bg-zinc-100 text-left">
                            <th class="min-w-48 px-4 border border-zinc-400 !font-normal">{{ __('スコア項目') }}</th>
                            <th class="min-w-60 px-4 border border-zinc-400 !font-normal">{{ __('得点ルール') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach([
                        ['name' => 'エース (1)', 'eng_name' => 'Ones', 'desc' => '1の目の合計', 'eng_desc' => 'Count and add only Ones'],
                        ['name' => 'ツー (2)', 'eng_name' => 'Twos', 'desc' => '2の目の合計', 'eng_desc' => 'Count and add only Twos'],
                        ['name' => 'スリー (3)', 'eng_name' => 'Threes', 'desc' => '3の目の合計', 'eng_desc' => 'Count and add only Threes'],
                        ['name' => 'フォー (4)', 'eng_name' => 'Fours', 'desc' => '4の目の合計', 'eng_desc' => 'Count and add only Fours'],
                        ['name' => 'ファイブ (5)', 'eng_name' => 'Fives', 'desc' => '5の目の合計', 'eng_desc' => 'Count and add only Fives'],
                        ['name' => 'シックス (6)', 'eng_name' => 'Sixes', 'desc' => '6の目の合計', 'eng_desc' => 'Count and add only Sixes'],
                        ['name' => '3コンボ', 'eng_name' => '3 of a Kind', 'desc' => '同じ目が3つ以上で全部の合計', 'eng_desc' => 'Add total of all dice'],
                        ['name' => '4コンボ', 'eng_name' => '4 of a Kind', 'desc' => '同じ目が4つ以上で全部の合計', 'eng_desc' => 'Add total of all dice'],
                        ['name' => 'フルハウス', 'eng_name' => 'Full House', 'desc' => '同じ目が3つと2つで25点', 'eng_desc' => 'Score 25'],
                        ['name' => 'スモール・ストレート', 'eng_name' => 'Small Straight', 'desc' => '4つの連続した目が揃えば30点', 'eng_desc' => 'Score 30'],
                        ['name' => 'ラージ・ストレート', 'eng_name' => 'Large Straight', 'desc' => '5つの連続した目が揃えば40点', 'eng_desc' => 'Score 40'],
                        ['name' => 'YAHTZEE（ヤッツィー）', 'eng_name' => 'YAHTZEE', 'desc' => '同じ目が5つで50点', 'eng_desc' => 'Score 50'],
                        ['name' => 'チャンス', 'eng_name' => 'Chance', 'desc' => '全部の目の合計', 'eng_desc' => 'Total of all 5 dice'],
                        ] as $row)
                        <tr class="bg-white text-left">
                            <th class="min-w-48 px-4 border border-zinc-400 !font-normal">{{ $row['name'] }}</th>
                            <td class="min-w-56 px-4 border border-zinc-400 !font-normal">{{ __($row['desc']) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 勝敗について -->
        <div class="mb-4">
            <h2 class="bg-brand-yellow-400 px-2 py-4 font-semibold text-xl">⚃ 勝敗について ⚃</h2>
            <div class="bg-zinc-50 p-4">
                <ul class="px-6 list-disc text-left">
                    <li>13ラウンド、全プレイヤーがすべてのスコア項目を埋めた時点で終了です。</li>
                    <li>もっとも得点の高いプレイヤーが勝者となります。</li>
                </ul>
            </div>
        </div>

    </div>
</div>