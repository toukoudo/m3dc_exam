<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            return redirect('/viewpage');
        } elseif ($request->isMethod('get')) {
            $date = config('defaultcfg.defaultcfg.VIEW_INFO_DATE');
            $title = config('defaultcfg.defaultcfg.VIEW_INFO_TITLE');
            $prof  = config('defaultcfg.defaultcfg.VIEW_INFO_PROF');
            return view('viewpages.input', ['date' => $date, 'title' => $title, 'prof' => $prof]);
        }
    }
    
    public function displayview()
    {
        return view('viewpages.viewpage', ['inquiry_url' => config('defaultcfg.defaultcfg.INQUIRY_URL')]);
    }
}
