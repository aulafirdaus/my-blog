<x-app-layout title="Forgot Password">
    <div class="container">
        <div class="col-md-6">
            <x-card title="Forgot Password" subtitle="Enter your email address and we'll send verification.">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label">Email address</label>
                        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Forgot Password
                    </button>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>