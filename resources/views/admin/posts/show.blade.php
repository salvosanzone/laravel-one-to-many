@extends('layouts.app')

@section('content')
  
  <div class="container d-flex justify-content-center">
    <div class="mb-3">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h4 class="card-title mb-0">Titolo del Post</h4>
          <h6>{{ $post->title }}</h6>
          <h4 class="card-subtitle mt-4">Contenuto</h4>
          <p class="card-text">{{ $post->content }}</p>
          <div class="d-flex">
            <a href="{{ route('admin.posts.edit', $post) }}" class="card-link btn btn-primary mr-3">Edit</a>
            <form onsubmit="return confirm('Sei sicuro di voler eliminare il post: {{ $post->title }}')" method="POST"
            action="{{ route('admin.posts.destroy', $post) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </div>
          
        </div>
      </div>
    </div> 
  </div>

  <div class="container d-flex align-items-end" style="height: 200px;" >
    <a href="{{ route('admin.posts.index') }}" class="btn btn-dark"><< Back</a>
  </div>
  
@endsection