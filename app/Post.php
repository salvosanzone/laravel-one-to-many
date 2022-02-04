<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// per usare la funzione generateSlug devo caricare l'Str
use Illuminate\Support\Str;

class Post extends Model
{


    public function category(){

        // alll'oggetto post appartine una sola category
        return $this->belongsTo('App\Category');
    }



    public static function generateSlug($title){
        // genero lo slug
        $slug = Str::slug($title);

        // $slug_base è lo slug originale
        $slug_base = $slug;

        // verifico tramite la query se è presente nel db lo slug $slug
        // creo la query con Eloquent
        $post_presente = Post::where('slug', $slug)->first();


        // se 'slug' è uguale a $slug allora parte il while
        $c = 1;

        // fin tanto che esiste (cioè se quello che c'è dentro le parentesi del while è vera, cioè se 'slug' è uguale a $slug) $post_presente, il ciclo continua a girare
        while($post_presente){
            $slug = $slug_base . '-' . $c;
            $c++;
            $post_presente = Post::where('slug', $slug)->first();
        }
        
        // se 'slug' non è uguale a $slug allora la funzione mi restituisce $slug
        return $slug;
    }
}
