<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index(): string
    {
        return view('user/landing');
    }

    public function moodBoard(): string
    {
        return view('user/mood_board');
    }
}
