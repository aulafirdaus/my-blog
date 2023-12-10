<x-app-layout title="Settings / Password">
    <div class="container">
        <div class="col-md-8">
            @if (session()->has('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <x-card title='Change Password' subtitle="Don't tell anyone about your secret password.">
                <form action="{{ route('change-password') }}" method="post">
                    @method('put')
                    @csrf
                    <div class="mb-4">
                        <label for="current-password" class="form-label">Password</label>
                        <input type="password" name="current_password" id="current-password" class="form-control @error('current_password') is-invalid @enderror">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">New password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="confirm-password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Change password
                    </button>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>