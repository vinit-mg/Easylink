<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Email Templates') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('admin.emailtemplates.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add email template')}}</a>
                        </div> 
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Template name')}}</th>
                                    <th>{{__('Subject')}}</th>
                                    <th>{{__('From email')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($EmailTemplates as $EmailTemplate)
                                    <tr>
                                        <td>{{$EmailTemplate->TemplateName}}</td>
                                        <td>{{$EmailTemplate->EmailSubject}}</td>
                                        <td>{{$EmailTemplate->EmailFrom}}</td>
                                        <td>
                                            @canany(['adminUpdate', 'adminDelete'], $EmailTemplate)
                                                <form action="{{ route('admin.emailtemplates.destroy', $EmailTemplate->id) }}" method="POST">
                                                    
                                                    <div class="flex">
                                                        @can('adminUpdate', $EmailTemplate)
                                                            <a class="btn btn-primary" href="{{route('admin.emailtemplates.edit', $EmailTemplate->id)}}"><i class="bi bi-pencil-square"></i></a>
                                                        @endcan
                                                        @can('adminDelete', $EmailTemplate)
                                                        @csrf
                                                        @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                        @endcan
                                                    </div>
                                                </form>
                                            @endcanany
                                        </td>
                                    </tr>
                                @endforeach
                                @if($EmailTemplates->isEmpty())
                                    <tr>
                                        <td colspan="3">
                                            {{ __('No email template found') }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <!-- End Table with stripped rows -->
                        {{ $EmailTemplates->appends(request()->query())->links() }}

                    </div>
                </div>

            </div>
        </div>
      </section>
</x-admin.wrapper>
