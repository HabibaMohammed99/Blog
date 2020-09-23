<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get();
        return view('posts',compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = Validator::make($request->all(),[
            'title' => 'required|string|max:100',
            'desc' => 'required|string',
            'contetnt' => 'required|string',  
            'img' => 'required|image|mimes:png,jpeg,jpg',  

        ]);
        if($data->fails()){
            return redirect('/posts/create')
            ->withErrors($data)
            ->withInput();
        }
        if($request->hasFile('img'))
        {
            $img = $request->file('img');
            $name = uniqid().'.'.$img->getClientOriginalExtension();
            $destination = public_path('/assets/uploads');
            $img->move($destination , $name);
            $imgName = $name;
        }


        $post = new Post();
        $post->title = $request->title;
        $post->desc = $request->desc;
        $post->contetnt = $request->contetnt;
        $post->img = $imgName;

        $post->save();
        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id',$id)->first();
        return view('show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data = Validator::make($request->all(),[
            'title' => 'required|string|max:100',
            'desc' => 'required|string',
            'contetnt' => 'required|string'   

        ]);
        if($data->fails()){
            return redirect('/posts/edit/'.$id)
            ->withErrors($data)
            ->withInput();
        }
        $post = Post::findOrFail($id);
        $old_name = $post->img;
        if($request->hasFile('img'))
        {
            Storage::disk('uploads')->delete($old_name);

            $img = $request->file('img');
            $new_name = uniqid().'.'.$img->getClientOriginalExtension();
            $destination = public_path('/assets/uploads');
            $img->move($destination , $new_name);
            $imgName = $new_name;
        }
        else{
            $imgName = $old_name;
        }


        $post->title =$request->title;
        $post->desc =$request->desc;
        $post->contetnt =$request->contetnt;
        $post->img = $imgName;

        $post->save();

        return redirect('/posts/show/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $old_name = $post->img;
        Storage::disk('uploads')->delete($old_name);

        $post->delete();
        return redirect('posts');
    }
}
