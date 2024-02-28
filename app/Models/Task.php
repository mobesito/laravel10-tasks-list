<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    //esta variable sirve para indicar cuales son los campos del modelo
    //que podran ser accessibles para operar...
    //es necesario añadirlo por motivos de seguridad, sino Laravel indicara 
    //que hay error...
    protected $fillable = ['title', 'description', 'long_description'];
    //el siguiente arreglo es similar, pero indica cuales son los que no deben
    //ser accedidos y el resto si. Es mas peligroso
    /* protected $guarded = ['password']; */


    //-------------------------------------------------
    //-------------------------------------------------
    //CON ESTA FUNCION DEFINIMOS POR CUAL KEY DEBERIA RESOLVER EL MODELO
    //POR DEFECTO ASUME QUE ES EL ID (PRIMARY KEY)
    /* public function getRouteKeyName(){
        return 'slug';
    } */

    public function toggleTask(){
        $this->completed = !$this->completed;
        $this->save();
    }
}
