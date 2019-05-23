<?php

use Illuminate\Database\Seeder;
use Flurry\Taste;

class TasteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$tastes = [
    		["Chocolate", null, "93704E", true],
    		["Limón", null, "FFFFE0", null],
    		["Frutilla", null, "FF69B4", null],
    		["Menta Granizada", null, "3DB588", true],
    		["Banana Split", null, "FCE190", null],
            ["Vainilla", null, "F4E5AC", null],
            ["Americana", null, "FBFCF7", null],
    		["Super Sambayón", null, "E3EA7E", null],
            ['Ananá', null, 'FFF6E0', null],
            ['Naranja', null, 'FFB80C', null],
            ['Melón', null, 'FFF6E2', null],
            ['Frambuesa', null, 'FF5EAB', null],
            ['Pomelo', null, 'F4AC90', null],
            ['Durazno', null, 'F4C242', null],
            ['Mousse de Limón', null, 'F7EDA3', null],
            ['Mousse de Banana', null, 'FFEB59', null],
            ['Tramontana', null, 'FFFAD8', null],
            ['Quinotos al Whisky', null, 'FFFBE5', null],
            ['Sambayón al Málaga', null, 'E3EA7E', null],
            ['Granizado de Chocolate', null, 'FFFDF4', null],
            ['Amarena', null, '871959', true],
            ['Mascarpone', null, 'FFDBF0', null],
            ['Tiramisú', null, 'FFFDE0', null],
            ['Almendrado', null, 'FFEDD8', null],
            ['Cerezas a la Panna', null, 'FFCCEB', null],
            ['Crema Rusa', null, 'FCE7B0', null],
            ['Frutilla a la Panna', null, 'FFA3F5', null],
            ['Almendras Chocolatadas', null, 'BA7A50', true],
            ['Marrón Glacé', null, 'E8B99B', null],
            ['Chocolate Due', null, '75380F', true],
            ['Chocolate Blanco', null, 'FCF3ED', null],
            ['Chocolate Amargo', null, '4F280F', true],
            ['Chocolate con Almendras', null, '70330b', true],
            ['Chocolate al Rhum con Pasas', null, 'EEC39D', true],
            ['Chocolate Suizo', null, 'AA704F', true],
            ['Mousse de Chocolate', null, '8E593C', true],
            ['Dulce de Leche', null, 'A57E4F', true],
            ['Dulce de Leche Granizado', null, 'A57E4F', true],
            ['Dulce de Leche con Almendras', null, 'A57E4F', true],
            ['Dulce de Leche con Nuez', null, 'CC9560', true],
            ['Super Dulce de Leche', null, 'C68737', true],
            ['Maracuyá', null, 'F6DE72', null],
            ['Nutella', null, '6E4229', true],
            ['Flan', null, 'F4BD88', null],
            ['Café', null, '976D4E', true],
            ['Pistaccio', null, 'E8E6B4', null],
            ['Chocolate al Rhum con Nueces', null, 'C68F79', null],
            ['Sandia', null, 'DD8289', null],
            ['Kinder', null, 'EEA990', null],
    	];

    	foreach ($tastes as $arrayTaste) {
    		$taste = new Taste();
	        $taste->name = $arrayTaste[0];
	        $taste->description = $arrayTaste[1];
	        $taste->color = $arrayTaste[2];
            $taste->white_text = $arrayTaste[3];
	        $taste->save();
    	}
    }
}
