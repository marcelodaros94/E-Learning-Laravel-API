<?php

namespace App\Http\Controllers;

use App\Models\DetalleProgreso;
use App\Models\Video;
use Illuminate\Http\Request;

class DetalleProgresoController extends Controller
{
    public function updateProgress(Request $request){
        $id=$request->get('id');
        $progreso=DetalleProgreso::find($id);
        $progreso->porcentaje=100;
        $progreso->update();
    }
}
