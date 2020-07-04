@extends ('layouts.app')
     @section('content')
     <div class="container about-container"></div>
         {{-- <h1><?php echo $title ?></h1> --}}
         <h1 class="text-capitalize text-muted ">I have officially Ditched Frontend</h1>
         <p>Over the past few weeks, I was forced to learn Laravel, uhm, app blade templating actually because I needed it for promotion. The first few videos from Brad Traversy's channel did the trick, but i decided to go all out and complete the course and here we are.</p>
         <h4>What I have learned?</h4>
         <ul>
             <li>How to set up my local environment, for xampp, composer, vScode, Terminal etc</li>
             <li>How to make basic routes and controllers. The love I have for 'php artisan make:controller' is out of this world</li>
             <li>Blade templating and assets compilation. ("I consider myself a pro at this now. Hahaha. Just kidding")</li>
             <li>Models and Database Migration. Really cool. Gone are the days of making tables using mysql. Now, 'php artisan migrate' does the trick in seconds</li>
             <li>Fetching Data with Eloquent (That's a great ORM right there)</li>
             <li>Forms and saving Data. Laravel collective to the rescue.</li>
             <li>How to edit and delete data. Such cute commands like 'delete'.</li>
             <li>User authentication. My favorite part. You know how it always seems like magic when you sign up for a bank account and boom! You have your details presented to you on a dashboard. I know how it works now.</li>
             <li>Model relationships such that a user can have many posts. It was great learning this too</li>
             <li>Access control. Middleware to the rescue. Stop just anybody from making, viewing and deleting blog posts. This was really nice to learn</li>
             <li>File Uploading. I really had fun learning this. How to add a file upload button using laravel collective. How to create unique images with corresponding unique file extensions. How to actually upload a file that a user chooses, displaying a default 'noImage' thumbnail when a user doesn't choose a file. It was so great to learn.</li>
         </ul>
         <span>Excited yet? Head over to&nbsp;<a href="https://www.youtube.com/watch?v=EU7PRmCpx-0&list=PLillGF-RfqbYhQsN5WMXy6VsDMKGadrJ-" >Laravel from Scratch </a>to get started</span>

     @endsection

