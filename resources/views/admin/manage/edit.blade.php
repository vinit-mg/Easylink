<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Store comapnies') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h1>Edit {{ ucfirst($entity) }}</h1>
                        </div> 
                        <form action="{{ route('manage.update', [$entity, $record->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @foreach($record->getAttributes() as $field => $value)
                            <div class="mb-3">
                                <label for="{{ $field }}" class="form-label">{{ ucfirst($field) }}</label>
                                <input type="text" class="form-control" id="{{ $field }}" name="{{ $field }}" value="{{ $value }}">
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
      </section>
</x-admin.wrapper>
