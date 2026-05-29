@extends('layouts.admin')
@section('title','Kelola Users')
@section('page-title','Kelola Users')
@section('page-sub','Semua user terdaftar')
@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
  <div class="px-5 py-4 border-b border-slate-50 flex items-center justify-between">
    <p class="text-sm text-slate-500">Total <strong>{{ $users->total() }}</strong> user</p>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50 border-b border-slate-100 text-xs">
        <tr>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider">User</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">Email</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider">Role</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider hidden lg:table-cell">Enrollment</th>
          <th class="text-left px-5 py-3.5 font-semibold text-slate-500 uppercase tracking-wider hidden lg:table-cell">Bergabung</th>
          <th class="px-5 py-3.5"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-50">
        @forelse($users as $u)
        <tr class="hover:bg-slate-50 transition">
          <td class="px-5 py-4">
            <div class="flex items-center gap-3">
              <img src="{{ $u->avatarUrl() }}" class="w-9 h-9 rounded-full object-cover flex-shrink-0">
              <p class="font-semibold text-slate-800">{{ $u->name }}</p>
            </div>
          </td>
          <td class="px-5 py-4 hidden md:table-cell text-slate-500 text-xs">{{ $u->email }}</td>
          <td class="px-5 py-4">
            <form action="{{ route('admin.users.role',$u) }}" method="POST">
              @csrf @method('PATCH')
              <select name="role" onchange="this.form.submit()" class="text-xs border border-slate-200 rounded-lg px-2 py-1.5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500">
                @foreach(['user'=>'Student','instructor'=>'Instructor','admin'=>'Admin'] as $v=>$l)
                <option value="{{ $v }}" {{ $u->role===$v ? 'selected' : '' }}>{{ $l }}</option>
                @endforeach
              </select>
            </form>
          </td>
          <td class="px-5 py-4 hidden lg:table-cell">
            <span class="badge bg-blue-100 text-blue-700 text-xs">{{ $u->enrollments_count }} course</span>
          </td>
          <td class="px-5 py-4 hidden lg:table-cell text-slate-400 text-xs">{{ $u->created_at->diffForHumans() }}</td>
          <td class="px-5 py-4 text-right">
            @if(!$u->isAdmin())
            <form action="{{ route('admin.users.destroy',$u) }}" method="POST" onsubmit="return confirm('Hapus user {{ $u->name }}?')">
              @csrf @method('DELETE')
              <button class="text-slate-400 hover:text-red-600 transition"><i class="bi-trash text-sm"></i></button>
            </form>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-12 text-slate-400">Tidak ada user.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($users->hasPages())
  <div class="px-5 py-4 border-t border-slate-100">{{ $users->links() }}</div>
  @endif
</div>
@endsection
