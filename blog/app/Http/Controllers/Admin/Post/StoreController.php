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
        try {
            $data = $request->validated();
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);
            $data['preview_image'] = $request->file('preview_image')->store('images');
            $data['main_image'] = $request->file('main_image')->store('images');
            $post = Post::firstOrCreate($data);
            $post->tags()->attach($tagIds);
            return redirect(route("admin.post.index"));
        } catch (\Exception $exeption) {
            abort(404);
        }
    }
}
