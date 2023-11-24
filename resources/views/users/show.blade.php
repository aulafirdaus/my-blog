<x-app-layout title="{{ $user }}">
    <div class="container">
        <x-card title="{{ $user }}" subtitle="About me">
            Hi nama saya adalah {{ $user }}
        </x-card>
    </div>
</x-app-layout>