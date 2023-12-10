<x-app-layout title="Users">
    <div class="container">
        @if (session()->has('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <x-card title='Users' subtitle='Table of users'>
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $users->firstItem() + $loop->index }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ $user->roles->count() ? $user->roles->implode('name', ', ') : '-' }}
                        </td>
                        <td>
                            <x-table.dropdown-menu>
                                @foreach ($roles as $role)
                                <li>
                                    <form method="POST" action="{{ route('roles.assign', $user) }}">
                                        @csrf
                                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                                        <a class="dropdown-item" href="{{ route('roles.assign', $user) }}"
                                            onclick="event.preventDefault();this.closest('form').submit();">
                                            Assign to be {{ $role->name }}
                                        </a>
                                    </form>
                                </li>
                                @endforeach
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Remove</a></li>
                            </x-table.dropdown-menu>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class='text-center'>
                                Data is currently empty.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $users->links() }}
        </x-card>
    </div>
</x-app-layout>