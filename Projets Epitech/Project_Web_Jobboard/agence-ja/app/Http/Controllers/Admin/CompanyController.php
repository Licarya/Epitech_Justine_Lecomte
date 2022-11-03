<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AddressController;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $companies = Company::orderBy('id', 'asc');
        $addresses = Address::all();
        
        $usersWithComp = DB::table('users')
        ->join('companies', 'users.id', '=', 'companies.users_id')
        ->select('users.*')->get();
        
        $users = DB::table('users')->where('role', '=', '2')->get();
        $usersClear = $users->diffKeys($usersWithComp);

        return view('admin.companies', [
            'companies' => $companies->paginate(5),
            'addresses' => $addresses,
        ], compact('usersClear'));
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
        Company::create([
            'users_id' => $request->input('users_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
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
        $company = Company::findOrfail($id);
        $user = DB::table('users')->where('id', '=', $company->users_id)->first();
        $address = DB::table('addresses')->where('users_id', '=', $user->id)->first();
        
        return view('admin.updateCompanies', compact('company', 'address')); 
        
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
        $user = User::find($id);
        
        DB::table('companies')->where('users_id', '=', $id)->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'users_id' => $user['id'],
        ]);

        $address = DB::table('addresses')->where('users_id', '=', $id)->first();
        if ($address != null) {
            $update = new AddressController;
            $update->update($request, $id);
        } else {
            $create = new AddressController;
            $create->store($request, $id);
        }
        return redirect('admin/companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $address = DB::table('addresses')->where('users_id', '=', $company->users_id)->first();
        if ($address != NULL) {
            Address::destroy($address->id);
        }
        $company->delete();

        return redirect('admin/companies');
    }
}
