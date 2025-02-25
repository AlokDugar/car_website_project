@props(['title'=>''])
<x-base-layout title="{{$title}}">
    @include('layouts.partials.header')
    {{$slot}}
    <footer>

    </footer>
</x-base-layout>


