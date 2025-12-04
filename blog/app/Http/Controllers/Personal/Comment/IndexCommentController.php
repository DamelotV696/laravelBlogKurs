<?php

namespace App\Http\Controllers\Personal\Comment;

use App\Http\Controllers\Controller;

class IndexCommentController extends Controller
{
    public function __invoke()
    {
        return view('personal.comment.index');
    }
}
