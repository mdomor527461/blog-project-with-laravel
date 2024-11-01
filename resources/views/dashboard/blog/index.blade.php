@extends('layouts.dashboard_master')
@section('content')
<x-breadcum omor="Blog's show page"></x-breadcum>
{{-- blog table  --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Blog's Table</h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category Title</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->index + 1 }}
                                    </th>
                                    <td>
                                        <img src="{{ asset('uploads/blog') }}/{{ $blog->thumbnail }}" style="width:80px; height:80px;">
                                    </td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->oncategory->title }}</td>
                                    <td>
                                    <form id="heroalam{{ $blog->id }}" action="{{route('blog.status.update',$blog->slug)}}" method="POST">
                                        @csrf
                                        <div class="form-check form-switch">
                                            <input onchange="document.querySelector('#heroalam{{ $blog->id }}').submit()" class="form-check-input  {{ $blog->status == 'active' ? 'bg-success' : 'bg-danger' }}" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $blog->status == 'active' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                        </div>
                                    </form>
                                    </td>
                                <td>
                                    <td>
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showModal{{ $blog->id }}" class="btn btn-info btn-sm">
                                            Show Description
                                        </a>
                                    </td>
                                    <td>

                                       <div class="d-flex justify-content-around">
                                        <a href="{{ route('blog.edit',$blog->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                       </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="showModal{{ $blog->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $blog->id }} - {{ $blog->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2>Title - {{ $blog->title }}</h2>
                                            <p>Description - {!! $blog->description !!}</p>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                            {{$blogs->links()}}
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>

</div>

@endsection
@section('script')

@if (session('success'))
    <script>
        Toastify({
        text: "{{ session('success') }}",
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
