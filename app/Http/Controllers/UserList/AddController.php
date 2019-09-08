<?php

namespace App\Http\Controllers\UserList;

use App\Http\Controllers\Controller;

use App\UserList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddController extends Controller
{
    protected $redirect_to = '/';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user_list'],
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return UserList::create([
            'name'     => $data['name'],
            'lastname' => $data['lastname'],
            'email'    => $data['email'],
        ]);
    }

    /**
     * Show user add form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showAddForm()
    {
        return view('user-list/add');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(Request $request)
    {
        $data = $request->all();

        $this->validator($data)->validate();
        $this->create($data);

        return redirect($this->redirect_to);
    }
}
