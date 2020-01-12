<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    
    /**
     * Lista todos as tags
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = Tag::orderBy('name', 'ASC')->get()->all();
        return response()->json(['data'=> $tags]); 

    }

    /**
     * Salva uma nova tag no banco de dados
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validação do parâmetros
        $this->validate($request, [
            'tags'=>'required|array|min:1',
            'movie_id'=>'|exists:movies,id'
        ]);

        $data = $request->all();

        $movieId = $data['movie_id']; //id do filme
        $tags = $data['tags']; //array de tags (string)

        $responseTags = [];

        foreach ($tags as $tag) {

             //cria uma nova tag caso não exista como o mesmo nome e id
            $t = Tag::updateOrCreate([
                'name' => $tag,
                'movie_id' => $movieId,
            ]);

            $responseTags[] = $t;

        }
            
        return response()->json(['data'=> $responseTags]);

    }

}
