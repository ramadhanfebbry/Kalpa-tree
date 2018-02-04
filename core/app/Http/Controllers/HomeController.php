<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
  
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('root.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $request["skill"] = ($request->skill == "") ? "-" : $request->skill;
        $request["phone"] = ($request->phone == "") ? "-" : $request->phone;

        $request["password"] = ($request->password == "") ? $request->password_old : bcrypt($request->password);

        $this->validate($request, [
          'name' => 'required|max:255',
          'email' => 'required',
          'username' => 'required',
		]);
        $requestData = $request->all();

        $user = User::findOrFail($id);
        $user->update($requestData);

        Session::flash('flash_message', 'User updated!');

        return redirect('profil/'.Auth::User()->id."/edit");
    }
}
