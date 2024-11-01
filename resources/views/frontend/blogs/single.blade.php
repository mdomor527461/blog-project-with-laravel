@extends('layouts.master')
@section('content')
<section class="post-single">
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-lg-12">
                <!--post-single-image-->
                    <div class="post-single-image d-flex justify-content-center">
                        <img src="{{asset('uploads/blog')}}/{{$blog->thumbnail}}" alt="">
                    </div>

                    <div class="post-single-body">
                        <!--post-single-title-->
                        <div class="post-single-title">
                            <h2>{{$blog->title}} </h2>
                            <ul class="entry-meta">
                                <li class="post-author-img"><img src="{{Avatar::create($blog->oneuser->name)->toBase64()}}" alt=""></li>
                                <li class="post-author"> <a href="author.html">{{$blog->oneuser->name}} </a></li>
                                <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span> {{$blog->oneuser->role}} </a></li>
                                <li class="post-date"> <span class="line"></span>{{Carbon\Carbon::parse($blog->created_at)->format("F d ,Y")}} </li>
                            </ul>

                        </div>

                        <!--post-single-content-->
                        <div class="post-single-content">
                            <p>
                                {!! $blog->short_description !!}
                            </p>
                            <h4> Full Description</h4>

                            <p>
                               {!! $blog->description !!}
                            </p>



                        </div>

                        <!--post-single-bottom-->
                        <div class="post-single-bottom">
                            <div class="tags">
                                <p>Tags:</p>
                                <ul class="list-inline">
                                    <li >
                                        <a href="blog-layout-2.html">brading</a>
                                    </li>
                                    <li >
                                        <a href="blog-layout-2.html">marketing</a>
                                    </li>
                                    <li >
                                        <a href="blog-layout-3.html">tips</a>
                                    </li>
                                    <li >
                                        <a href="blog-layout-4.html">design</a>
                                    </li>
                                    <li >
                                        <a href="blog-layout-5.html">business
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="social-media">
                                <p>Share on :</p>
                                <ul class="list-inline">
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" >
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" >
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!--post-single-author-->
                        <div class="post-single-author ">
                            <div class="authors-info">
                                <div class="image">
                                    <a href="author.html" class="image">
                                        <img src="{{Avatar::create($blog->oneuser->name)->toBase64()}}" alt="">
                                    </a>
                                </div>
                                <div class="content">
                                    <h4>{{$blog->oneuser->name}}</h4>
                                    <p> {{$blog->oneuser->email}}
                                    </p>
                                    <div class="social-media">

                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--post-single-comments-->
                        @auth
                        <div class="post-single-comments">
                            <!--Comments-->
                            <h4 >{{$comments->count()}} Comments</h4>
                            @foreach ($comments as $comment)
                            <ul class="comments">
                                <!--comment1-->
                                <li>
                                    <div class="d-flex my-5">
                                        <div class="mx-5">
                                            @if ($comment->oneuser->image == "default.jpg")
                                            <img src="{{Avatar::create($comment->oneuser->name)->toBase64()}}" alt="" style="width:120px;height:120px;border-radius:50%;">
                                            @else
                                            <img src="{{asset('uploads/profile')}}/{{$comment->oneuser->image}}" alt="" style="width:120px;height:120px;border-radius:50%">
                                            @endif
                                       </div>
                                        <div class="content">
                                            <div class="meta">
                                                <ul class="list-inline">
                                                    <li class="mx-2"><a href="#">{{$comment->oneuser->name}}</a> </li>
                                                    <li>{{Carbon\Carbon::parse($comment->created_at)->diffForhumans()}} </li>
                                                </ul>
                                            </div>
                                            <p>{{$comment->comment}}
                                            </p>
                                            <a href="#comment" onclick="myfun({{$comment->id}})" class="btn-reply"><i class="las la-reply"></i> Reply</a>
                                        </div>
                                    </div>
                                </li>
                                @foreach ($comment->replies as $reply)
                                <li>
                                    <div class="d-flex my-5 pl-5">
                                        <div class="mx-5">
                                            @if ($reply->oneuser->image == "default.jpg")
                                            <img src="{{Avatar::create($reply->oneuser->name)->toBase64()}}" alt="" style="width:120px;height:120px;border-radius:50%;">
                                            @else
                                            <img src="{{asset('uploads/profile')}}/{{$reply->oneuser->image}}" alt="" style="width:120px;height:120px;border-radius:50%">
                                            @endif
                                       </div>
                                        <div class="content">
                                            <div class="meta">
                                                <ul class="list-inline">
                                                    <li class="mx-2"><a href="#">{{$reply->oneuser->name}}</a> </li>
                                                    <li>{{Carbon\Carbon::parse($reply->created_at)->diffForhumans()}} </li>
                                                </ul>
                                            </div>
                                            <p>{{$reply->comment}}
                                            </p>
                                            <a href="#comment" onclick="myfun({{$comment->id}})" class="btn-reply"><i class="las la-reply"></i> Reply</a>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @endforeach
                            <!--Leave-comments-->
                            <div class="comments-form">
                                <h4 >Leave a Reply</h4>
                                <!--form-->
                                <form class="form " action="{{route('comment',$blog->id)}}" method="POST" id="comment">
                                    @csrf
                                    <p>Your email adress will not be published ,Requied fileds are marked*.</p>
                                    <div class="alert alert-success contact_msg" style="display: none" role="alert">
                                        Your message was sent successfully.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Name*">
                                                <input type="text" name="parent_id" id="parent_id" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email*">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="comment" id="message" cols="30" rows="5" class="form-control" placeholder="Message*"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <button type="submit" name="submit" class="btn-custom">
                                                Send Comment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!--/-->
                            </div>
                        </div>
                        @endauth

                    </div>
            </div>
        </div>
    </div>
</section>
<script>
    const myfun = (id)=>{
        let parent = document.getElementById('parent_id');
        parent.value = id;
    }
</script>

@endsection
