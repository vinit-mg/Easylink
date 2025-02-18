<x-admin.layout>
    <x-slot name="header">
        {{ $title }}
    </x-slot>
    <div>
        <x-admin.message />
        {{-- <x-admin.breadcrumb /> --}}
        <x-admin.form.errors />
    </div>
    {{ $slot }}
</x-admin.layout>
