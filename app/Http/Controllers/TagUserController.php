<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TagUserController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tag $tag)
    {
        $users = $tag->posts()->with('user')
            ->get()
            ->pluck('user')
            ->unique('id')
            ->values();
        return $this->showAll($users);
    }
}
