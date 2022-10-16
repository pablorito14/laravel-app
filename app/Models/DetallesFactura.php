<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesFactura extends Model
{
    use HasFactory;

    protected $table = 'detalles_factura';

    public function factura(){
        return $this->belongsTo(Factura::class,'factura_id');
    }

    public function servicio(){
        return $this->belongsTo(Servicio::class,'servicio_id');
    }
}
