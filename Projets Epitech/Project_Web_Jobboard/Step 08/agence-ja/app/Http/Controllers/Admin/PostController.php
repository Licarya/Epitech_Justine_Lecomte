<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobAlert;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        $posts = JobAlert::orderBy('companies_id', 'asc');
        
        return view('admin.posts', [
            'posts' => $posts->paginate(5),
        ], compact('companies'));
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
    public function store(Request $request)
    {
        $request->validate([
            'companies_id' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        JobAlert::create([
            'title' => $request->input('title'),
            'companies_id' => $request->input('companies_id'),
            'job_type' => $request->input('job_type'),
            'content' => $request->input('content'),
            'wage' => $request->input('wage'),
            'secteur'=> $request->input('secteur'),
            'wage_type'=> $request->input('wage_type'),

        ]);
        
       return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = JobAlert::findOrFail($id);
        return view('admin.updatePosts', compact('post'));
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
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        DB::table('job_alerts')->where('id', '=', $id)
            ->update([
                'title' => $request['title'],
                'job_type' => $request['job_type'],
                'content' => $request['content'],
                'wage' => $request['wage'],
                'secteur'=>$request['secteur'],
                'wage_type'=> $request->input('wage_type'),
            ]);

            return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = JobAlert::findOrFail($id);
        $post->delete();
        return $this->index();
    }
}
