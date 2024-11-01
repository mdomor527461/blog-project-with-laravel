@extends('layouts.dashboard_master')
@section('content')
<div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Role & User Registration</h4>

                <form role="form" action="{{ route('management.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"  placeholder="Name" name="name">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputPassword3" placeholder="Email" name="email">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword5" placeholder="Password" name="password">
                            @error('password')
                            <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="role">
                                <option value="">select roles</option>
                                <option value="manager">Manager</option>
                                <option value="blogger">Blogger</option>
                                <option value="user">User</option>
                            </select>
                            @error('role')
                            <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- table  --}}

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Manager's Table</h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                               @if (Auth::user()->role == 'admin')
                                 <th>Status</th>
                                 <th>Action</th>
                               @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($managers as $manager)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->index + 1 }}
                                    </th>
                                    <td>{{ $manager->name }}</td>
                                    <td>{{ $manager->role }}</td>
                                    @if (Auth::user()->role == 'admin')

                                    <td>
                                    <form id="herouser{{ $manager->id }}" action="{{ route('management.down',$manager->id) }}" method="POST">
                                        @csrf
                                        <div class="form-check form-switch">
                                            <input onchange="document.querySelector('#herouser{{ $manager->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $manager->role == $manager->role ? 'checked' : '' }}>
                                        </div>
                                    </form>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-info btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{route('manager.delete',$manager->id)}}" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>

</div>
@endsection


@section('script')

@if (session('register_complete'))
    <script>
        Toastify({
        text: "{{ session('register_complete') }}",
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
