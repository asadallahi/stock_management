<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $messages = null;

        if ($request->has('result'))
        {
            $messages['type'] = intval($request->result);
            $messages['key'] = $request->result_key;
        }

        return view('users.index', compact('messages'));
    }

    public function getData()
    {
        return Datatables::of(User::query())->make(true);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.create', compact('user'));
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        if ($user->update())
        {
            return redirect()->route('users.index', ['result' => true, 'result_key' => 'User Updated']);

        }

        return redirect()->route('users.index', ['result' => true, 'result_key' => 'Error!!! User Could not be updated']);

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete())
        {
            return redirect()->route('users.index', ['result' => true, 'result_key' => 'User Deleted']);
        }
        return redirect()->route('users.index', ['result' => false, 'result_key' => 'Error!!! User could not be Deleted']);
    }
}
