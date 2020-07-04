@extends ('layouts.app')
     @section('content')
     <div class="jumbotron text-center">
          <h1>{{$title}}</h1>
         <h2>Hi there! I'm Karen and I am so happy to have you here.</h2>
         <br>
     <img src="{{asset('pic1.jpg')}}" alt="Karen's image" class="img-fluid" 
     style= 'width:100%; height:auto;'>
         <p>This is a complete Laravel application with a blogging feature. I am so excited because this is actually the first time I followed a course down through to the end. But what can i say? When you have a great teacher like    <a href="https://www.youtube.com/watch?v=EU7PRmCpx-0&list=PLillGF-RfqbYhQsN5WMXy6VsDMKGadrJ-" class="btn btn-primary">Brad Traversy</a>, you've got no choice. Thanks a lot Brad. Now, have you ever wanted to write blog posts about anything? Health, marriage, lifestyle, photography? Here's your chance. Knock yourself out. <br>
     Also, there have been many updates to the course since 2017 when it was recorded. Feel free to download the files from this repo if you have any issues along the way. <a href="https://github.com/KarenEfereyan/Laravel-App">Laravel App By Karen</a> I am also very much ready to help. That being said, can I add 'Laravel developer' to my CV? Hahaha. Let's see how that goes.</p>
         <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
         <a class="btn btn-primary btn-lg" href="/register" role="button">Register</a>
     </div>
     @endsection
