<?php

namespace App\Services;

use App\Enums\WeightType;
use Illuminate\Support\Collection;

class MooraFormula
{
    protected $matrix;

    public function __construct(Collection|array $matrix)
    {
        $this->matrix = $matrix;
    }

    protected function format(Collection|array $arr)
    {
        $tmp = [];
        foreach ($arr as $key => $subarr) {
            foreach ($subarr as $subkey => $subvalue) {
                $tmp[$subkey][$key] = $subvalue;
            }
        }

        return $tmp;
    }

    /**
     * Calculate divider
     * 
     * @return array
     */
    public function divider(): array
    {
        $result = [];

        foreach ($this->matrix as $i => $m) {
            foreach ($m as $j => $value) {
                $tmp[$i][$j] = pow($value, 2);
            }

            $result[$i] = sqrt(array_sum($tmp[$i]));
        }

        return $result;
    }

    /**
     * Geting divider and normalization
     * @see https://cahyadsn.phpindonesia.id/extra/img/moo02.png
     *
     * @param array $divider Result from normalize method
     * @return array
     */
    public function normalize(array $divider): array
    {
        $result = [];

        foreach ($this->matrix as $i => $matrix) {
            foreach ($matrix as $j => $value) {
                $result[$i][$j] = ($value / $divider[$i]);
            }
        }

        return $result;
    }

    /**
     * Calculate optimize
     * @see https://cahyadsn.phpindonesia.id/extra/img/moo03.png
     * @see https://cahyadsn.phpindonesia.id/extra/img/moo04.png
     * 
     * @param Collection|array $weight 
     * @param array $normalized
     * @return array
     */
    public function optimize(Collection|array $weight, array $normalized): array
    {
        $result = [];

        foreach ($normalized as $key => $value) {
            foreach ($value as $j => $v) {
                $result[$key][$j] = ($v * $weight[$j]);
            }
        }

        return $result;
    }

    public function result(Collection|array $attributes, array $optimized)
    {
        $max = [];
        $min = [];
        $yii = [];

        foreach ($optimized as $key => $value) {
            $res = 0;
            $res1 = 0;
            foreach ($attributes as $k => $attr) {
                if ($attr === WeightType::BENEFIT->value) {
                    $res += $value[$k];
                } else {
                    $res -= 0;
                }

                if ($attr === WeightType::COST->value) {
                    $res1 += $value[$k];
                } else {
                    $res1 -= 0;
                }
            }

            $max[$key] = $res;
            $min[$key] = $res1;
            $yii[$key] = $res - $res1;
        }

        $rank = $yii;
        arsort($rank, SORT_REGULAR);

        return [
            'max' => $max,
            'min' => $min,
            'yi' => $yii,
            'rank' => $rank
        ];
    }
}
