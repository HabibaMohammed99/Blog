@extends('layout.master')

@section('content')
    

  <!-- Page Content -->
  <div class="container my-4 mb-5">

    <div class="row">

        @foreach ($posts as $post)
             
      <!-- Blog Entries Column -->
      <div class="col-lg-12 mb-5">
        <!-- Blog Post -->
        <div class="card mb-4">
          <img class="card-img-top" src="{{asset('/assets/uploads/'.$post->img)}}" alt="Card image cap">
          <div class="card-body">
          <h2 class="card-title">{{$post->title}}</h2>
          <p class="card-text">{{$post->desc}}</p>
          <a href="{{url('posts/show',$post->id)}}" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Posted on {{$post->created_at}}
          </div>
        </div>
      </div>

      @endforeach

    </div>
    <!-- /.row -->
    
  </div>
  <!-- /.container -->


  @endsection
