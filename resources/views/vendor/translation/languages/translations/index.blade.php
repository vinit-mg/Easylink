@extends('translation::layout')

@section('body')

@if(auth()->user()->hasRole('super-admin'))

<x-admin.wrapper>

    <x-slot name="title">
        {{ __('Languages') }}
    </x-slot>


    @include('translation::nav')
    @include('translation::notifications')

    <form action="{{ route('languages.translations.index', ['language' => $language]) }}" method="get" class="translations-form-container">

        <div class="panel">
            <div class="panel-header">
                {{ __('translation::translation.translations') }}

                <div class="flex flex-grow justify-end items-center">
                    @include('translation::forms.search', ['name' => 'filter', 'value' => Request::get('filter')])
                    @include('translation::forms.select', ['name' => 'language', 'items' => $languages, 'submit' => true, 'selected' => $language])
                    @include('translation::forms.select', ['name' => 'group', 'items' => $groups, 'submit' => true, 'selected' => Request::get('group'), 'optional' => true])

                    @can('translation create')
                    <a href="{{ route('languages.translations.create', $language) }}" class="button">
                        {{ __('translation::translation.add') }}
                    </a>
                    @endcan
                </div>
            </div>

            <div class="panel-body">
                @if(count($translations))
                <table>
                    <thead>
                        <tr>
                            <th class="w-1/5 uppercase font-thin">{{ __('translation::translation.group_single') }}</th>
                            <th class="w-1/5 uppercase font-thin">{{ __('translation::translation.key') }}</th>
                            <th class="uppercase font-thin">{{ config('app.locale') }}</th>
                            <th class="uppercase font-thin">{{ $language }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($translations as $type => $items)
                        @foreach($items as $group => $translations)
                        @foreach($translations as $key => $value)
                        @if(!is_array($value[config('app.locale')]))
                        <tr>
                            <td>{{ $group }}</td>
                            <td>{{ $key }}</td>
                            <td>{{ $value[config('app.locale')] }}</td>
                            <td>
                                <translation-input
                                    initial-translation="{{ $value[$language] }}"
                                    language="{{ $language }}"
                                    group="{{ $group }}"
                                    translation-key="{{ $key }}"
                                    route="{{ config('translation.ui_url') }}">
                                </translation-input>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>

        </div>

    </form>

</x-admin.wrapper>

@else

<x-app-layout>
    <x-slot name="header">
        {{ __('Languages') }}
    </x-slot>

    @include('translation::nav')
    @include('translation::notifications')

    <form action="{{ route('languages.translations.index', ['language' => $language]) }}" method="get" class="translations-form-container">

        <div class="panel">
            <div class="panel-header">
                {{ __('translation::translation.translations') }}

                <div class="flex flex-grow justify-end items-center">
                    @include('translation::forms.search', ['name' => 'filter', 'value' => Request::get('filter')])
                    @include('translation::forms.select', ['name' => 'language', 'items' => $languages, 'submit' => true, 'selected' => $language])
                    @include('translation::forms.select', ['name' => 'group', 'items' => $groups, 'submit' => true, 'selected' => Request::get('group'), 'optional' => true])

                    @can('translation create')
                    <a href="{{ route('languages.translations.create', $language) }}" class="button">
                        {{ __('translation::translation.add') }}
                    </a>
                    @endcan
                </div>
            </div>

            <div class="panel-body">
                @if(count($translations))
                <table>
                    <thead>
                        <tr>
                            <th class="w-1/5 uppercase font-thin">{{ __('translation::translation.group_single') }}</th>
                            <th class="w-1/5 uppercase font-thin">{{ __('translation::translation.key') }}</th>
                            <th class="uppercase font-thin">{{ config('app.locale') }}</th>
                            <th class="uppercase font-thin">{{ $language }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($translations as $type => $items)
                        @foreach($items as $group => $translations)
                        @foreach($translations as $key => $value)
                        @if(!is_array($value[config('app.locale')]))
                        <tr>
                            <td>{{ $group }}</td>
                            <td>{{ $key }}</td>
                            <td>{{ $value[config('app.locale')] }}</td>
                            <td>
                                <translation-input
                                    initial-translation="{{ $value[$language] }}"
                                    language="{{ $language }}"
                                    group="{{ $group }}"
                                    translation-key="{{ $key }}"
                                    route="{{ config('translation.ui_url') }}">
                                </translation-input>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>

        </div>

    </form>

</x-app-layout>

@endif
@endsection