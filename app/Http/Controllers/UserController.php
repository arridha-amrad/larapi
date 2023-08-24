<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->save();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // find working with primary key
        return User::find($id);

        // return User::where("name", $name)->first();

        // return User::firstWhere('name', $name);

        // if no results are found, execute the closure
        // return User::findOr($name, function () {
        //     return "User not found mate!!";
        // });
        // return User::where("name", $name)->firstOr(function () {
        //     return "User not found mate!!";
        // });

        // if no results are found, throw 404 error
        // return User::findOrFail($name);
        // return User::where("name", $name)->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::find($id);
        $user->name = $request->name;
        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = User::find($id);
        $user->delete();

        // deleting existing model by its primary key
        // User::destroy($id);

        // deleting user with query
        // User::where("email_verified_at", null)->delete();

        return "User deleted";
    }

    public function showWithSoftDeletedData(string $id)
    {
        $user = User::withTrashed()->where("id", $id)->get();
        return $user;
    }
}
