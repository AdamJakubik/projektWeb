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
    public function create()
    {
        $data = Country::all();
        $date = date("Y-m-d");
        return view('create', ['data' => $data, 'date' => $date]);
    }
    public function store(Request $request)
    {
        try {
            $car = new Car;
            $car->made = $request->input('made');
            $car->name = $request->input('name');
            $car->Country_id = $request->input('Country_id');
            $request->validate([
                'Country_id' => 'required|not_in:0',
            ]);
            $car->save();
    
            $country = country::find($request->input('Country_id'))->name;
        
            // Flash zpráva informuje uživatele o úspěšném přidání auta.
            $request->session()->flash('success', "Auto {$car->name} od výrobce {$country} bylo přidáno!");

            return redirect('/car'); 
        } catch (\Exception $e) {
            
            // Flash zpráva informuje uživatele o chybě při přidávání auta.
            $request->session()->flash('error', "Nastala chyba při přidávání auta! {$e->getMessage()}");
    
            return back(); 
        }
    }
    public function multiCreate(Request $request)
    {
        $value = $request->query('value');
        $count = explode(',', $value);
        $number = $count[0];
        $data = Country::all();
        $date = date("Y-m-d");
        return view('multi-create', ['data' => $data, 'date' => $date, 'number' => $number]);
    }
    

    public function multiStore(Request $request)
    {
        try {
            $carsData = $request->input('cars'); 
    
            foreach ($carsData as $carData) {
                $car = new Car;
                $car->made = $carData['made'];
                $car->name = $carData['name'];
                $car->Country_id = $carData['Country_id'];
                $car->save();
            }
    
            $request->session()->flash('success', "Auta byla úspěšně přidána!");
    
            return redirect('/car');
        } catch (\Exception $e) {
    
            $request->session()->flash('error', "Nastala chyba při přidávání aut! {$e->getMessage()}");
            return back();
        }
    }
    
    /**
     * Zobrazí formulář pro úpravu auta podle daného ID, které vybereme v tabulce.
     *
     * @param  $name Název auta.
     * @param  $id ID auta.
     * @return  Vrací view 'edit' s daty auta, daty zemí a aktuálním datem, aby nešlo ve formuláři vybrat datum v budoucnosti. V proměnné $car jsou data z řádku tabulky podle id na které jsme klikli.
     */
    public function edit($name, $id)
    {
        $car = Car::findOrFail($id);
        $data = Country::all();
        $date = date("Y-m-d");
        return view('edit', ['car' => $car, 'data' => $data, 'date' => $date]);
    }

    /**
     * Aktualizuje auto v databázi podle daného ID.
     *
     * @param   $request vrací data z formuláře pro úpravu auta.
     * @param   $id ID auta.
     * $car->edit_time = time(); a $car->save(); uloží do sloupce edit_time přesný čas kdy došlo k úpravě.
     * @return  Vrací uživatele na stránku /car s flash zprávou o úspěchu nebo chybě.
     */

public function multiEdit (Request $request)
{
   
    $ids = explode(',', $request->query('id'));
    $cars = Car::findMany($ids);
    $data = Country::all();
    $date = date("Y-m-d");
    return view('multi-edit', ['cars' => $cars, 'data' => $data, 'date' => $date]);
}


public function saveMultiEdit (Request $request)
{
    try{
    $ids = $request->input('ids');
    $cars = Car::findMany($ids);
    foreach ($cars as $car) {
        $car->made = $request->input('made')[$car->id];
        $car->name = $request->input('name')[$car->id];
        $car->Country_id = $request->input('Country_id')[$car->id];
        $car->edit_time = time(); 
        $car->save();
    }
    
    $request->session()->flash('success', "Auta byla úspěšně editována");
    return redirect('/car'); 
    }
    catch (\Exception $e)  {
        // Flash zpráva informuje uživatele o chybě při úpravě auta.
        $request->session()->flash('error', "Nastala chyba při editaci aut! {$e->getMessage()}");
        return redirect('/car'); 
    
    
}
}
 


    public function update(Request $request, $id)
    {
        try {
        $car = Car::findOrFail($id);
        $car->made = $request->input('made');
        $car->name = $request->input('name');
        $car->Country_id = $request->input('Country_id');
        $country = Country::find($request->input('Country_id'))->name;
        $car->edit_time = time(); 
        $car->save();
        // Flash zpráva informuje uživatele o úspěšné úpravě auta.
        $request->session()->flash('success', "Auto bylo editováno na {$car->name}, vyrobeno {$car->made} ze země {$country}!");
        return redirect('/car'); 
        }
        catch (\Exception $e)  {
            $car = Car::findOrFail($id);
            // Flash zpráva informuje uživatele o chybě při úpravě auta.
            $request->session()->flash('error', "Nastala chyba při editaci auta {$car->name}! {$e->getMessage()}");
            return redirect('/car'); 
        }
    
    }
}