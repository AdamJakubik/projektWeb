<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    protected $table = 'driver'; 
    protected $primaryKey = 'id_driver';
    protected $fillable = ['name', 'dateOfBirth','driverChampion', 'wins', 'podiums','dnfs','updated_at','deleted_at','created_at']; 

    use SoftDeletes;

}