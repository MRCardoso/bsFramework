<?php

namespace App\Http\Controllers;

use App\Entities\Feedback;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::where(['view_home' => true])
            ->orderBy('id', 'desc')
            ->get();
        return response()->json($feedbacks);
    }
    public function getToken()
    {
        return response()->json(['token' => csrf_token()]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "message" => "required",
            "email" => "email",
            "view_home" => "boolean"
        ]);

        try{
            $feedback = $request->all();
            unset($feedback['_token']);
            $feedback['user_agent'] = $request->server('HTTP_USER_AGENT');
            $feedback['ip_address'] = $request->getClientIp();
            Feedback::create($feedback);

            return response()->json(['message' => "Seu feedback foi enviado com sucesso! obrigado por sua atenção."]);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage() ]);
        }
    }
}
