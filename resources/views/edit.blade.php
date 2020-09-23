@extends('layout.master')

@section('content')
    

  <!-- Page Content -->
  <div class="container mt-4">

    <div class="row">

             
      <!-- Blog Entries Column -->
      <div class="col-lg-8 offset-lg-2 ">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                <strong>{{$error}}}}</strong>
                </div>
            @endforeach
            
        @endif

      <form action="{{url('posts/update',$post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label >title:</label>
        <input class="form-control" type="text" name="title" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <label >desc:</label>
        <input class="form-control" type="text" name="desc" value="{{$post->desc}}">
        </div>
        <div class="form-group">
            <label >content:</label>
        <textarea class="form-control" type="text" name="contetnt">{{$post->contetnt}}</textarea>
        </div>
        <img width="100px" class="img-fluid" src="{{asset('/assets/uploads/'.$post->img)}}">
        <div class="form-group">
            <label >img</label>
            <input class="form-control-file" type="file" name="img">
        </div>
        <button name="submit" class="btn btn-info text-light" type="submit" >Update</button>
    </form>

      </div>

    </div>
    <!-- /.row -->
    
  </div>
  <!-- /.container -->


  @endsection
