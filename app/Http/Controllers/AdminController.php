<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = User::all();
        return view('admin.admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/'  // must contain a special character],
            ]
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'position' => $request['position'],
            'password' => Hash::make($request['password']),
        ]);

        if ($request->has('save')) {
            return redirect(route('admin.index'))->with('message', 'Admin Added');
        } else {
            return redirect(route('admin.create'))->with('message', 'Admin Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        if ($admin->id > 1) {
            return view('admin.admin.edit', compact('admin'));
        }
        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $admin->update($request->all());

        if ($request->has('update')) {
            return redirect(route('admin.index'))->with('message', 'Admin Updated');
        } else {
            return redirect()->back()->with('message', 'Admin Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        if ($admin->id > 1) {
            $admin->delete();
            return redirect()->back()->with('message', 'Admin Deleted');
        }
        return redirect()->back();
    }

    public function profile()
    {
        return view('admin.admin.profile');
    }

    public function passwordChange(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/'  // must contain a special character],
            ],
            'oldPassword' => ['required', 'string', 'min:8']
        ]);
        $hashedPassword = Auth::user()->getAuthPassword();
        if (Hash::check($request['oldPassword'], $hashedPassword)) {
            auth()->user()->update([
                'password' => Hash::make($request['password']),
            ]);
            Auth::logout();
            return redirect(route('login'))->with('message', 'Password Change Successfully');
        }
        return redirect(route('profile'))->with('error', 'Password Not Changed');
    }
}
