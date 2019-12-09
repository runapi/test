<?php

namespace App\Http\Controllers;

use App\Post;
use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserPostController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $posts = $user->posts;
        return $this->showAll($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, User $user)
    {
        $rules = [
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ];

        $this->validate($request, $rules);

        $post = $user->posts()->create($request->all());
        return $this->showOne($post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user, Post $post)
    {
        $rules = [
            'title' => 'min:3',
            'description' => 'min:10'
        ];

        $this->validate($request, $rules);

        $post = $post->fill($request->all());

        if ($post->user_id != $user->id) {
            throw new HttpException(422,
                'The specified is not the actual user of the post');
        }

        if ($post->isClean()) {
            return $this->errorResponse('You need to specify a diffrent value to update', 422);
        }

        $post->save();
        return $this->showOne($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param Post $post
     * @return void
     */
    public function destroy(User $user, Post $post)
    {
        if ($post->user_id != $user->id) {
            throw new HttpException(422,
                'The specified is not the actual user of the post');
        }

        $post->delete();
        return $this->showOne($post);
    }
}
