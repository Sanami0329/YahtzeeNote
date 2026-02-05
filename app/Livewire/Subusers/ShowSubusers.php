<?php

namespace App\Livewire;

use App\Models\Subuser;
use Livewire\Component;
// use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class ShowSubusers extends Component
{
    use WithPagination;

    public function moveEdit($subuserId)
    {
        $subuser = Subuser::findOrFail($subuserId);

        return redirect()->route('edit.subuser', ['subuser' => $subuser]);
    }

    public function render()
    {
        $subusers = Subuser::query()
            ->where('user_id', auth()->id())
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.show-subusers', [
            'subusers' => $subusers
        ]);
    }
}
