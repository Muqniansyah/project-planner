<?php

namespace App\Http\Controllers;

use App\Models\SumberDaya;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function userCreate()
    {
        $jobdesk = SumberDaya::where('type', 'Tenaga Kerja')->get();
        $user = User::paginate(5);

        return view('admin.user', compact('jobdesk', 'user'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string'],
            'jobdesk' => ['required', 'exists:sumber_dayas,id'],
        ]);

        Log::info($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'role' => $request->role, // Set role dari input
            'jobdesk' => $request->jobdesk,
        ]);

        $sumberDaya = SumberDaya::find($request->jobdesk);
        $sumberDaya->update([
            'quantity' => $sumberDaya->quantity + 1,
        ]);


        if ($user) {

            return redirect()->route('admin.user.create')->with('success', 'User created successfully.');
        } else {
            return redirect()->route('admin.user.create')->with('error', 'Failed to create user.');
        }
    }
}
