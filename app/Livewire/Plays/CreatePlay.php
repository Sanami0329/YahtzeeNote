<?php

namespace App\Livewire\Plays;

use App\Models\Play;
use App\Models\Subuser;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;

#[Title("プレーヤー入力")]
class CreatePlay extends Component
{
    use WithPagination;

    public $playerArray = [];

    public array $selectedSubuserArray = [];

    public function mount()
    {
        $this->playerArray[0] = [
            'isRegistered' => false,
            'id' => null,
            'name' => null,
        ];
    }

    public function updated($property) //プロパティ更新ごとの実行
    {
        $this->validateOnly($property);
    }

    public function selectedSubuser($subuserId, $index)
    {
        // モーダルを閉じる
        $this->js("Flux.modal('select-subuser').close()");

        $subuser = Subuser::findOrFail($subuserId);

        $this->playerArray[$index] = [
            'isRegistered' => true,
            'id'   => $subuser->id,
            'name' => $subuser->name,
        ];

        if (count($this->playerArray) < 5) {
            $this->playerArray[$index + 1] = [
                'isRegistered' => false,
                'id' => null,
                'name' => null,
            ];
        }

        $this->selectedSubuserArray[$index] = [$subuserId];
    }

    public function addInput($index)
    {
        $this->playerArray[$index + 1] = [
            'id' => false,
            'id' => null,
            'name' => null,
        ];
    }

    public function removeInput($index)
    {
        if (count($this->playerArray) === 1) {
            return;
        }

        if ($this->playerArray[$index]['id'] != null) {
            unset($this->selectedSubuserArray[$index]);
        }

        // 削除
        unset($this->playerArray[$index]);

        // インデックスキー詰め直し
        $this->playerArray = array_values($this->playerArray);
    }


    private function filterPlayerArray()
    {
        if (empty($this->playerArray)) {
            $this->playerArray[0] = [
                'isRegistered' => false,
                'id' => null,
                'name' => null,
            ];
        } else {

            $filteredArray = [];

            foreach ($this->playerArray as $key => $player) {
                if (!empty($player['name'])) {
                    $filteredArray[$key] = $player;
                }
            }

            $this->playerArray = $filteredArray;
        }
    }


    // バリデーション
    protected function rules()
    {
        return [
            'playerArray.*.name' => ['required', 'string', 'max:10'],
        ];
    }

    protected $message = [
        'playerArray.*.name.max' => '10文字以内で入力してください',
    ];


    public function save()
    {
        // 空欄詰め直し
        $this->filterPlayerArray();

        // インデックスキー詰め直し
        $this->playerArray = array_values($this->playerArray);

        $this->validate();

        session(['created.players.data' => $this->playerArray]);

        return redirect()->route('play.prepare');
    }

    public function render()
    {
        $query = Subuser::where('user_id', auth()->id());

        if (!empty($this->selectedSubuserArray)) {
            $query->whereNotIn('id', $this->selectedSubuserArray);
        }

        $subusers = $query->paginate(10);

        return view('livewire.plays.create-play', [
            'subusers' => $subusers,
        ]);
    }
}
