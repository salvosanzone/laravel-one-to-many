@extends('layouts.app')

@section('content')
  <div class="container d-flex justify-content-center align-items-center flex-column" style="height: 500px;">
    <h1>Errore 404</h1>
    <h4>{{ $exception->getMessage() }}</h4>
  </div>
@endsection