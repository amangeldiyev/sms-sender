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
            $message_id = $sender->send($request->text, $request->phone);

            if ($message_id) {
                return view('form', compact('message_id'));
            } else {
                return view('form')->with('error', 'Something went wrong!');
            }

        }

        return view('form');
    }

    public function status($message_id)
    {
        $result = SmsSender::status($message_id);
        
        if (!$result) {
            abort(400);
        }

        $status = $result['status'];
        $error = $result['error'];


        switch ($status) {
            case 'D':
                $status = 'DELIVERED';
                break;
            case 'S':
                $status = 'SENT';
                break;
            case 'E':
                $status = 'EXPIRED';
                break;
            case 'U':
                $status = 'UNDELIVERABLE';
                break;
            case 'R':
                $status = 'REJECTED';
                break;
            case 'F':
                $status = 'FAILED';
                break;
        }

        return response()->json([
            'success' => true,
            'status' => $status,
            'error' => $error
        ]);
    }
}
