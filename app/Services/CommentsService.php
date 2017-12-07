<?php

namespace App\Services;

use Illuminate\View\Factory;

use Sentinel;

use App\Models\Post;

class CommentsService
{

	protected $view;

	public function __construct(Factory $view){

		$this->view = $view;

	}

	public function pendingComments()
	{

		$posts = Post::where('user_id', Sentinel::getUser()->id)->get();

		// $comments_num = Post::join('comments', 'posts.id', '=', 'comments.post_id')
        //    ->where([['posts.user_id', Sentinel::getUser()->id], ['status', 0]])
        //    ->count('comments.id');

        $comments_num = 0;

		foreach ($posts as $post) {
			//$comments_num += Comment::where('post_id', $post->id)->count();
			$comments_num += $post->pendingComments->count();
		}

		return $comments_num;

	}

}
