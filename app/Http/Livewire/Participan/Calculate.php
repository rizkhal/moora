<?php

namespace App\Http\Livewire\Participan;

use App\Models\User;
use App\Models\Result;
use Livewire\Component;
use App\Models\Criteria;
use App\Services\Formula;
use Illuminate\Support\Facades\Auth;

class Calculate extends Component
{
    /** @var array */
    public $values = [];
    public $alternative;
    // public $alternative = [
    //     [0.5, 0.8, 1, 0.2, 1], // c1 => max
    //     [1, 0.7, 0.3, 1, 0.7], // c2 => max
    //     [0.7, 1, 0.4, 0.5, 0.4], // c3 => max
    //     [0.7, 0.5, 0.7, 0.9, 0.7], // c4 => min
    //     [0.8, 1, 1, 0.7, 1], // c5 => min
    // ];

    protected $listeners = [
        'setAlternative' => 'setAlternative'
    ];

    public function setAlternative($alternative)
    {
        $this->alternative = User::whereIn('id', $alternative)->get();
    }

    public function calculate()
    {
        $this->validate([
            'values' => ['required'],
        ]);

        try {
            $weight = Criteria::query()->pluck('weight')->toArray();
            $divider = Formula::calculateDivider(array_values($this->values));
            $normalize = Formula::normalize(array_values($this->values), $divider);
            $optimize = Formula::optimizeAttribute($weight, $normalize);
            $results = Formula::result($optimize);

            $userIds = [];
            foreach ($this->values as $key => $value) {
                $userIds[] = $key;
            }

            Result::create([
                'data' => json_encode(array_merge($results, ['user' => $userIds])),
                'created_by' => Auth::id(),
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.participan.calculate', [
            'criterias' => Criteria::query()->select(['id', 'code', 'name'])->get(),
        ]);
    }
}
