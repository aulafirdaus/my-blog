<x-app-layout title="Laravel from scratch">
    <div class="bg-dark text-white mb-5 border-bottom py-5" style="margin-top: -24px">
        <div class="container">
            <h1>Laravel from scratch</h1>
            <p class="text-light lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit perspiciatis hic dolor.</p>
        </div>
    </div>
    <div class="container">
        <x-articles :articles="$articles" />
    </div>
</x-app-layout>