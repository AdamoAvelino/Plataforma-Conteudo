@if($errors->any())
@php ($category = (object) old())
  @endif
    <div class="row">
      <section class="col-md-12 text-right mb-2">
        <a class='btn btn-primary btn-sm' href="{{route('admin.category.index')}}">
          Listar <i class="fas fa-list"></i>
        </a>
      </section>
      <section class="col-md-8">

        @include('layouts.message')

        <label for="">Nome</label>
        <input type="text" name="name" class="form-control" placeholder="Digite um Nome"
        value="@isset($category->name){{$category->name}}@endisset">
      </section>

      @if(isset($category))
        <section class='col-md-4'>
          <p>
            <span class="badge badge-info">
              Data: @dateBr($category->created_at) - @hora($category->created_at)
            </span>
          </p>
        </section>
    @endif
</div>
