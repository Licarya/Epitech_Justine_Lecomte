<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\UserController;
use App\Models\Company;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
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
    public function store(Request $request)
    {
        $user = Auth::user();
        Company::create([
            'users_id' => $user['id'],
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company = DB::table('companies')->where('users_id', '=', $id)->first();
        if ($company != null) {
            DB::table('companies')->where('users_id', '=', $id)
                ->update([
                    'name' => $request['name'],
                    'description' => $request['description'],
                ]);
        } else {

            $this->store($request);
        }


        $address = DB::table('addresses')->where('users_id', '=', $id)->first();

            if ($address != null) {
                $update = new AddressController;
                $update->update($request);
            } else {
                $create = new AddressController;
                $create->store($request);
            }
        $address = new UserController;
        return $address->show($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $company = DB::table('companies')->where('users_id', '=', $id)->first();
        Company::destroy($company->id);

        session()->forget('name');
        session()->forget('description');

        return redirect('dashboard');
    }
}
