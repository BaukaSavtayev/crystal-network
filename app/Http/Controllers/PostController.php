<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __invoke(Request $request)
    {
        \Log::info('Post view');
        //$posts = Post::with('author', 'comments')->get();
        $posts = DB::table('posts')
            ->select(
                'posts.id as post_id',
                'comments.id as comment_id',
                'author_id',
                'comm_users.name as author_name',
                'post_users.name as post_author_name',
                'posts.content as postText',
                'comm_users.id as comment_author',
                'comments.content as commentText'
            )
            ->leftJoin('comments','posts.id', '=', 'comments.post_id')
            ->leftJoin('users as comm_users', function($join){
                $join->on('comm_users.id','=','comments.user_id');//->orOn('users.id','=','posts.author_id');
            })
            ->leftJoin('users as post_users', function($join){
                $join->on('post_users.id','=','posts.author_id');//->orOn('users.id','=','posts.author_id');
            })
            ->get();
        $allPosts = [];
        foreach ($posts as $post){
            $allPosts["$post->post_id"]['content'] = $post->postText;
            $allPosts["$post->post_id"]['author_name'] = $post->post_author_name;
            $allPosts["$post->post_id"]['author_id'] = $post->author_id;
            if ($post->comment_id){
                $allPosts["$post->post_id"]['comments']["$post->comment_id"]['content'] = $post->commentText;
                $allPosts["$post->post_id"]['comments']["$post->comment_id"]['author'] = $post->author_name;
                $allPosts["$post->post_id"]['comments']["$post->comment_id"]['author_id'] = $post->comment_author;
            }
        }
//        foreach ($posts as $post){
//            foreach ($post->comments as $comment){
//                $comment->author_name = User::find($comment->user_id);
//            }
//        }
        //$posts = User::with('posts')->get();
        return $allPosts;
    }
    public function create(Request $request){
        $post = new Post();
        $post->author_id = Auth::user()->id;
        $post->content = $request['content'];
        \Log::info('Post created');
        return $post->save();
    }
}
