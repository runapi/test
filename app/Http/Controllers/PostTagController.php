<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $tags = $post->tags;
        return $this->showAll($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Post $post
     * @param Tag $tag
     * @return void
     */
    public function update(Request $request, Post $post, Tag $tag)
    {
        $post->tags()->syncWithoutDetaching([$tag->id]);
        return $this->showAll($post->tags);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Tag $tag)
    {
        if (!$post->tags()->find($tag->id)) {
            return $this->errorResponse(
                'The specified tag is not a tag of this post', 404);
        }

        $post->tags()->detach($tag->id);
        return $this->showAll($post->tags);
    }
}
