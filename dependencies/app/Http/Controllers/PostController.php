<?php

namespace App\Http\Controllers;

use App\Authors;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request){
        $authors = file_get_contents(base_path().'/../assets/authors.json');
        $authors = json_decode($authors);
        $posts = file_get_contents(base_path().'/../assets/posts.json');
        $posts = json_decode($posts);


        //post with paginate
        $pageSize = $request->input('pageSize');

        if(!$pageSize) {
            $pageSize = 8;
        }
        $page = $request->input('page') ?: (Paginator::resolveCurrentPage() ?: 1);
        $posts = $posts instanceof Collection ? $posts : Collection::make($posts);
        $posts = new LengthAwarePaginator($posts->forPage($page, $pageSize), $posts->count(), $pageSize, $page, []);


        return view('index', ['posts'=>$posts, 'authors'=>$authors]);
    }

    /*public function index(){
        $authors_file = file_get_contents(base_path().'/../assets/authors.json');
        $authors = json_decode($authors_file);
        $posts_file = file_get_contents(base_path().'/../assets/posts.json');
        $posts = collect(json_decode($posts_file, true));
        $posts = $posts->paginate(8);
       // return view('index', ['posts'=>$posts, 'authors'=>$authors]);
        return $posts;
    }*/
}
