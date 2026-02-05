<?php

namespace App\Livewire;

use App\Models\Subuser;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class EditSubusers extends Component
{
    public Subuser $subuser; // ルートパラメータを受け取る
    public string $subuserName;


    protected $messages = [
        'subuserName.unique' => '既存の名前と重複しています',
        'subuserName.max' => '10文字以内で入力してください',
    ];


    public function mount(Subuser $subuser)
    {
        $this->subuser = $subuser;

        $this->subuserName = $subuser->name;
    }


    protected function rules()
    {
        return [
            'subuserName' => [
                'required',
                'string',
                'max:10',
                Rule::unique('subusers', 'name')
                    ->where('user_id', auth()->id())
                    ->ignore($this->subuser->id),
            ],
        ];
    }

    public function updatedSubuserName()
    {
        $this->validateOnly('subuserName'); //= $this->subuserName・rules()のキー・wire:model="subuserName"
    }


    public function delete()
    {
        if($this->subuser->user_id !== Auth::id()){
            abort(403);
        }

        $this->subuser->delete();

        return redirect()->route('subusers.show')->flash('status', 'メンバーを削除しました。');
    }


    public function save()
    {

        $this->validate();

        if($this->subuser->user_id !== Auth::id()){
            abort(403);
        }

        $this->subuser->update(['name' => $this->subuserName]);

        return redirect()->route('subusers.show');
    }

    public function render()
    {
        return view('livewire.edit-subusers');
    }
}
