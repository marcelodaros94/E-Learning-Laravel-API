<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\DetalleProgreso;
use App\Models\Progreso;
use App\Models\Video;
use Illuminate\Http\Request;

class ProgresoController extends Controller
{
    public function takeCourse(Request $request){
        $course_id=$request->get('id');
        $progreso=new Progreso();
        $progreso->curso_id=$course_id;
        $progreso->user_id=auth()->user()->id;
        $progreso->save();

        $videos=Curso::find($course_id)->videos;
        
        $new_progress_rows=[];

        foreach($videos as $video){ 
            $new_progress_rows[] = [
            'video_id'  => $video->id,
            'progreso_id' => $progreso->id,
            ];
        }
        
        DetalleProgreso::insert($new_progress_rows);

        return response()->json([
            'success' => true,
            'message' => '¡Bienvenido al curso!'
        ], 201);
    }
}
