<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    //
    //userデータの取得

    public function show($id) {

        // $user_id = Auth::find($id);

        $user = Auth::user();

        // return view('user.show', compact('user', 'user_id'));

        return view('users.show', ['user' => $user]);

    }
    //userデータの編集
    public function edit() {

        return view('users.edit', ['user' => Auth::user() ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //userデータの保存
    public function update(Request $request, $id) {

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        
        return redirect()->route('users.show', [Auth::user()->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // $user = User::find($id);
        $user = Auth::user();
        $user->delete();

        return redirect('/');
    }
}
