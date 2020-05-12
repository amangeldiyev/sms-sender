<?php

namespace App\Http\Controllers;

use App\Services\SmsSender;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {

        if ($request->isMethod('POST')) {

            $this->validate($request, [
                'phone' => 'required',
                'text' => 'required'
            ]);

            $sender = new SmsSender();
            $sender->send($request->text, $request->phone);

            return view('form')->with('msg', 'Message sent successfully!');
        }

        return view('form');
    }
}
