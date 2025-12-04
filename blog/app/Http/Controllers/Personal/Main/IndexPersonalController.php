<?php

namespace App\Http\Controllers\Personal\Main;

use App\Http\Controllers\Controller;
class IndexPersonalController extends Controller
{
    public function __invoke()
    {
        return view('personal.main.index');
    }
}
