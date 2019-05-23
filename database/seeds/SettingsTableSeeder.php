<?php

use Illuminate\Database\Seeder;
use Flurry\Settings;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = new Settings();
        $settings->name = 'refresh_time';
        $settings->alias = 'Tiempo de refresco';
        $settings->description = 'Tiempo en segundos que tarda en refrescarse '
            .'automáticamente la página de pedidos pendientes. Ingrese 0 para '
            .'desactivar esta funcionalidad.';
        $settings->value = '60';
        $settings->save();

        $settings = new Settings();
        $settings->name = 'days_back_cancelled';
        $settings->alias = 'Días de pedidos cancelados';
        $settings->description = 'Cantidad de días que los pedidos cancelados '
            .'se muestran en el listado de pedidos.';
        $settings->value = '3';
        $settings->save();

        $settings = new Settings();
        $settings->name = 'acceptable_delay';
        $settings->alias = 'Demora admisible';
        $settings->description = 'Pasado este tiempo en minutos, los pedidos '
            .'pendientes se resaltarán en color naranja.';
        $settings->value = '40';
        $settings->save();

        $settings = new Settings();
        $settings->name = 'orders_per_page';
        $settings->alias = 'Pedidos por página';
        $settings->description = 'Cantidad máxima de pedidos que se mostrará en '
            .'cada listado de la pantalla Pedidos. Luego de esta cantidad, se '
            .'separan en nuevas páginas los pedidos restantes.';
        $settings->value = '8';
        $settings->save();

        $settings = new Settings();
        $settings->name = 'pending_orders_alerts';
        $settings->alias = 'Alertas en pedidos pendientes';
        $settings->description = 'Si se ajusta en "No", no se mostrarán '
            .'mensajes de alerta al asignar cadetes y enviar pedidos.';
        $settings->value = '1';
        $settings->save();
    }
}
