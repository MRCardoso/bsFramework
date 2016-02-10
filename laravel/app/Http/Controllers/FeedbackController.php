<?php

namespace App\Http\Controllers;

use App\Entities\Feedback;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class FeedbackController extends Controller
{
    public function index()
    {
        if( checkGroup("admin") )
            return response()->json(Feedback::all()->withHidden('user_agent','ip_address'));
        else
            return response()->json(Lang::get('app.interface_not_found'), 404);
    }
    public function listFeed()
    {
        $comment = Feedback::where(['view_home' => true])->where(['type' => 'comment'])->orderBy('id', 'desc')->get();
        $sujestion = Feedback::where(['view_home' => true])->where(['type' => 'sujestion'])->orderBy('id', 'desc')->get();

        return response()->json(compact('comment', 'sujestion'));
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
            "type"      => "required",
            "application" => "required",
            "email" => "email",
            "view_home" => "boolean"
        ]);

        try{
            $feedback = $request->all();
            unset($feedback['_token']);
            $feedback['user_agent'] = $request->server('HTTP_USER_AGENT');
            $feedback['ip_address'] = $request->getClientIp();

            if ( !Feedback::create($feedback) )
                throw new \Exception("unkowun error");

            return response()->json(['message' => "Seu feedback foi enviado com sucesso! obrigado por sua atenção."]);
        } catch(\Exception $e) {
            mySendMailer(
                "isAdmin",
                "unkowun error in create feedback",
                ['email' => $request['email'],'message'=>$e->getMessage()],
                $request->all()
            );
            return response()->json([["não conseguimos enviar seu feedback." ]],400);
        }
    }
}
