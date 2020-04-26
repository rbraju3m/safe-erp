<?php

namespace App\Modules\Web\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {	
        return view("Web::home.index",compact(
        	''
        ));
    }


}
