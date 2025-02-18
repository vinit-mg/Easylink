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
                            <h1>Manage {{ ucfirst($entity) }}</h1>
                        </div> 
                        <a href="{{ route('manage.create', $entity) }}" class="btn btn-primary mb-3">Add New</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    @foreach($records->first()->getAttributes() as $key => $value)
                                        <th>{{ ucfirst($key) }}</th>
                                    @endforeach
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                <tr>
                                    @foreach($record->getAttributes() as $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                    <td>
                                        <a href="{{ route('manage.edit', [$entity, $record->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('manage.destroy', [$entity, $record->id]) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
      </section>
</x-admin.wrapper>
