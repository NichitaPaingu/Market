@props(['categories'])

<div class="can-header">
    <x-header-top/>
    <x-header-main/>
    <x-header-catalog :categories="$categories"/>
</div>
