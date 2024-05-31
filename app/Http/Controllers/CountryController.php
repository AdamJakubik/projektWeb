<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Config;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function country() {
    
        $data = Country::all();
        $paginate = Config::get('pagination.pagination');
        $data = Country::paginate($paginate);
        return view('country', ['data' => $data]);
    }
    public function delete($id)
    {
        $country = Country::find($id);
        $country->delete();
        return redirect('/country')->with('success', 'Země úspěšně smazána!');
    }
    public function create()
    {
        $country = Country::all();
        return view('country-create', ['country' => $country]);
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
        ]);
    
        try {
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('obrazky'), $imageName);  
    
            $country = new Country;
            $country->countryName = $request->input('name');
            $country->image = $imageName; 
            $country->save();
    
            return redirect('/country')
                ->with('success', "Země '{$country->countryName}' s obrázkem '/public/obrazky/{$country->image}' byla vytvořena")
                ->with('image', $imageName);
        } catch (\Exception $e) {
            return redirect('/country')
                ->with('error', "Nastala chyba při vytváření země: {$e->getMessage()}");
        }
    }
    
}