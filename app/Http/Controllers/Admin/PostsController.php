<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
    	try{

    		$posts = Post::all();
    	return view('admin.posts.index',compact('posts'));
    	}catch(\Exception $e){
    	\Log::error($e->getMessage());
    	return redirect()->back()->with('error',"Ocurrio un error inesperado, Favor intentar nuevamente");
    	}
    }

//    public function create(){
//
//        try{
//            $categories = Category::all(['id','name']);
//            $tags = Tag::all();
//            return view('admin.posts.create',compact('categories','tags'));
//        }catch (\Exception $e){
//            \Log::error($e->getMessage());
//            return redirect()->back()->with('error','Ocurrio un error inesperado');
//        }
//    }

    public function store(Request $request){
        try{
            $this->validate($request,[
                'title' => 'required'
            ]);

            $post = new Post();
                $post->title =  $request->get('title');
                $post->url= Str::slug($request->get('title'));
                $post->save();
             \Log::info('PostsController::store | save post successful',['data' => $post]);
            return redirect()->route('admin.posts.edit',$post);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','Ocurrio un error inesperado');
        }
    }

    public function update(Post $post,Request $request){
        try{
            //validation
            $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'category_id' => 'required',
                'excerpt' => 'required'
            ]);
            $post->title = $request->get('title');
            $post->url = Str::slug($request->get('title'));
            $post->body = $request->get('body');
            $post->category_id = $request->get('category_id');
            $post->published_at = Carbon::parse($request->get('published_at'));
            $post->excerpt = $request->get('excerpt');
            $post->save();
            $post->tags()->attach($request->get('tags'));

            return redirect()->route('admin.posts.edit',$post)->with('success','Post Guardado Exitosamente');
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','Ocurrio un error inesperado');
        }
    }

    public function edit(Post $post){
        try{
            if (!isset($post))
                return redirect()->back()->with('error',"No se encontro el post buscado");

            $categories = Category::all(['id','name']);
            $tags = Tag::all();

            return view('admin.posts.edit',compact('post','tags','categories'));
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','Ocurrio un error inesperado');
        }
    }

    public function destroy(Post $post){
        try{

            if (!isset($post))
                return redirect()->back()->with('error','No se encontro el post');

            $post->tags()->delete();
            $post->delete();

            return redirect()->back()->with('success',"Post Eliminado");
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','Ocurrio un error inesperado');
        }
    }
}

