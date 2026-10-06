@props(['active' => false])
<a {{ $attributes->merge(['class' => 'rf-nav-link ' . ($active ? 'is-active' : '')]) }} @if($active) aria-current="page" @endif>{{ $slot }}</a>
