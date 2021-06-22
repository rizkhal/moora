<?php

// rumus perhitungan moora
// @see https://cahyadsn.phpindonesia.id/extra/moora.php

namespace Tests\Feature;

use Tests\TestCase;

class MooraTest extends TestCase
{
    // max => benefit
    // min => cost
    protected $criteria = [
        [0.5, 0.8, 1, 0.2, 1], // c1 => max
        [1, 0.7, 0.3, 1, 0.7], // c2 => max
        [0.7, 1, 0.4, 0.5, 0.4], // c3 => max
        [0.7, 0.5, 0.7, 0.9, 0.7], // c4 => min
        [0.8, 1, 1, 0.7, 1], // c5 => min
    ];

    /**
     * bobot sync with criteria
     * 
     * c1 => 0.3
     * c2 => 0.2
     * c3 => 0.2
     * c4 => 0.15
     * c5 => 0.15
     */
    protected $bobot = [
        0.3, 0.2, 0.2, 0.15, 0.15
    ];

    public function test_calculate()
    {
        // hitung pembagi
        $pembagi = $this->calculatePembagi($this->criteria);

        $this->assertEquals([
            1.7117242768624,
            1.7521415467935,
            1.4352700094407,
            1.5905973720587,
            2.0322401432902
        ], $pembagi);

        // normalisasi mtriks
        $normalize = $this->normalize($this->criteria, $pembagi);
        
        $this->assertEquals([
            [0.29210311891849, 0.46736499026959, 0.58420623783699, 0.1168412475674, 0.58420623783699],
            [0.57073014553535, 0.39951110187474, 0.1712190436606, 0.57073014553535, 0.39951110187474],
            [0.48771311000413, 0.69673301429162, 0.27869320571665, 0.34836650714581, 0.27869320571665],
            [0.44008622942335, 0.31434730673097, 0.44008622942335, 0.56582515211574, 0.44008622942335],
            [0.3936542650441, 0.49206783130512, 0.49206783130512, 0.34444748191359, 0.49206783130512],
        ], $normalize);
        
        // optimasi attribute
        $optimizedAttribute = $this->optimizeAttribute($normalize);
        
        $this->assertEquals([
            [0.087630935675548, 0.14020949708088, 0.1752618713511, 0.035052374270219, 0.1752618713511],
            [0.11414602910707, 0.079902220374949, 0.034243808732121, 0.11414602910707, 0.079902220374949],
            [0.097542622000826, 0.13934660285832, 0.055738641143329, 0.069673301429162, 0.055738641143329],
            [0.066012934413503, 0.047152096009645, 0.066012934413503, 0.084873772817361, 0.066012934413503],
            [0.059048139756615, 0.073810174695768, 0.073810174695768, 0.051667122287038, 0.073810174695768],
        ], $optimizedAttribute);
        
        // cari hasil
        $result = $this->result($optimizedAttribute);
        
        $this->assertEquals([
            "max" => [
                0.29931958678344
                ,0.35945832031415
                ,0.26524432122655
                ,0.21887170480645
                ,0.31090273286937
              ],
              "min" => [
                0.12506107417012
                ,0.12096227070541
                ,0.13982310910927
                ,0.1365408951044
                ,0.13982310910927
              ],
              "yi" => [
                0.17425851261333
                ,0.23849604960874
                ,0.12542121211727
                ,0.082330809702052
                ,0.1710796237601
              ],
              "rank" => [
                0.23849604960874
                ,0.17425851261333
                ,0.1710796237601
                ,0.12542121211727
                ,0.082330809702052
              ]
        ], $result);
    }

    protected function result(array $optimizedAttribute)
    {
        $max = [];
        $min = [];
        $yii = [];
        $rank = [];
        $count = count($optimizedAttribute);
        // mencari nilai max dan min
        for ($i = 0; $i < $count; $i++) {
            for ($j=0; $j < $count; $j++) { 
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

        for ($i=0; $i < count($max); $i++) { 
            $yii[$i] = $max[$i] - $min[$i];
        }

        $rank = array_unique($yii);
		rsort($rank);
        
        return [
            'max' => $max,
            'min' => $min,
            'yi' => $yii,
            'rank' => $rank,
        ];
    }

    /**
     * Rumus menghitung nilai optimasi
     * 
     * @see https://cahyadsn.phpindonesia.id/extra/img/moo03.png
     * @see https://cahyadsn.phpindonesia.id/extra/img/moo04.png
     */
    protected function optimizeAttribute(array $normalize)
    {
        $result = [];
        $count  = count($normalize);
        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < $count; $j++) {
                // looping ke kanan untuk
                // mengurutkan matriks yang 
                // sudah dinormalisasi kemudian
                // dikalikan dengan $bobot
                $result[$i][$j] = ($normalize[$i][$j] * $this->bobot[$i]);
            }
        }

        return $result;
    }
    
    /**
     * Rumus mendapatkan pembagi dan normalisasi
     * 
     * @see https://cahyadsn.phpindonesia.id/extra/img/moo02.png
     */
    protected function normalize(array $matrix, array $pembagi): array
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

    protected function calculatePembagi(array $matrix)
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
