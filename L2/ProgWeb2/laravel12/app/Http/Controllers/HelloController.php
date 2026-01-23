<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
public function index($nom)
{
    // On appelle la vue 'bonjour' et on lui passe la variable 'nom'
    return view('bonjour', ['nom' => $nom]);
}
}