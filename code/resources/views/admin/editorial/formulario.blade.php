@if($errors->any())
@php ($editorial = (object) old())
  @endif
    <div class="row">
      <section class="col-md-12 text-right mb-2">
        <a class='btn btn-primary btn-sm' href="{{route('admin.editorial.index')}}">
          Listar <i class="fas fa-list"></i>
        </a>
      </section>
      <section class="col-md-8">

        @include('layouts.message')

        <label for="">Nome</label>
        <input type="text" name="name" class="form-control" placeholder="Digite um Nome"
        value="@isset($editorial->name){{$editorial->name}}@endisset">
      </section>

      @if(isset($editorial))
        <section class='col-md-4'>
          <p>
            <span class="badge badge-info">
              Data: @dateBr($editorial->created_at) - @hora($editorial->created_at)
            </span>
          </p>
        </section>
    @endif
</div>
