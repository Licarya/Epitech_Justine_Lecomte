<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Post\JobalertController;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        return view('registerUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        User::create([
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password')),
            'email' => $request->input('email'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'age' => $request->input('age'),
        ]);
        if (true) {
            return view('loginUser');
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrfail($id);
        Session::put('id', $user->id);
        Session::put('firstname', $user->firstname);
        Session::put('lastname', $user->lastname);
        Session::put('role', $user->role);
        Session::put('email', $user->email);
        Session::put('age', $user->age);
        Session::put('description', $user->description);
        Session::put('phone', $user->phone);
        Session::put('cv', $user->cv);

        $address = DB::table('addresses')->where('users_id', '=', $id)->first();
        if ($address != NULL) {
            Session::put('country', $address->country);
            Session::put('city', $address->city);
            Session::put('postal_code', $address->postal_code);
            Session::put('address1', $address->address1);
            Session::put('address2', $address->address2);
        }
        $company = DB::table('companies')->where('users_id', '=', $id)->first();
        if ($company != NULL) {
            Session::put('name', $company->name);
            Session::put('description', $company->description);
        }

        // $posts = DB::table('job_alerts')->where('companies_id', '=', $company->id)->first();
        
        // if ($user->role == 2 && $posts != NULL) {
        //     $post = new JobalertController;
        //     $posts = $post->show($user->id);
        //     dd($posts);
        //     return redirect()->route('dashboard', [$posts]);
        // } else {
        //     $posts = NULL;
        //         return redirect('dashboard')->with('posts');
        //     }
        return redirect('dashboard');
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
    public function update(UpdateUserRequest $request, $id)
    {

        if (session('role') == 1) {
            DB::table('users')->where('id', '=', $id)
                ->update([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'phone' => $request['phone'],
                    'description' => $request['description'],
                ]);

            $address = DB::table('addresses')->where('users_id', '=', $id)->first();

            if ($address != null) {
                $update = new AddressController;
                $update->update($request);
            } else {
                $create = new AddressController;
                $create->store($request);
            }

            return $this->show($id);

        } else if (session('role') == 2) {
            DB::table('users')->where('id', '=', $id)
                ->update([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'phone' => $request['phone'],
                ]);

            return $this->show($id);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/');
    }
}
