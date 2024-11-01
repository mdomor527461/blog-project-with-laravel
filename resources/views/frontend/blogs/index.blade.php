@extends('layouts.master')
@section('content')
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>Blogs</h1>
                         <p class="links"><a href="{{route('root')}}">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>


 <!-- Blog Layout-2-->
 <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">
                @foreach ($blogs as $blog)


                 <!--post 1-->
                 <div class="post-list post-list-style2">
                     <div class="post-list-image">
                         <a href="post-single.html">
                             <img src="{{asset('uploads/blog')}}/{{$blog->thumbnail}}" alt="" style="width: 300px;heigh:220px;fit-content:cover;">
                         </a>
                     </div>
                     <div class="post-list-content">
                         <h3 class="entry-title">
                             <a href="post-single.html">{{$blog->title}}</a>
                         </h3>
                         <ul class="entry-meta">
                             <li class="post-author-img"><img src="{{ Avatar::create($blog->oneuser->name)->toBase64() }}" /></li>
                             <li class="post-author"> <a href="author.html">{{$blog->oneuser->name}}</a></li>
                             <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span> {{$blog->oneuser->role}}</a></li>
                             <li class="post-date"> <span class="line"></span> {{Carbon\Carbon::parse($blog->created_at)->format("F d ,Y")}} </li>
                         </ul>
                         <div class="post-exerpt">
                             <p>{!! $blog->short_description !!}</p>
                         </div>
                         <div class="post-btn">
                             <a href="{{route('blog.single',$blog->id)}}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                         </div>
                     </div>
                 </div>
                 @endforeach
             </div>
         </div>
     </div>
 </section>


<!--pagination-->
<div class="pagination">
     <div class="container-fluid">
         <div class="pagination-area">
             <div class="row">
                    {{$blogs->links()}}
             </div>
         </div>
     </div>
 </div>

@endsection
