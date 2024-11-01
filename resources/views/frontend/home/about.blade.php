@extends('layouts.master')
@section('content')
  <!--section-heading-->
  <div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>About us</h1>
                         <p class="links"><a href="{{route("root")}}">Home <i class="las la-angle-right"></i></a> pages</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>

<!--about-us-->
<section class="about-us">
    <div class="container-fluid">
        <div class="about-us-area">
            <div class="row ">
                <div class="col-lg-12 ">
                    <div class="image">
                        <img src="{{asset('frontend')}}/assets/img/other/about-1.jpg" alt="">
                    </div>

                    <div class="description">
                        <h3 >Thank you for checking out our blog website.</h3>
                        <p>**Oreeedo** is a dynamic and engaging blog platform designed for individuals passionate about sharing their thoughts, ideas, and stories. Whether you're a seasoned writer or someone exploring the joy of writing for the first time, Oreeedo provides a creative space for everyone. With a sleek, user-friendly interface, users can easily create and manage their own blogs, personalize their posts, and connect with a vibrant community of readers.

                            Oreeedo aims to foster a sense of community among its users, allowing them to comment on and engage with posts, helping to build meaningful conversations. The platform offers a variety of categories, from lifestyle and travel to technology and personal experiences, ensuring that there’s something for every type of reader.

                            Writers on Oreeedo have full control over their content—they can draft, edit, and publish posts at their convenience, while readers enjoy an uninterrupted, ad-free reading experience. The blog is designed with mobile-friendliness in mind, allowing users to access and interact with the platform from any device.

                            Oreeedo is not just a blog site; it's a creative outlet where voices can be heard, stories can be shared, and new perspectives can be discovered. Dive into the world of Oreeedo and become part of a growing community of storytellers!</p>
                        <a href="{{route('contact')}}" class="btn-custom">Contact us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
