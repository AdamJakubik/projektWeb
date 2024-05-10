<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Country;
use Config;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    public function driver()
    {
        $paginate = Config::get('pagination.pagination');
        $data = Driver::join('country', 'driver.country_id_country', '=', 'country.id_country')->select('driver.*', 'country.countryName as country_name')->orderBy('driver.id_driver')->paginate($paginate);
        return view('driver', ['data' => $data]);
    }
    
    public function delete($id_driver)
    {
        try {
            $driver = Driver::find($id_driver);
            $driver->delete();   

            // Flash zpráva informuje uživatele o úspěšném smazání auta.
            return back()->with('success', 'Smazání proběhlo úspěšně!');

        } catch (\Exception $e) {
            // Flash zpráva informuje uživatele o chybě při mazání auta.
            return back()->with('error', 'Smazání se nepovedlo: ' . $e->getMessage());
        }
    }
}
