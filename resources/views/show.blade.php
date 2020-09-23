@extends('layout.master')

@section('content')
    

  <!-- Page Content -->
  <div class="container my-5">

    <div class="row ">

             
      <!-- Blog Entries Column -->
      <div class="col-lg-12 ">
        <!-- Blog Post -->
        <div class="card mb-4">
        <img class="card-img-top" src="{{asset('/assets/uploads/'.$post->img)}}" alt="Card image cap">
          <div class="card-body">
          <h2 class="card-title">{{$post->title}}</h2>
          <p class="card-text  text-info">{{$post->desc}}</p>
          <p class="card-text">{{$post->contetnt}}</p>
          <a href="{{url('posts/edit',$post->id)}}" class="btn btn-success">Edit</a>
          <a href="{{url('posts/delete',$post->id)}}" class="btn btn-danger">Delete</a>

          </div>
          <div class="card-footer text-muted">
            Posted on {{$post->created_at}}
          </div>
        </div>
      </div>


    </div>
    <!-- /.row -->
    
  </div>
  <!-- /.container -->


  @endsection
