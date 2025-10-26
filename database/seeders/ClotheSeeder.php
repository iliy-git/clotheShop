<?php

namespace Database\Seeders;

use App\Models\Clothe;
use Illuminate\Database\Seeder;

class ClotheSeeder extends Seeder
{
    public function run(): void
    {
        $clothes = [
            [
                'name' => 'Мужская хлопковая футболка',
                'description' => 'Мягкая хлопковая футболка для повседневной носки.',
                'price' => 1299,
                'size' => 'M',
                'color' => 'черный',
                'category' => 'мужская',
                'image' => 'https://community.akamai.steamstatic.com/economy/image/C5ICScRs-sa8qjOIVneH3_IDEQVCaW_20WWBAJVGRfDaTPFmptnSWu2Fa3lf4HRSYhKukpArD-a-dpy_J-x0qYpzTl8tOsKXBhiYoqvt-V7P-1O_JFDpCQ/360fx360f',
                'stock' => 25,
            ],
            [
                'name' => 'Классические джинсы',
                'description' => 'Удобные джинсы прямого кроя из качественного денима.',
                'price' => 3499,
                'size' => 'L',
                'color' => 'синий',
                'category' => 'мужская',
                'image' => 'https://community.akamai.steamstatic.com/economy/image/C5ICScRs-sa8qjOIVneH3_IDEQVCaW_20WWBAJVGRfDaTPFmptfYWeeFdW9W53V5UwG9j5AsBeS4a6GvNvBPp98hTVwuPcGTXU-Yu7qx_LuTmv7-/360fx360f',
                'stock' => 18,
            ],
            [
                'name' => 'Мужская рубашка',
                'description' => 'Стильная хлопковая рубашка для офиса.',
                'price' => 2499,
                'size' => 'XL',
                'color' => 'белый',
                'category' => 'мужская',
                'image' => 'https://community.akamai.steamstatic.com/economy/image/C5ICScRs-sa8qjOIVneH3_IDEQVCaW_20WWBAJVGRfDaTPFmptnSWu2FeWZW52hDUT-khK4tAeSGaYunN_BZ9dsjFDB-OMTECRiZ9_m8-kSL8VI_Or-chMCI8c-B/360fx360f',
                'stock' => 15,
            ],
            [
                'name' => 'Мужской худи',
                'description' => 'Теплый худи с капюшоном для прохладной погоды.',
                'price' => 4299,
                'size' => 'M',
                'color' => 'серый',
                'category' => 'мужская',
                'image' => 'https://community.akamai.steamstatic.com/economy/image/C5ICScRs-sa8qjOIVneH3_IDEQVCaW_20WWBAJVGRfDaTPFmptnSWu2FbH1S6HJDTxauhbscCOCvfKGlNvBK8eVxTV18PcaRCR2U9_O7rEPdu0RmcyS4mw0A/360fx360f',
                'stock' => 22,
            ],
            [
                'name' => 'Мужские шорты',
                'description' => 'Легкие спортивные шорты для активного отдыха.',
                'price' => 1899,
                'size' => 'L',
                'color' => 'зеленый',
                'category' => 'мужская',
                'image' => 'https://community.akamai.steamstatic.com/economy/image/C5ICScRs-sa8qjOIVneH3_IDEQVCaW_20WWBAJVGRfDaTPFmptfYWeeFbGJY-3JVYge5k6otOemsa4qvJ-Z0-ox5SlhwOM6VWk_OrK66ol7P-1MbBhwZtA/360fx360f',
                'stock' => 30,
            ],

            [
                'name' => 'Женское платье',
                'description' => 'Элегантное летнее платье свободного кроя.',
                'price' => 3299,
                'size' => 'S',
                'color' => 'черное',
                'category' => 'женская',
                'image' => 'https://community.akamai.steamstatic.com/economy/image/C5ICScRs-sa8qjOIVneH3_IDEQVCaW_20WWBAJVGRfDaTPFmptnSWu2FaGNb5WlRYgakhKIiCt69NMz7MKRN_tghHlgpacCYEV7D8nkvkgBI/360fx360f',
                'stock' => 12,
            ],
            [
                'name' => 'Женские джинсы скинни',
                'description' => 'Облегающие джинсы скинни, подчеркивающие фигуру.',
                'price' => 3799,
                'size' => 'M',
                'color' => 'синий',
                'category' => 'женская',
                'image' => 'https://community.akamai.steamstatic.com/economy/image/C5ICScRs-sa8qjOIVneH3_IDEQVCaW_20WWBAJVGRfDaTPFmptfYWeeFdW9W53V5Xwy-k5AzA-C6ap2hCqJO_dskGlt7OcCQWkvM9_nx6x7YGBRFnOQ/360fx360f',
                'stock' => 20,
            ],
            [
                'name' => 'Женский кардиган',
                'description' => 'Теплый вязаный кардиган для прохладных вечеров.',
                'price' => 4599,
                'size' => 'L',
                'color' => 'черный',
                'category' => 'женская',
                'image' => 'https://community.akamai.steamstatic.com/economy/image/C5ICScRs-sa8qjOIVneH3_IDEQVCaW_20WWBAJVGRfDaTPFmptnSWu2FfGtF7W9BXA6UlKMiBeqGb5u-CvMS_Nx4Gwl4MsfFD0uao6vx6x7Y0Xy9uAU/360fx360f',
                'stock' => 14,
            ],
            [
                'name' => 'Юбка мини',
                'description' => 'Стильная юбка миди-длины для офиса и прогулок.',
                'price' => 2699,
                'size' => 'M',
                'color' => 'зеленый',
                'category' => 'женская',
                'image' => 'https://community.akamai.steamstatic.com/economy/image/C5ICScRs-sa8qjOIVneH3_IDEQVCaW_20WWBAJVGRfDaTPFmptfYWeeFbGFe-3J5XwG4n6wcAfO8YJCVOfBK-eV3SVgtaMSYDhaco67trhGMu0Rmc4clR7F7/360fx360f',
                'stock' => 16,
            ],

            [
                'name' => 'Детская футболка',
                'description' => 'Яркая хлопковая футболка для детей.',
                'price' => 899,
                'size' => 'S',
                'color' => 'красный',
                'category' => 'детская',
                'image' => 'https://community.akamai.steamstatic.com/economy/image/C5ICScRs-sa8qjOIVneH3_IDEQVCaW_20WWBAJVGRfDaTPFmptnSWu2Fa3lf4HRSYhKukpArD-a-dpy_J-x0qYpzTl8tOsKXBhiYoqvt-V7P-1O_JFDpCQ/360fx360f',
                'stock' => 35,
            ],

            [
                'name' => 'Детское платье',
                'description' => 'Красивое платье для девочек.',
                'price' => 2299,
                'size' => 'S',
                'color' => 'бежевый',
                'category' => 'детская',
                'image' => 'https://community.akamai.steamstatic.com/economy/image/C5ICScRs-sa8qjOIVneH3_IDEQVCaW_20WWBAJVGRfDaTPFmptnSWu2Fe3hS-nV5Wwykg6EgH96tZJCVNudO_tcfSwt6PsWVDRadpPjv-hGG9xp4eqjGBKFJfw/360fx360f',
                'stock' => 20,
            ],

        ];

        foreach ($clothes as $clothe) {
            Clothe::create($clothe);
        }
    }
}
