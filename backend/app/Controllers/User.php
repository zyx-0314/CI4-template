<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index(): string
    {
        return view('user/landing');
    }

    public function moodBoard(): string
    {
        return view('user/mood_board');
    }

    public function roadmap(): string
    {
        return view('user/roadmap');
    }
}
