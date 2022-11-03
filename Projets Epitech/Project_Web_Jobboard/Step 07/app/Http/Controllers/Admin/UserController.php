<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
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
        $users = User::orderBy('id', 'asc');
        $companies = Company::all();
        return view('admin.users', [
            'users' => $users->paginate(5),
            'companies' => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $user = User::findOrfail($id);
        $address = DB::table('addresses')->where('users_id', '=', $id)->first();

        return view('admin.updateUsers', compact('user', 'address'));

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
        DB::table('users')->where('id', '=', $id)
                ->update([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'age' => $request['age'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                    'description' => $request['description'],
                ]);

            $address = DB::table('addresses')->where('users_id', '=', $id)->first();

            if ($address != null) {
                $update = new AddressController;
                $update->update($request, $id);
            } else {
                $create = new AddressController;
                $create->store($request, $id);
            }
            return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return back();
    }
}
