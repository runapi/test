<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;

class UserTagController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $tags = $user->posts()->with('tags')
            ->get()
            ->pluck('tags')
            ->unique('id')
            ->values();

        return $this->showAll($tags);
    }

}
