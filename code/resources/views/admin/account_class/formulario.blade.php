@if($errors->any())
@php ($account_class = (object) old())
  @endif
    <div class="row">
      <section class="col-md-12 text-right mb-2">
        <a class='btn btn-primary btn-sm' href="{{route('admin.account_class.index')}}">
          Listar <i class="fas fa-list"></i>
        </a>
      </section>
      <section class="col-md-8">

        @include('layouts.message')

        <label for="">Nome</label>
        <input type="text" name="name" class="form-control form-control-sm" placeholder="Digite um Nome"
        value="@isset($account_class->name){{$account_class->name}}@endisset">

        <label for="">Descrição</label>
        <input type="text" name="description" class="form-control form-control-sm" placeholder="Escreva um Descrição"
        value="@isset($account_class->description){{$account_class->description}}@endisset">
      </section>

      @if(isset($account_class->created_at))
        <section class='col-md-4'>
          <p>
            <span class="badge badge-info">
              Data: @dateBr($account_class->created_at) - @hora($account_class->created_at)
            </span>
          </p>
        </section>
    @endif
</div>
