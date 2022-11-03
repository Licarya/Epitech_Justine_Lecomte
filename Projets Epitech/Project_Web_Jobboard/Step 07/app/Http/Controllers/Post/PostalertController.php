<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostalertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $user = Auth::user();
        $verif = DB::table('post_alerts')
        ->where('users_id', '=', $user['id'])
        ->where('job_alerts_id','=', $id)->first();
        $jobs = DB::table('job_alerts')->where('id', '=', $id)->select('title')->first();
        $job = $jobs->title;
        $message = $request->input('message');
        $lastname =  $request->input('lastname');
        $firstname =  $request->input('firstname');


        if ($verif != NULL) {
            return back();
        } else {
            if ($message == NULL) {
                $message = $firstname . ' ' . $lastname . ' ' . 'a postulé pour le poste de' . ' ' . $job;
            } else{
                $message = $request->input('message');
            }
            PostAlert::create([
                'job_alerts_id' => $id,
                'users_id' => $user->id,
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'message' => $message,
                'phone' => $request->input('phone'),
            ]);
        }


        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notifs = DB::table('post_alerts')->where('job_alerts_id','=',$id)->get(); 

        return view('viewCandidate', compact('notifs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
