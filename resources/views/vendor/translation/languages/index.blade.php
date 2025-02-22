@extends('translation::layout')

@section('body')

@if(auth()->user()->hasRole('super-admin'))
<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Languages') }}
    </x-slot>

    @include('translation::nav')
    @include('translation::notifications')

    @if(count($languages))

    <div class="panel w-1/2">

        <div class="panel-header">
            {{ __('translation::translation.languages') }}

            <div class="flex flex-grow justify-end items-center">
                @can('language create')
                <a href="{{ route('languages.create') }}" class="button">
                    {{ __('translation::translation.add') }}
                </a>
                @endcan
            </div>

        </div>

        <div class="panel-body">

            <table>
                <thead>
                    <tr>
                        <th>{{ __('translation::translation.language_name') }}</th>
                        <th>{{ __('translation::translation.locale') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($languages as $language => $name)
                    <tr>
                        <td>{{ $name }}</td>
                        <td>
                            <a href="{{ route('languages.translations.index', $language) }}">
                                {{ $language }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

    @endif

</x-admin.wrapper>

@else
<x-app-layout>
    <x-slot name="header">
        {{ __('Languages') }}
    </x-slot>

    @include('translation::nav')
    @include('translation::notifications')

    @if(count($languages))

    <div class="panel w-1/2">

        <div class="panel-header">
            {{ __('translation::translation.languages') }}

            <div class="flex flex-grow justify-end items-center">
                @can('language create')
                <a href="{{ route('languages.create') }}" class="button">
                    {{ __('translation::translation.add') }}
                </a>
                @endcan
            </div>

        </div>

        <div class="panel-body">

            <table>
                <thead>
                    <tr>
                        <th>{{ __('translation::translation.language_name') }}</th>
                        <th>{{ __('translation::translation.locale') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($languages as $language => $name)
                    <tr>
                        <td>{{ $name }}</td>
                        <td>
                            <a href="{{ route('languages.translations.index', $language) }}">
                                {{ $language }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

    @endif

</x-app-layout>
@endif

@endsection