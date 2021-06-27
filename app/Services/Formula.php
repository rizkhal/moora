<?php

namespace App\Services;

use App\Constants\Attribute;

class Formula
{
    protected $matrix;

    public function __construct($matrix)
    {
        $this->matrix = collect($this->format($matrix));
    }

    protected function format($arr)
    {
        $tmp = [];
        foreach ($arr as $key => $subarr) {
            foreach ($subarr as $subkey => $subvalue) {
                $tmp[$subkey][$key] = $subvalue;
            }
        }

        return $tmp;
    }

    public function result(array $attributes, array $optimized)
    {
        $max = [];
        $min = [];

        foreach ($optimized as $i => $matrix) {
            foreach ($matrix as $j => $value) {
                if ($attributes[$i] === Attribute::BENEFIT) {
                    if (!isset($max[$j])) {
                        $max[$j] = 0;
                    }

                    $max[$j] += $optimized[$i][$j];
                }

                if ($attributes[$i] === Attribute::COST) {
                    if (!isset($min[$j])) {
                        $min[$j] = 0;
                    }

                    $min[$j] += $optimized[$i][$j];
                }
            }
        }

        $yi = [];
        foreach ($optimized[0] as $i => $value) {
            $yi[$i] = $max[$i] - $min[$i];
        }
        
        return [
            'max' => $max,
            'min' => $min,
            'yi' => $yi,
        ];
    }

    public function optimize(array $weight, array $normalize): array
    {
        $result = [];
        foreach ($this->matrix as $i => $matrix) {
            foreach ($matrix as $j => $value) {
                $result[$i][$j] = ($normalize[$i][$j] * $weight[$i]);
            }
        }

        return $result;
    }

    public function normalize(array $pembagi): array
    {
        $result = [];
        foreach ($this->matrix as $i => $matrix) {
            foreach ($matrix as $j => $value) {
                $result[$i][$j] = ($value / $pembagi[$i]);
            }
        }

        return $result;
    }

    public function devider(): array
    {
        $result = [];
        foreach ($this->matrix as $i => $matrix) {
            foreach ($matrix as $j => $value) {
                $tmp[$i][$j] = pow($value, 2);
            }

            $result[] = sqrt(array_sum($tmp[$i]));
        }

        return $result;
    }
}
