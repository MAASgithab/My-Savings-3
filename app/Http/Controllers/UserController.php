<?php

namespace App\Http\Controllers;

use App\Models\Target;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = User::where('role', 'staff')->get();

        return view('admin.data-staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data-staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        return redirect()->route('admin.data-staff.index')->with('success', 'Staff berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.data-staff.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.data-staff.index')->with('success', 'Staff berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.data-staff.index')->with('success', 'Staff berhasil dihapus sementara');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'password.required' => 'Password is required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);
        if ($user) {
            return redirect()->route('login')->with('success', 'User created successfully');
        } else {
            return redirect()->route('signup')->with('error', 'Something went wrong');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'password.required' => 'Password is required',
        ]);
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role == 'staff') {
                return redirect()->route('staff.dashboard');
            } else {
                return redirect()->route('index');
            }
        } else {
            return redirect()->route('login')->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('success', 'Logout successfully');
    }

    public function trash()
    {
        $trashedStaff = User::onlyTrashed()->where('role', 'staff')->get();

        return view('admin.data-staff.trash', compact('trashedStaff'));
    }

    public function restore(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.data-staff.trash')->with('success', 'Staff berhasil dipulihkan');
    }

    public function forceDelete(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('admin.data-staff.trash')->with('success', 'Staff berhasil dihapus permanen');
    }

    // User methods for staff section
    public function indexUser()
    {
        $users = User::where('role', 'user')->get();

        return view('staff.data-user.index', compact('users'));
    }

    public function createUser()
    {
        return view('staff.data-user.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('staff.data-user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function editUser(string $id)
    {
        $user = User::findOrFail($id);

        return view('staff.data-user.edit', compact('user'));
    }

    public function updateUser(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('staff.data-user.index')->with('success', 'User berhasil diupdate');
    }

    public function destroyUser(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('staff.data-user.index')->with('success', 'User berhasil dihapus sementara');
    }

    public function trashUser()
    {
        $trashedUsers = User::onlyTrashed()->where('role', 'user')->get();

        return view('staff.data-user.trash', compact('trashedUsers'));
    }

    public function restoreUser(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('staff.data-user.trash')->with('success', 'User berhasil dipulihkan');
    }

    public function forceDeleteUser(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('staff.data-user.trash')->with('success', 'User berhasil dihapus permanen');
    }

    public function userIndex()
    {
        $user = Auth::user();

        $targets = $user->targets()->latest()->get(); // ambil semua target
        $transactions = $user->transactions()->latest()->get(); // ambil transaksi
        $totalExpenses = $transactions->sum('amount'); // total pengeluaran
        $totalSavings = $user->savings->sum('amount'); // total tabungan user

        return view('index', compact('targets', 'transactions', 'totalExpenses', 'totalSavings'));
    }
}
