@extends('layouts.dashboard_master')
@section('content')

{{-- category table  --}}

<div class="row">



    {{-- category form  --}}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Category Insert form</h4>

                <form role="form" action="{{route('category.update',$category->slug)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputEmail3" placeholder="Title" name="title" value="{{$category->title}}">
                        </div>
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Category Slug</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputPassword3" placeholder="Slug" name="slug" value="{{$category->slug}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-9">
                            <img id="heloalam" src="{{ asset('uploads/category') }}/{{ $category->image }}" style="width:100%; height:200px; object-fit:contain;">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Category Image</label>
                        <div class="col-sm-9">
                            <input onchange="document.querySelector('#heloalam').src = window.URL.createObjectURL(this.files[0])" type="file" class="form-control @error('image') is-invalid @enderror" id="inputPassword5" name="image">
                        </div>
                        @error('image')
                        <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')

@if (session('category_success'))
    <script>
        Toastify({
        text: "{{ session('category_success') }}",
        duration: 5000,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        onClick: function(){} // Callback after click
        }).showToast();
    </script>
@endif

@endsection
