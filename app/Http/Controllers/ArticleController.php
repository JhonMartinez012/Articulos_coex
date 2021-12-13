<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* SELECT name
            FROM users
            JOIN articles ON articles.user_id=users.id where articles.user_id=users.id
         */
        //$user_id=DB::table('users')->select('id')->first();
        //return $user_id;
        $user_logeado = auth()->user();

        $articles = Article::with('user')->get();
        /* $articles=DB::table('articles')
        ->join('users','users.id','user_id')->get(); */
        return ['articulos' => $articles, 'user_logeado' => $user_logeado];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //Storage::put('photos', $request->file('file'));
        //return Storage::put('public\photos', $request->file('img_article'));  

        //$article = Article::create($request->all());

        if ($request->hasFile('img_article')) {
            $url_img = Storage::disk('public')->put('photos', $request->file('img_article'));
            $article = Article::create([
                'serial' => $request->input('serial'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'img_article' => $url_img,
                'user_id' => $request->input('user_id')
            ]);
        }
        /* 
        if ($request->file('img_article')) {
           // $article['img_article'] = $request->file('img_article')->store('img_articles');
            //$article['img_article'] = Storage::put('/archivo.jpg',$request->img_article);  
            $article = Storage::put('public/photos',$request->file('img_article'));  
        }        
        $article = new Article();
        $article->create($request->all()); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
        return $article;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
        
        if ($request->hasFile('img_article')) {
            
            $url_img = Storage::disk('public')->put('photos', $request->file('img_article'));
            $article->update(['img_article' => $url_img]);
            
        }
        //$article->update($request->all());
        $article->update([
            'serial' => $request->input('serial'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            
            'user_id' => $request->input('user_id')
        ]);
        return "guardado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //Eliminar un articulo
        $article->delete();
    }
}
