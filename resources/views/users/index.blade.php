<x-app-layout title="Users">
<div class="container">
    <x-card title='User' subtitle='Tabel Users'>
        <table class="table">
            <thead>
                <th>No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Instagram</th>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['phone'] }}</td>
                        <td>{{ $user['instagram'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="text-center">
                                Data tidak ditemukan
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-card>
</div>
</x-app-layout>