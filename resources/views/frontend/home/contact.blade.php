@extends('layouts.master')
@section('content')
 <!--section-heading-->
 <div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>Contact us</h1>
                         <p class="links"><a href="{{route('root')}}">Home <i class="las la-angle-right"></i></a> pages</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>

<!--contact-->
<section class="contact">
    <div class="container-fluid">
        <div class="contact-area">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-image">
                        <img src="{{asset('frontend')}}/assets/img/other/contact.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h3>feel free to contact us</h3>
                        <p>Please tell us your problem or share your journy with us.</p>
                    </div>
                    <!--form-->
                    <form action="{{route('send_mail')}}" method="POST" id="main_contact_form">
                        @csrf
                        <div class="alert alert-success contact_msg" style="display: none" role="alert">
                            Your message was sent successfully.
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name*" required="required">
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email*" required="required">
                        </div>

                        <div class="form-group">
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject*" required="required">
                        </div>

                        <div class="form-group">
                            <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Message*" required="required"></textarea>
                        </div>

                        <button type="submit" name="submit" class="btn-custom">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
