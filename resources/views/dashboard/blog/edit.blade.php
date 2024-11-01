@extends('layouts.dashboard_master')

@section('content')


<x-breadcum omor="Blog's Create Page"></x-breadcum>


<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Blog Update form</h4>

                <form role="form" action="{{ route('blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Categories</label>
                        <div class="col-sm-9">
                            <select class="form-control" data-toggle="select2" name="category_id">
                                <option>Select</option>
                                <optgroup label="{{ env('APP_SLOGAN') }}">
                                   @foreach ($categories as $cat)
                                     <option {{ $cat->id == $blog->category_id ? 'selected' : '' }} value="{{ $cat->id }}">{{ $cat->title }}</option>
                                   @endforeach
                                </optgroup>
                            </select>
                        </div>
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Blog Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputEmail3" placeholder="Title" name="title" value="{{ $blog->title }}">
                        </div>
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Blog Slug</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputPassword3" placeholder="Slug" name="slug" value="{{ $blog->slug }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Blog Short Description</label>
                        <div class="col-sm-9">
                            <textarea id="shortNote" type="text" class="form-control @error('short_description') is-invalid @enderror" name="short_description">{{ $blog->short_description }}</textarea>
                        </div>
                        @error('short_description')
                        <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Blog Description</label>
                        <div class="col-sm-9">
                            <textarea id="longNote" type="text" class="form-control @error('description') is-invalid @enderror" name="description">{{ $blog->description }}</textarea>
                        </div>
                        @error('description')
                        <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-9">
                            <img id="heloalam" src="{{ asset('uploads/blog') }}/{{ $blog->thumbnail }}" style="width:100%; height:200px; object-fit:contain;">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Blog Thumbnail</label>
                        <div class="col-sm-9">
                            <input type="file" onchange="document.querySelector('#heloalam').src = window.URL.createObjectURL(this.files[0])" class="form-control @error('thumbnail') is-invalid @enderror" id="inputPassword5" name="thumbnail">
                        </div>
                        @error('thumbnail')
                        <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection



@section('script')

<script>
    tinymce.init({
      selector: '#shortNote',
      plugins: [
        // Core editing features
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Oct 3, 2024:
        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      ],
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
  </script>


<script>
    tinymce.init({
      selector: '#longNote',
      plugins: [
        // Core editing features
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Oct 3, 2024:
        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      ],
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
  </script>

@endsection
