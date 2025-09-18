<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = "Welcome Pages Area Index";
        return view('pages.index')->with('title', $title);
    }

    public function about() {
        $title = "About Page";
        return view('pages.about')->with('title', $title);
    }

    public function services() {
        $data = array(
            "title" => "Services Page",
            'services' => ['Application Development', 'Programming', "Ui/Ux"]
        );
        return view('pages.services')->with($data);
    }
}
