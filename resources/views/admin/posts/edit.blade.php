@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Posts</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Post</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.post.save', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="featured_image">Featured Image *</label>
                            <input type="file" id="featured_image" name="featured_image" data-default-file="{{ asset($post->featured_image) }}" class="dropify @error('featured_image') is-invalid @enderror">
                            @error('featured_image')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="blog_category_id">Category *</label>
                            <select name="blog_category_id" id="blog_category_id" class="form-control @error('blog_category_id') is-invalid @enderror">
                                <option value="" disabled selected>Select category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ $post->blog_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('blog_category_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title">Title *</label>
                            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $post->title }}" placeholder="Type Here..." autocomplete="off">
                            @error('title')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug *</label>
                            <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ $post->slug }}" placeholder="Type Here..." autocomplete="off">
                            @error('slug')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="editor" class="form-control">{{ $post->body }}</textarea>
                            @error('body')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags *</label>
                            <input type="text" id="tags" name="tags" class="form-control tags @error('tags') is-invalid @enderror" value="{{ count($post->blog_tags) > 0 ? implode(',' , $post->blog_tags->pluck('name')->toArray()) : '' }}" placeholder="Type Here..." autocomplete="off">
                            @error('tags')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <hr>

                        <div class="form-group">
                            <h4 class="mt-0 header-title">SEO</h4>
                        </div>

                        <div class="form-group">
                            <label for="meta_title">Meta Title *</label>
                            <input type="text" id="meta_title" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ $post->meta_title }}" placeholder="Type Here..." autocomplete="off">
                            @error('meta_title')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords *</label>
                            <input type="text" id="meta_keywords" name="meta_keywords" class="form-control tags @error('meta_keywords') is-invalid @enderror" value="{{ $post->meta_keywords }}" placeholder="Type Here..." autocomplete="off">
                            @error('meta_keywords')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="3" placeholder="Type Here...">{{ $post->meta_description }}</textarea>
                            @error('meta_description')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-purple waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div><!-- container -->
@endsection
@section('js')
    <script>
        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/ /g,'-')
                .replace(/[^\w-]+/g,'')
                ;
        }

        $("#title").keyup(function (e) {
            let elm = $(this);
            $("#slug").val(convertToSlug(elm.val()));
        });
    </script>
@endsection
