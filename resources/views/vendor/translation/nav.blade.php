<!-- <nav class="header"> -->

<!-- <h1 class="text-lg px-6">{{ config('app.name') }}</h1> -->

<ul class="flex-grow justify-end pr-2 custom-nav">
    <li>
        <a href="{{ route('languages.index') }}" class="{{ set_active('') }}{{ set_active('/create') }} btn btn-primary">
            @include('translation::icons.globe')
            {{ __('translation::translation.languages') }}
        </a>
    </li>
    <li>
        <a href="{{ route('languages.translations.index', config('app.locale')) }}" class="{{ set_active('*/translations') }} btn btn-primary">
            @include('translation::icons.translate')
            {{ __('translation::translation.translations') }}
        </a>
    </li>
</ul>


<!-- </nav> -->