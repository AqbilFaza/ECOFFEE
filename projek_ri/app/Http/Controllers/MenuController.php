<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('home', compact('menus'));
    }

    public function detail($id)
    {
        $menu = Menu::find($id);
        return view('menu.detail', compact('menu'));
    }
}

