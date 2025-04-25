<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Tambahkan ini untuk import User model

class UserController extends Controller
{
    public function index()
    {
        // $users = User::where('id', '!=', 1)
        //           ->orderBy('name')
        //           ->paginate(10);
                  
        // return view('user.index', compact('users'));
        $search = request('search');
        if ($search) {
            $users = User::where(function($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%');
                    })
                    ->where('id', '!=', 1)
                    ->orderBy('name')
                    ->paginate(20)
                    ->withQueryString();
        } else {
            $users = User::where('id', '!=', 1)
                    ->orderBy('name')
                    ->paginate(20);
        }
        return view('user.index', compact('users'));
    }
}