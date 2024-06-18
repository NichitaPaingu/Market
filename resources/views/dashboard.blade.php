<x-layout>
    <x-slot:heading>
        Dashboard
    </x-slot:heading>
    <x-succes message="{{session('succes')}}"></x-succes>
    @if($user->is_admin)
        <x-admin-dashboard :user="$user"/>
    @else
        <x-user-dashboard :user="$user"/>
    @endif
</x-layout>
