<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Video;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $curso=new Curso();
        $curso->name='Psicología del Pro Wrestling'; 
        $curso->description='Siendo la lucha libre una narrativa más que una simple secuencia; llegamos a algo llamado la suspensión de la incredulidad'; 
        $curso->img='rock_mankind.webp'; 
        $curso->price='20.00'; 
        $curso->video_cant='3';
        $curso->save();

        $video=new Video();
        $video->name='Introducción al curso';
        $video->description='Presentación de los temas a tratar a lo largo del curso';
        $video->video='intro.mp4';
        $video->curso_id=$curso->id;
        $video->save();

        $video2=new Video();
        $video2->name='Lenguaje corporal';
        $video2->description='El principal instrumento para contar la historia a través de un combate';
        $video2->video='body.mp4';
        $video2->curso_id=$curso->id;
        $video2->save();
        
        $video3=new Video();
        $video3->name='Generación de emociones';
        $video3->description='Ejemplificando cómo el desarrollo del personaje permite conectar';
        $video3->video='emociones.mp4';
        $video3->curso_id=$curso->id;
        $video3->save();

    }
}
