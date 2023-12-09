<x-app-layout title="Articles tag: {{ $tag->name }}">
    <x-header title="{{ $tag->name }}" subtitle="This page will show all articles tagged by {{ $tag->name }}" />
    <div class="container">
        <x-articles :articles="$articles" />
    </div>
</x-app-layout>