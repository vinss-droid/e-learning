<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // $level = Auth::user()->level;

        // dd($level)

        $mapel = Mapel::where('produktif', 0)->limit(8)->get();

        // dd($mapel);

        return view('Pages.Main.Home', compact('mapel'));
    }
}
