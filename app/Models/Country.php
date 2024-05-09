<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    protected $table = 'country'; 
    protected $primaryKey = 'id_country';
    protected $fillable = ['Countryname']; 
    use SoftDeletes;

}