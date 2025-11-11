<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        dd($data);
        $data['preview_image'] = $request->file('preview_image')->store('images');
        $data['main_image'] = $request->file('main_image')->store('images');
        Post::firstOrCreate($data);
        return redirect(route("admin.post.index"));
    }
}
