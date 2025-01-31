<x-admin.wrapper>
    <x-slot name="title">
        {{ __($crud->title) }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                  <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                    <h5>{{ __($crud->title) }}</h5>
                  
                  </div> 
                  {!! crud($crud, 'create') !!}
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
