<?php

namespace App\Http\Controllers;

use App\Services\SmsSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $status = SmsSender::status($message_id);

        if (!$status) {
            abort(400);
        }

        if ($status == 'D') {
            $status = 'Delivered';
        }

        return response()->json([
            'success' => true,
            'status' => $status
        ]);
    }
}
