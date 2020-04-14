@if($errors->any())
@php ($status = (object) old())
  @endif
    <div class="row">
      <section class="col-md-12 text-right mb-2">
        <a class='btn btn-primary btn-sm' href="{{route('admin.status.index')}}">
          Listar <i class="fas fa-list"></i>
        </a>
      </section>
      <section class="col-md-8">

        @include('layouts.message')

        <label for="">Nome</label>
        <input type="text" name="name" class="form-control" placeholder="Digite um Nome"
        value="@isset($status->name){{$status->name}}@endisset">
      </section>

      @if(isset($status))
        <section class='col-md-4'>
          <p>
            <span class="badge badge-info">
              Data: @dateBr($status->created_at) - @hora($status->created_at)
            </span>
          </p>
        </section>
    @endif
</div>
