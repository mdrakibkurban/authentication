<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts = Post::latest()->get();
         return send_success('sucees',$posts);
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(),[
                'title' => 'required',
                'description' => 'required'
          ]);

          if($validator->fails()){
              return send_error('validation errors', $validator->errors(), 422);
          }

          $posts = new Post();
          $posts->title = $request->title;
          $posts->description =$request->description;
          $posts->save();

          $data = [
               'post_title' => $request->title,
               'post_description' => $request->description,
          ];
          return send_success('Post create Success', $data );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
          if($post){
            return send_success('Success', $post );
          }else{
              return send_error('Post not found');
          }
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
     $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required'
      ]);

      if($validator->fails()){
          return send_error('validation errors', $validator->errors(), 422);
      }

      $posts = Post::find($id);

      $post = Post::find($id);
      if($post){
       $posts->title = $request->title;
      $posts->description =$request->description;
      $posts->save();

      $data = [
           'post_title' => $request->title,
           'post_description' => $request->description,
      ];
       return send_success('Post Update Success', $data );

      }else{
          return send_error('Post not found');
      }

      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post){
            $post->delete();
            return send_success('Success', []);
        }else{
            return send_error('Post not found');
        }
    }
}
