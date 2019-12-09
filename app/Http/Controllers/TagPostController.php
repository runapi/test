<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TagPostController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tag $tag)
    {
        $posts = $tag->posts;
        return $this->showAll($posts);
    }
}
