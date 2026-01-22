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

    public array $subusers = [];

    protected $messages = [
        'subusers.*.unique' => '既存の名前と重複しています',
    ];

    public function mount()
    {
        $this->subusers = [''];
    }

    public function addInput()
    {
        $this->subusers[] = '';
    }

    public function removeInput($index)
    {
        unset($this->subusers[$index]);
        // 削除した段階で詰め直し
        $this->subusers = array_values($this->subusers);
    }

    protected function rules()
    {
        return [
            'subusers' => ['array', 'max:6'],
            'subusers.*' => [
                'required',
                'string',
                Rule::unique('subusers', 'name')->where('user_id', auth()->id()),
                function ($attribute, $value, $fail) {
                    // 入力中の配列内で同じ名前があるかチェック
                    $counts = array_count_values($this->subusers);
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
        $this->subusers = array_filter($this->subusers);

        $this->subusers = array_values($this->subusers);

        $this->validate();

        $subusersData = [];

        DB::transaction(function () use (&$subusersData) {

            foreach ($this->subusers as $subName) {
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

        session(['subusers_data' => $subusersData,]);

        return redirect()->route('play.prepare');
    }

    public function render()
    {
        return view('livewire.create-play');
    }
}
