<?php

use Illuminate\Database\Seeder;
use Flurry\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$arrayProducts = [
    		["Helado 1/4 KG", "Pote de helado 1/4 Kg", 170, true, 3, 250, "1/4 KG", "1550861308cuarto.jpg"],
    		["Helado 1/2 KG", "Pote de helado 1/2 Kg", 285, true, 3, 500, "1/2 KG", "1550861349medio.jpg"],
    		["Helado 3/4 KG", "Pote de helado 3/4 Kg", 340, true, 4, 750, "3/4 KG", null],
    		["Helado 1 KG", "Pote de helado 1 Kg", 480, true, 5, 1000, "1 KG", "15506659281kg.jpg"],
    		["Postre Almendrado 7 P", "", 500, false, 0, null, "P.Almen7P", "1550887576almendrado.jpg"],
    		["Postre Almendrado 15 P", "", 900, false, 0, null, "P.Almen15P", null],
    		["Postre Mousse 7 P", "", 500, false, 0, null, "P.Mouss7P", "1550887542mousse.jpg"],
    		["Postre Mousse 15 P", "", 900, false, 0, null, "P.Mouss15P", null],
    		["Postre Quesito 7 P", "", 500, false, 0, null, "P.Queso7P", null],
    		["Postre Quesito 15 P", "", 900, false, 0, null, "P.Queso15P", null],
    		["Postre Torta Chica", "", 800, false, 0, null, "P.TortaCh", null],
    		["Z-Chocolate en Rama Blanco x35 Gr.", "", 30, false, 0, null, "Z.ChocRB35", null],
    		["Z-Chocolate en Rama Semi x35 Gr.", "", 30, false, 0, null, "Z.ChocRS35", null],
    		["Z-Chocolate en Rama Leche x35 Gr.", "", 30, false, 0, null, "Z.ChocRL35", null],
    		["Z-Chocolate Domino Blanco x10 Gr.", "", 10, false, 0, null, "Z.ChocDB10", null],
    		["Z-Chocolate Forma de Nuez x10 Gr.", "", 10, false, 0, null, "Z.ChocNu10", null],
    		["Z-Chocolate Chupetin Blanco x12 Gr.", "", 10, false, 0, null, "Z.ChocCB12", null],
    		["Z-Chocolate Chupetin Leche x12 Gr.", "", 10, false, 0, null, "Z.ChocCL12", null],
    		["Z-Chocolate Leon DDL Leche x10 Gr.", "", 10, false, 0, null, "Z.ChocL10", null],
    		["Z-Chocolate DDL Leche x8 Gr.", "Relleno de Dulce de Leche", 10, false, 0, null, "Z.ChocDDL8", null],
    		["Z-Chocolate Nutella Leche x10 Gr.", "", 15, false, 0, null, "Z.ChocNT10", null],
    		["Z-Chocolate Nuez DDL Leche x25 Gr.", "", 20, false, 0, null, "Z.ChocND25", null],
    		["Z-Chocolate Tableta Blanco x50 Gr.", "", 35, false, 0, null, "Z.ChocTB50", null],
    		["Z-Chocolate Tableta Leche x50 Gr.", "", 35, false, 0, null, "Z.ChocTL50", null],
    		["Z-Chocolate Tableta Semi x50 Gr.", "", 35, false, 0, null, "Z.ChocTS50", null],
    		["Z-Chocolate Tableta Blanco x95 Gr.", "", 75, false, 0, null, "Z.ChocTB95", null],
    		["Z-Chocolate Tableta Leche x95 Gr.", "", 75, false, 0, null, "Z.ChocTL95", null],
    		["Z-Chocolate Tableta Semi x95 Gr.", "", 75, false, 0, null, "Z.ChocTS95", null],
    		["Z-Chocolate Arándanos Blanco x20 Gr.", "", 20, false, 0, null, "Z.ChocAB20", null],
    		["Z-Chocolate Barra Pecan. Leche x30 Gr.", "", 20, false, 0, null, "Z.ChocBP30", null],
    		["Z-Chocolate Barra Mani Leche x20 Gr.", "", 15, false, 0, null, "Z.ChocBM20", null],
    		["Z-Chocolate Cuadrado Blanco x30 Gr.", "", 25, false, 0, null, "Z.ChocCB30", null],
    		["Z-Chocolate Cuadrado Leche x30 Gr.", "", 25, false, 0, null, "Z.ChocCL30", null],
    		["Z-Chocolate Cuadrado Semi x30 Gr.", "", 25, false, 0, null, "Z.ChocCS30", null],
    		["Z-Chocolate Tronco DDL Leche x30 Gr.", "", 30, false, 0, null, "Z.ChocTD30", null],
    		["Z-Chocolate Caja Regalo x4 Leche", "", 150, false, 0, null, "Z.ChocCx4", null],
    		["Z-Chocolate Lata Corazón x6 Leche.", "", 200, false, 0, null, "Z.ChocLCx6", null],
    		["Z-Chocolate Domino Leche x10 Gr.", "", 10, false, 0, null, "Z.ChocDL10", null],
    		["Z-Chocolate Domino Semi x10 Gr.", "", 10, false, 0, null, "Z.ChocDS10", null],
            ["Cortado", "", 55, false, 0, null, "Cortado", null],
            ["Café con Crema", "", 60, false, 0, null, "Cafe.CCr", null],
            ["Café", "", 50, false, 0, null, "Cafe", null],
            ["Capelinas", "", 5, false, 0, null, "Capelinas", null],
            ["Torta Bi-Color", "", 100, false, 0, null, "T.BiColor", null],
            ["Torta Balcarse", "", 100, false, 0, null, "T.Balcarse", null],
            ["Torta Choco-Torta", "", 100, false, 0, null, "T.Choco", null],
            ["Torta Choco-Oreo", "", 100, false, 0, null, "T.Oreo", null],
            ["Torta Bomba de Chocolate", "", 100, false, 0, null, "T.B.Choco", null],
            ["Torta Ana", "", 100, false, 0, null, "T.Ana", null],
            ["Torta Cheese-Cake", "", 100, false, 0, null, "T.Cheese", null],
            ["Torta Cramble de Manzana", "", 100, false, 0, null, "T.Cr.Manz", null],
    	];
    	foreach ($arrayProducts as $arrayProduct) {
    		$product = new Product();
	        $product->name = $arrayProduct[0];
	        $product->description = $arrayProduct[1];
	        $product->price = $arrayProduct[2];
	        $product->hasTastes = $arrayProduct[3];
	        $product->max_tastes = $arrayProduct[4];
            $product->weight = $arrayProduct[5];
            $product->alias = $arrayProduct[6];
            $product->picture = $arrayProduct[7];
	        $product->save();
    	}
    }
}
