@extends ('layouts.app')
     @section('content')
         <h1>{{$title}}</h1>
         @if(count($services) > 0)
         <ul class="list-group">
            @foreach($services as $service)
              <li class="list-group-item">{{$service}}</li>
            @endforeach
         </ul> 
         @endif 
         <h4>This app also allows you to:</h4>
         <ul>
           <li>Sign up with us</li>
           <li>Login to your account</li>
           <li>Create your blog post</li>
           <li>Access your dashboard with all your posts</li>
           <li>Add images to your blog post</li>
           <li>Edit your blog post</li>
           <li>Delete your blog post</li>
           <li>And much more. Sign up to get started</li>
         </ul>
     @endsection

