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
            $weight = Criteria::query()->select(['weight', 'attribute'])->get();

            $formula = new Formula($this->values);
            $devider = $formula->devider();
            $normalize = $formula->normalize($devider);
            $optimized = $formula->optimize($weight->pluck('weight')->toArray(), $normalize);
            $results = $formula->result($weight->pluck('attribute')->toArray(), $optimized);

            Result::create([
                'data' => json_encode(array_merge($results, [
                    'devider' => $devider,
                    'normalize' => $normalize,
                    'optimized' => $optimized,
                ])),
                'created_by' => Auth::id(),
            ]);

            $this->dispatchBrowserEvent('flash', [
                'color' => 'green',
                'message' => "Data berhasil dihitung"
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
