@extends('translation::layout')

@section('body')

@if(auth()->user()->hasRole('super-admin'))

<x-admin.wrapper>

    <x-slot name="title">
        {{ __('Languages') }}
    </x-slot>

    @include('translation::nav')
    @include('translation::notifications')

    <div class="panel w-1/2">

        <div class="panel-header">
            {{ __('translation::translation.add_language') }}
        </div>

        <form action="{{ route('languages.store') }}" method="POST">

            <fieldset>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="panel-body p-4">
                    @include('translation::forms.text', ['field' => 'name', 'label' => __('translation::translation.language_name')])
                    @include('translation::forms.text', ['field' => 'locale', 'label' => __('translation::translation.locale')])
                </div>

            </fieldset>

            <div class="panel-footer flex flex-row-reverse">
                <button class="button button-blue">
                    {{ __('translation::translation.save') }}
                </button>
            </div>

        </form>

    </div>

</x-admin.wrapper>

@else

<x-app-layout>
    <x-slot name="header">
        {{ __('Languages') }}
    </x-slot>

    @include('translation::nav')
    @include('translation::notifications')

    <div class="panel w-1/2">

        <div class="panel-header">
            {{ __('translation::translation.add_language') }}
        </div>

        <form action="{{ route('languages.store') }}" method="POST">

            <fieldset>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="panel-body p-4">
                    @include('translation::forms.text', ['field' => 'name', 'label' => __('translation::translation.language_name')])
                    @include('translation::forms.text', ['field' => 'locale', 'label' => __('translation::translation.locale')])
                </div>

            </fieldset>

            <div class="panel-footer flex flex-row-reverse">
                <button class="button button-blue">
                    {{ __('translation::translation.save') }}
                </button>
            </div>

        </form>

    </div>

</x-app-layout>

@endif

@endsection