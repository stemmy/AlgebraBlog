<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CommentRequest;

use App\Models\Post;

use App\Models\Comment;

use Sentinel;

class IndexController extends Controller
{
  /**
   * Set middleware to quard controller.
   *
   * @return void
   */
    public function __construct()
    {
        //$this->middleware('sentinel.guest');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::orderBy('created_at', 'DESC')->paginate(12);

      return view('index')->with('posts', $posts);
    }

    public function show($slug){

      $post = Post::where('slug', $slug)->first();

      return view('post.show')->with('post', $post);

    }

    public function storeComment(CommentRequest $request){

    // ZADAĆA POHRANITI KOMENTAR
    $user_id = Sentinel::getUser()->id;

    $data = array(

      'user_id' =>  $user_id,
      'post_id' =>  $request->get('post_id'),
      'content' =>  $request->get('content')

    );

    $comment = new Comment();

    $comment->saveComment($data);

    $message = session()->flash('success', 'You have successfully added new comment.');

    return redirect()->back()->withFlashMessage($message);

    }
}