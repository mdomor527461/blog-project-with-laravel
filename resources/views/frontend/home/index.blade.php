@extends('layouts.master')

@section('content')
    <!-- blog-slider-->
    <section class="blog blog-home4 d-flex align-items-center justify-content-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel">
                        <!--post1-->
                        <div class="blog-item" style="background-image: url('{{asset('frontend')}}/assets/img/blog/bg1.jpg')">
                            <div class="blog-banner">
                                <div class="post-overly">
                                    <div class="post-overly-content">
                                        <div class="entry-cat">
                                            <a href="blog-layout-1.html" class="category-style-2">Branding</a>
                                        </div>
                                        <h2 class="entry-title">
                                            <a href="post-single.html">Architecture is a visual art and the buildings
                                                speak for them selves </a>
                                        </h2>
                                        <ul class="entry-meta">
                                            <li class="post-author"> <a href="author.html">Meriam Smith</a></li>
                                            <li class="post-date"> <span class="line"></span> Fabuary 10 ,2022</li>
                                            <li class="post-timeread"> <span class="line"></span> 15 mins read</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--post2-->
                        <div class="blog-item" style="background-image: url('{{asset('frontend')}}/assets/img/blog/bg2.jpg')">
                            <div class="blog-banner">
                                <div class="post-overly">
                                    <div class="post-overly-content">
                                        <div class="entry-cat">
                                            <a href="blog-layout-1.html" class="category-style-2">Livestyle</a>
                                        </div>
                                        <h2 class="entry-title">
                                            <a href="post-single.html">Styles come and go. Good design is a language,
                                                not a style. </a>
                                        </h2>
                                        <ul class="entry-meta">
                                            <li class="post-author"> <a href="author.html">Meriam Smith</a></li>
                                            <li class="post-date"> <span class="line"></span> Fabuary 10 ,2022</li>
                                            <li class="post-timeread"> <span class="line"></span> 15 mins read</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--post3-->
                        <div class="blog-item" style="background-image: url('{{asset('frontend')}}/assets/img/blog/bg3.jpg')">
                            <div class="blog-banner">
                                <div class="post-overly">
                                    <div class="post-overly-content">
                                        <div class="entry-cat">
                                            <a href="blog-layout-1.html" class="category-style-2">branding</a>
                                        </div>
                                        <h2 class="entry-title">
                                            <a href="post-single.html">Ignoring online marketing is like opening a
                                                business but not telling anyone </a>
                                        </h2>
                                        <ul class="entry-meta">
                                            <li class="post-author"> <a href="author.html">Meriam Smith</a></li>
                                            <li class="post-date"> <span class="line"></span> Fabuary 10 ,2022</li>
                                            <li class="post-timeread"> <span class="line"></span> 15 mins read</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- top categories-->
    <div class="categories">
        <div class="container-fluid">
            <div class="categories-area">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="categories-items">
                            @foreach ($categories as $category)
                            <a class="category-item" href="{{route('frontend.cat.blog',$category->slug)}}">
                                <div class="image">
                                    <img src="{{ asset('uploads/category') }}/{{ $category->image }}" alt="" style="width:120px; height:80px; object-fit:cover;">
                                </div>
                                <p>{{ $category->title }} <span>{{ $category->oneblog()->count() }}</span> </p>
                            </a>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent articles-->
    <section class="section-feature-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 oredoo-content">
                    <div class="theiaStickySidebar">
                        <div class="section-title">
                            <h3>Recent Blogs </h3>
                            <p>Discover the most outstanding Blogs in all topics of life.</p>
                        </div>

                        <!--post1-->
                        @foreach ($blogs as $blog)
                        <div class="post-list post-list-style4">
                            <div class="post-list-image">
                                <a href="post-single.html">
                                    <img src="{{asset('uploads/blog')}}/{{$blog->thumbnail}}" alt="">
                                </a>
                            </div>
                            <div class="post-list-content">
                                <ul class="entry-meta">
                                    <li class="entry-cat">
                                        <a href="blog-layout-1.html" class="category-style-1">{{$blog->title}}</a>
                                    </li>
                                    <li class="post-date"> <span class="line"></span> {{Carbon\Carbon::parse($blog->created_at)->format("F d ,Y")}}</li>
                                </ul>
                                <h5 class="entry-title">
                                    <a href="post-single.html">{!!$blog->short_description!!}</a>
                                </h5>

                                <div class="post-btn">
                                    <a href="{{route('blog.single',$blog->id)}}" class="btn-read-more">Continue Reading <i
                                            class="las la-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


