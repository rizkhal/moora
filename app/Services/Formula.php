<?php

namespace App\Services;

class Formula
{
    public static function result(array $optimizedAttribute): array
    {
        $max = [];
        $min = [];
        $yii = [];
        $rank = [];
        $count = count($optimizedAttribute);
        // mencari nilai max dan min
        for ($i = 0; $i < $count; $i++) {
            // need refactoring
            // dynamic criteria cost | benefit
            for ($j = 0; $j < $count; $j++) {
                // looping ke kanan untuk
                // mengurutkan matriks yang 
                // sudah dioptimasi kemudian
                if ($i <= 2) {
                    // lakukan pengujian
                    // jika nilai i <= 2 (note: i < 2 adalah max pada alternatif)
                    // maka uji lagi dengan $max[$j]
                    // jika $max[$j] tidak ada maka
                    // isi $max[$j] dengan nilai 0
                    if (!isset($max[$j])) {
                        $max[$j] = 0;
                    }

                    // jumlahkan nilai optimasi max
                    $max[$j] += $optimizedAttribute[$i][$j];
                }

                if ($i >= 3) {
                    // sama kaya diatas,
                    // bedanya ini untuk min
                    if (!isset($min[$j])) {
                        $min[$j] = 0;
                    }

                    $min[$j] += $optimizedAttribute[$i][$j];
                }
            }
        }

        for ($i = 0; $i < count($max); $i++) {
            $yii[$i] = $max[$i] - $min[$i];
        }

        // remove duplicate value
        // $rank = array_unique($yii);
        // get rank
        // rsort($rank);

        return [
            'max' => $max,
            'min' => $min,
            'yi' => $yii
        ];
    }

    /**
     * Rumus menghitung nilai optimasi
     * 
     * @see https://cahyadsn.phpindonesia.id/extra/img/moo03.png
     * @see https://cahyadsn.phpindonesia.id/extra/img/moo04.png
     */
    public static function optimizeAttribute(array $bobot, array $normalize): array
    {
        $result = [];
        $count  = count($normalize);
        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < $count; $j++) {
                // looping ke kanan untuk
                // mengurutkan matriks yang 
                // sudah dinormalisasi kemudian
                // dikalikan dengan $bobot
                $result[$i][$j] = ($normalize[$i][$j] * $bobot[$i]);
            }
        }

        return $result;
    }

    /**
     * Rumus mendapatkan pembagi dan normalisasi
     * 
     * @see https://cahyadsn.phpindonesia.id/extra/img/moo02.png
     */
    public static function normalize(array $matrix, array $pembagi): array
    {
        $result = [];
        $count  = count($matrix);
        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < $count; $j++) {
                // looping ke kanan untuk
                // mengurutkan matriks dan
                // membagi dengan $pembagi
                $result[$i][$j] = ($matrix[$i][$j] / $pembagi[$i]);
            }
        }

        return $result;
    }

    public static function calculateDivider(array $matrix): array
    {
        $tmp = [];
        $result = [];
        $count = count($matrix);
        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < $count; $j++) {
                // looping ke kanan untuk
                // mendapatkan hasil kuadrat dari matrix
                $tmp[$i][$j] = pow($matrix[$i][$j], 2);
            }

            // jumlahkan hasil matriks
            // dan ambil akar kuadrat
            // menggunakan metode `sqrt`
            $result[] = sqrt(array_sum($tmp[$i]));
        }

        return $result;
    }
}
