<?php

namespace Flurry\Http\Controllers;

use File;
use Flurry\Settings;
use Flurry\Http\Requests\UpdateSettingsRequest;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Settings::all();
        return view('settings', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingsRequest $request, Settings $setting)
    {
        $setting->fill($request->all());
        $setting->save();
        $this->updateConfigFile();
        return redirect('/settings')->with('success', '¡Configuración guardada!');
    }

    public function updateConfigFile()
    {
        // Traigo las configuraciones como lista
        $settings = Settings::pluck('value', 'name')->all();

        // Genero y guardo archivo de configuración
        $filePath = config_path() . '/settings.php';
        $content = '<?php return ' . var_export($settings, true) . ';';
        File::put($filePath, $content);
    }

    public function resetSettings()
    {
        $default_values = config('ourconfig.user_default_config', []);
        foreach ($default_values as $key => $value) {
            $setting = Settings::where('name', $key)->first();
            $setting->value = $value;
            $setting->save();
        }
        $this->updateConfigFile();        
        return redirect('/settings')->with('success', '¡Configuración restablecida!');
    }
}
