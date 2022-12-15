<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function createComment(Request $request){
        $comment = new Comment();
        $comment->content = $request['content'];
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request['post_id'];
        $comment->parent_com_id = $request['parent_com_id'] ?: 0;
        return $comment->save();
    }
    public function editComment(){

    }

}
