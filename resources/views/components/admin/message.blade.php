@if(session()->has('message'))
    <div role="alert" class="alert alert-success">
        <span>{{ session()->get('message') }}</span>
    </div>
@endif