<?php

namespace App\Livewire;

use App\Models\Subuser;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;
use App\Models\Player;
use Illuminate\Support\Facades\DB;


#[Title("プレーヤー入力")]
class CreatePlay extends Component
{

    public array $subuserArray = [];

    protected $messages = [
        'subuserArray.*.unique' => '既存の名前と重複しています',
        'subuserArray.*.max' => '10文字以内で入力してください',
    ];

    public function mount()
    {
        $this->subuserArray = [''];
    }

    public function addInput()
    {
        $this->subuserArray[] = '';
    }

    public function removeInput($index)
    {
        unset($this->subuserArray[$index]);
        // 削除した段階で詰め直し
        $this->subuserArray = array_values($this->subuserArray);
    }

    protected function rules()
    {
        return [
            'subuserArray' => ['array', 'max:6'],
            'subuserArray.*' => [
                'required',
                'string',
                'max:10',
                // subusersテーブルで名前が重複していないかチェック
                Rule::unique('subusers', 'name')->where('user_id', auth()->id()),
                // 入力中の配列内で同じ名前があるかチェック
                function ($attribute, $value, $fail) {
                    $counts = array_count_values($this->subuserArray);
                    if ($counts[$value] > 1) {
                        $fail('同じ名前は入力できません');
                    }
                },
            ],
        ];
    }

    public function updatedSubusers($index) //updatedをつけてプロパティ更新直後に実行
    {
        $this->validateOnly("subusers.$index");
    }

    public function save()
    {
        // 空欄を除外
        $this->subuserArray = array_filter($this->subuserArray);

        $this->subuserArray = array_values($this->subuserArray);

        $this->validate();

        $subusersData = [];


        DB::transaction(function () use (&$subusersData) { //ローカル変数を使用＆更新するために&で参照渡し

            foreach ($this->subuserArray as $subName) {
                $subuser = Subuser::firstOrcreate([
                    'user_id' => auth()->id(),
                    'name' => $subName,
                ]);

                Player::firstOrCreate(
                    [
                        'user_id' => auth()->id(),
                        'subuser_id' => $subuser->id,
                    ],
                    [
                        'name' => $subuser->name,
                    ]
                );

                $subusersData[] = [
                    'id' => $subuser->id,
                    'name' => $subuser->name,
                ];
            }
        });

        session(['subusers.data' => $subusersData,]);

        return redirect()->route('play.prepare');
    }

    public function render()
    {
        return view('livewire.create-play');
    }
}
