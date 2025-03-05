@props(['title'=>'','bodyClass'=>null])
<x-base-layout :$title :$bodyClass>
    @include('layouts.partials.header')
    {{$slot}}
    <footer>

    </footer>
</x-base-layout>


