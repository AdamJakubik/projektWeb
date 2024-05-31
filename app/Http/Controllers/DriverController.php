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
            return back()->with('success', 'Smazání proběhlo úspěšně!');

        } catch (\Exception $e) {
            return back()->with('error', 'Smazání se nepovedlo: ' . $e->getMessage());
        }
    }
    public function edit($name, $id)
    {
        $driver = Driver::findOrFail($id);
        $data = Country::all();
        return view('edit', ['driver' => $driver, 'data' => $data]);
    }
    public function update(Request $request, $id)
    {
        try {
        $driver = Driver::findOrFail($id);
        $driver->dateOfBirth = $request->input('dateOfBirth');
        $driver->name = $request->input('name');
        $driver->driverChampion = $request->input('driverChampion');
        $driver->dnfs = $request->input('dnfs');
        $driver->wins = $request->input('wins');
        $driver->podiums = $request->input('podiums');
        $driver->country_id_country = $request->input('country');
        $country = Country::find($request->input('country'))->countryName;
        $driver->save();
        $request->session()->flash('success', "Řidič byl upraven na {$driver->name}, ze země {$country}!");
        return redirect('/driver'); 
        }
        catch (\Exception $e)  {
            $driver = Driver::findOrFail($id);
            $request->session()->flash('error', "Nastala chyba při editaci řidiče {$driver->name}! {$e->getMessage()}");
            return redirect('/driver'); 
        }
    
    }
    public function create()
    {
        $data = Country::all();
        return view('create', ['data' => $data]);
    }
    public function store(Request $request)
    {
        try {
            $driver = new Driver;
            $driver->dateOfBirth = $request->input('dateOfBirth');
            $driver->name = $request->input('name');
            $driver->country_id_country = $request->input('country');
            $driver->dnfs = $request->input('dnfs');
            $driver->wins = $request->input('wins');
            $driver->podiums = $request->input('podiums');
            $driver->driverChampion = $request->input('driverChampion');
            $request->validate([
                'country' => 'required|not_in:0',
            ]);
            $driver->save();
            $country = Country::find($request->input('country'))->countryName;
            $request->session()->flash('success', "Řidič {$driver->name} ze země {$country} byl přidán!");

            return redirect('/driver'); 
        } catch (\Exception $e) {

            $request->session()->flash('error', "Nastala chyba při přidávání řidiče! {$e->getMessage()}");
    
            return redirect('/driver');
        }
    }
}
