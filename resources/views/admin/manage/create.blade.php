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
                            <h1>Add New {{ ucfirst($entity) }}</h1>
                        </div> 
                        <form action="{{ route('manage.store', $entity) }}" method="POST">
                            @csrf
                            @foreach((new \App\Models\{{ ucfirst($entity) }})->getFillable() as $field)
                            <div class="mb-3">
                                <label for="{{ $field }}" class="form-label">{{ ucfirst($field) }}</label>
                                <input type="text" class="form-control" id="{{ $field }}" name="{{ $field }}">
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
      </section>
</x-admin.wrapper>
