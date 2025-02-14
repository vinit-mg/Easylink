
<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Store email template') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                  <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                    <h5>{{__('Edit email template')}}</h5>
                    <a class="btn btn-primary" href="{{route('admin.emailtemplates.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all email template')}}</a>
                  </div> 
                  <form class="row g-3" method="POST" action="{{ route('admin.emailtemplates.update', $emailtemplate->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="TemplateName" class="form-label">Template Name</label>
                        <input type="text" class="form-control" name="TemplateName" id="TemplateName" fdprocessedid="wngp6"  value="{{ old('TemplateName', $emailtemplate->TemplateName) }}">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="EmailSubject" class="form-label">Email Subject</label>
                        <input type="text" class="form-control" name="EmailSubject" id="EmailSubject" fdprocessedid="wngp6" value="{{ old('EmailSubject', $emailtemplate->EmailSubject) }}">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="EmailFrom" class="form-label">Email From</label>
                        <input type="email" class="form-control" name="EmailFrom" id="EmailFrom" fdprocessedid="wngp6"  value="{{ old('EmailFrom', $emailtemplate->EmailFrom) }}">
                    </div>
                    <div class="col-12">
                        <!-- TinyMCE Editor -->
                        <textarea class="tinymce-editor" name="EmailTemplate">
                            {{ old('EmailTemplate', $emailtemplate->EmailTemplate) }}
                        </textarea>
                        <!-- End TinyMCE Editor -->
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" fdprocessedid="ufar4">Update</button>
                    </div>
                </form>    
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
