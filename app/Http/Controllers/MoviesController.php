<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Lista todos os filmes
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = $request->all();

        $order = $data['order'] == 'DESC' ? 'DESC' : 'ASC';
    
        $movies = Movie::orderBy('name', $order)->get()->all();
        return response()->json(['data'=> $movies]); 

    }

    /**
     * Salva um novo filme no banco e salva o arquivo do filme no storage public
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //validação do parâmetros
        $this->validate($request, [
            'name'=>'required',
            'file'=>'required|max:5000' //@todo a validação de padrão para videos não funcionou (|mimes:avi,wmv), pesquisar uma alternativa 
        ]);

        //nome do filme
        $name = $request->post('name'); 

        //arquivo de video
        $file = $request->file('file');

        $fileName = $file->getClientOriginalName(); //nome original do arquivo de video
        $fileSize = $file->getClientSize(); //tamanho do arquivo de video

        //cria um novo filme
        $movie = Movie::create([
            'name' => $name,
            'file' => $fileName,
            'file_size' => $fileSize
        ]);

        //salva o arquivo com o nome original no storage public
        $file->storeAs(
            'public', $fileName
        );

        return response()->json(['data'=> $movie]);
        
    }

    /**
     * Mostra um filme específico.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        
        $tags = Tag::where('movie_id', 1)->get()->all();

        $movie->tags = $tags;

        return response()->json(['data'=> $movie]);
    }

    
    /**
     * Atualiza um filme espcífico
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {

        //validação dos parâmetros
        $this->validate($request, [
            'name'=>'required'
        ]);

        $data = $request->all();

        //nome do filme
        $name = $data['name']; 

        //tags que serão adicionadas
        $addTags = $data['add_tags'] ?? [];

        //tags que serão removidas
        $removeTags = $data['remove_tags'] ?? [];

        //atualiza nome do filme
        $movie->update([
            'name' => $name
        ]);

        $movieId = $movie->id;

        //insere uma nova tag caso não exista
        if(isset($addTags)) {

            foreach ($addTags as $tag) {

                $t = Tag::updateOrCreate([
                    'movie_id' => $movieId,
                    'name'=> $tag
                ]);
 
            }
            
        }

        //remove as tags pelo nome
        if(isset($removeTags)) {

            foreach ($removeTags as $tag) {

                $t = Tag::where('name', $tag)->delete();
 
            }
            
        }


        return response()->json(['data'=> $movie]);

    }

    /**
     * Remove um filme específico
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        
        $movie->delete();

        return response()->json(['data'=> $movie]);
        
    }
}
