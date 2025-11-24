<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);

            $data['preview_image'] = $data['preview_image']->store('images', 'public');
            $data['main_image'] = $data['main_image']->store('images', 'public');


            $post = Post::firstOrCreate($data);
            $post->tags()->attach($tagIds);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            dd($exception->getMessage(), $exception->getTraceAsString());
            // abort(404);
        }
    }
    public function update($data, $post, $request)
    {
        try {
            DB::beginTransaction();
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);

            $data['preview_image'] = $request->file('preview_image')
                ? $request->file('preview_image')->store('images', 'public')
                : $post->preview_image;

            $data['main_image'] = $request->file('main_image')
                ? $request->file('main_image')->store('images', 'public')
                : $post->main_image;

            $post->update($data);
            $post->tags()->sync($tagIds);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            abort(500);
        }

        return $post;
    }
}
