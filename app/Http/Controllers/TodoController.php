<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return view("todo.index");
    }

    public function edit()
    {
        return view("todo.edit");
    }
    public function create()
    {
        return view("todo.create");
    }
}
