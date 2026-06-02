<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:180|unique:users,email,' . $user->id,
            'is_admin' => 'nullable|boolean',
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'is_admin' => $request->has('is_admin'),
        ]);

        Log::info('Admin updated user', ['user_id' => $user->id, 'updated_by' => auth()->id()]);

        return redirect()->route('admin.users.index')->with('status', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            Log::warning('Self-delete attempt blocked', ['user_id' => $user->id, 'actor_id' => auth()->id()]);
            return back()->with('status', 'You cannot delete your own account from here.');
        }

        $user->delete();

        Log::warning('Admin deleted user', ['user_id' => $user->id, 'deleted_by' => auth()->id()]);

        return back()->with('status', 'User deleted successfully.');
    }
}
