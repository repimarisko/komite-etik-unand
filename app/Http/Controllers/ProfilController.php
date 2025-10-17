<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display the profile page of the ethics committee.
     */
    public function index()
    {
        return view('profil.index');
    }
}
