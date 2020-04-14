@if($errors->any())
@php ($account = (object) old())
  @endif
    <div class="row">
      <section class="col-md-12 text-right mb-2">
        <a class='btn btn-primary btn-sm' href="{{route('admin.account.index')}}">
          Listar <i class="fas fa-list"></i>
        </a>
      </section>
      <section class="col-md-8">

        @include('layouts.message')

        <label for="">Nome</label>
        <input type="text" name="name" class="form-control form-control-sm" placeholder="Digite um Nome"
        value="@isset($account->name){{$account->name}}@endisset">

        <label for="">Descrição</label>
        <input type="text" name="description" class="form-control form-control-sm" placeholder="Digite uma Descrição"
        value="@isset($account->description){{$account->description}}@endisset">

        @if($account_classes->count())
          <label>Classe de Conta</label>
          <select type="text" name="account_class_id" class="form-control form-control-sm">
            <option value="">Selecione</option>
            @foreach($account_classes as $class)
              <option value="{{ $class->id }}" @isset($account)@statusSelect($class->id == $account->class->id)@endisset>
                {{ $class->name }}
              </option>
            @endforeach
          </select>
        @else
          <p class="alert alert-warning m-2">
            Nunhma Classe de Conta Cadastrada
          </p>
        @endif

        <div class="custom-control custom-switch d-inline">
          <input type="checkbox" value='1' @isset($account->active)@statusCheck($account->active)@endisset name='active' class="custom-control-input" id="active">
          <label class="custom-control-label" for="active">Ativo</label>
        </div>

      </section>

      @if(isset($account->initial_date))
        <section class='col-md-4'>
          <p>
            <span class="badge badge-info">
              Iniciada: @dateBr($account->initial_date)
            </span>
            @isset($account->final_date)
              <span class="badge badge-info">
                Finalizada: @dateBr($account->final_date)
              </span>
            @endisset
          </p>
        </section>
      @endif
</div>
