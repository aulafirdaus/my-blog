<x-app-layout title="Articles">
    <x-header title="Articles">
        @slot('subtitle')
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex nobis veniam, veritatis
        sint voluptatum quia sunt numquam laboriosam vel aliquam!
        @endslot
    </x-header>
    <div class="container">
        <x-articles :articles="$articles" />
    </div>
</x-app-layout>