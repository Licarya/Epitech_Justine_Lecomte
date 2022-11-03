<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobalertController extends Controller
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
        return view('addJob');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $user = Auth::user();
        $company = DB::table('companies')->where('users_id', '=', $user['id'])->first();
        JobAlert::create([
            'title' => $request->input('title'),
            'companies_id' => $company->id,
            'job_type' => $request->input('job_type'),
            'content' => $request->input('content'),
            'wage' => $request->input('wage'),
            'secteur'=> $request->input('secteur'),
            'wage_type'=> $request->input('wage_type'),

        ]);
        
        $show = new UserController;
        return $show->show($user->id);
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = DB::table('companies')->where('users_id', '=', $id)->first();
        if ($company != null) {
            $posts = DB::table('job_alerts')->where('companies_id', '=', $company->id)->get();
            return $posts;
        }
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
        $user = Auth::user();
        $company = DB::table('companies')->where('users_id', '=', $user['id'])->first();

        DB::table('job_alerts')->where('id', '=', $id)
            ->update([
                'title' => $request['title'],
                'companies_id' => $company->id,
                'job_type' => $request['job_type'],
                'content' => $request['content'],
                'wage' => $request['wage'],
                'secteur'=>$request['secteur'],
                'wage_type'=> $request->input('wage_type'),
            ]);

            $show = new UserController;
            return $show->show($user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobalert = JobAlert::findOrFail($id);
        $jobalert->delete();
        return redirect('dashboard');
    }
}
