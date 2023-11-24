<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = [
            [
                'name' => 'Aula Firdaus',
                'phone' => '08229330221',
                'instagram' => 'aulafirdaus_'
            ],
            [
                'name' => 'Kholis',
                'phone' => '089732932892',
                'instagram' => 'kholis123'
            ],
            [
                'name' => 'Agus',
                'phone' => '08734329834',
                'instagram' => 'agus_aw'
            ]
        ];
        return view('users.index', [
            'users' => $users
        ]);
    }

    public function show($user){
        return view('users.show', [
            'user' => $user
        ]);
    }
}
