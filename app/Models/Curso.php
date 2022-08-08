<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    public function videos(){
        return $this->hasMany('App\Models\Video');
    }

    public function videosWithProgress(){
        return $this->hasMany('App\Models\Video')
        ->join('detalle_progresos', 'detalle_progresos.video_id', '=', 'videos.id')
        ->join('progresos', 'detalle_progresos.progreso_id', '=', 'progresos.id')
        ->select(\DB::raw("detalle_progresos.id as id, name, description, video, porcentaje"))
        ->where('progresos.user_id',auth()->user()->id);
    }
}
