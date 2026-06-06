<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('users.index')->with('success', 'تم إضافة المستخدم بنجاح.');
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'المستخدم غير موجود.');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($data);

        return redirect()->route('users.index')->with('success', 'تم تحديث بيانات المستخدم بنجاح.');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح.');
    }
}
