<?php

namespace App\Http\Controllers;

use App\User;
use App\ReadTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (auth()->user()->cant('view', $user)) {
            return Redirect::route('users.permission_denied');
        }
        $user->group; // get dat infoz
        return view('profile', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (auth()->user()->cant('update', $user)) {
            return Redirect::route('users.permission_denied');
        }
        return view('profile_edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (auth()->user()->cant('update', $user)) {
            return Redirect::route('users.permission_denied');
        }
        $request->validate([
            'name' => 'required|unique:users,id,' . $user->id,
            'email' => 'required|email|unique:users,id,'  . $user->id,
            'avatar_url' => 'nullable|url'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->title = $request->title;
        $user->avatar_url = $request->avatar_url;
        $user->bio = $request->bio;
        $user->receives_email = (boolean) $request->receives_email;
        $user->save();

        // Password changing requires some extra logic, but still save the other stuff if it fails.
        $passwordError = '';
        if ($request->password) {
            if ($request->password === $request->password_confirm) {
                if (Hash::check($request->password_old, $user->password)) {
                    $user->password = Hash::make($request->password);
                    $user->save();
                    // Changing the password logs the user out for some reason, so log them right back in.
                    Auth::login($user);
                } else {
                    $passwordError = __('The current password you entered is incorrect.');
                }
            } else {
                $passwordError = __('Your new password and the confirmation password are not the same.');
            }
            if ($passwordError) {
                return Redirect::route('users.edit', ['user' => $user])->withErrors(['password' => $passwordError]);
            }
        }

        return Redirect::route('users.show', ['user' => $user]);
    }

    public function banned()
    {
        return view('banned');
    }

    public function permissionDenied()
    {
        return view('permission_denied');
    }

    public function ban(User $user)
    {
        if (auth()->user()->cant('ban', $user)) {
            return Redirect::route('users.permission_denied');
        }

        $user->banned = true;
        $user->save();

        return Redirect::route('users.show', ['user' => $user]);
    }

    public function unban(User $user)
    {
        if (auth()->user()->cant('ban', $user)) {
            return Redirect::route('users.permission_denied');
        }

        $user->banned = false;
        $user->save();

        return Redirect::route('users.show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->cant('delete', $user)) {
            return Redirect::route('users.permission_denied');
        }

        ReadTopic::where('user_id', $user->id)->delete();
        
        $user->posts()->delete();
        $user->topics()->delete();
        $user->delete();
        return Redirect::route('home');
    }
}
