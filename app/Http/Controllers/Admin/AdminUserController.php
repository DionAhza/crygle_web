<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::withCount('enrollments','courses')
            ->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        abort_if($user->isAdmin(), 403, 'Tidak bisa ubah role admin.');
        $request->validate(['role' => 'required|in:user,instructor,admin']);
        $user->update(['role' => $request->role]);
        return back()->with('success', "Role {$user->name} diubah ke {$request->role}.");
    }

    public function destroy(User $user)
    {
        abort_if($user->isAdmin(), 403, 'Tidak bisa hapus admin.');
        $user->delete();
        return back()->with('success', 'User dihapus.');
    }
}
