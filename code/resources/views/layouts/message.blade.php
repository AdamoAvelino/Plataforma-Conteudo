
@if(session('success'))
<div class="col-md-12">
  <p class="alert alert-success" role="alert">
    <i class="fas fa-thumbs-up"></i>
    <strong>Parabéns:</strong><br>
    {{session('success')}}
  </p>
</div>
@endif

@if(session('error'))
<div class="col-md-12">
  <p class="alert alert-danger" role="alert">
    <i class="fas fa-exclamation-circle"></i>
    <strong>Erro:</strong><br>
    {{session('error')}}
  </p>
</div>
@endif

@if($errors->any())
<div class="col-md-12">
  <p class="alert alert-danger" role="alert">
    <i class="fas fa-exclamation-circle"></i>
    <span>Erro:</span><br>
    @foreach($errors->all() as $error)
    {{$error}} <br>
    @endforeach
  </p>
</div>
@endif