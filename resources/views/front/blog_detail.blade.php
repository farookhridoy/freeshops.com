@extends('layouts.front')

@section('title', $blog->title)

@section('og')
    <meta property="og:title" content="{{ $blog->title }}">
    <meta property="og:description" content="{{ $blog->meta_description }}">
    <meta property="og:image" content="{{ asset($blog->featured_image) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="{{ asset($blog->featured_image) }}">

    <meta property="og:site_name" content="{{ $blog->title }}">
    <meta name="twitter:image:alt" content="{{ $blog->title }}">
@endsection

@section('content')

@include('front.components.pages_banner')

<section class="section">
    <div class="container">
        <div class="row">
            <!-- BLog Start -->
            <div class="col-lg-8 col-md-6">
                <div class="card blog blog-detail border-0 shadow rounded">
                    <img src="{{ asset($blog->featured_image) }}" class="img-fluid rounded-top" alt="">
                    <div class="card-body content">
                        <h6 class="mb-3">
                            <i class="mdi mdi-tag text-primary me-1"></i>
                            @foreach ($blog->blog_tags as $item)
                                <a href="javscript:void(0)" class="text-primary">{{ $item->name }}</a>@if(!$loop->last),@endif
                            @endforeach
                        </h6>
                        <div class="body-content">
                            {!! $blog->body !!}
                        </div>
                        <div class="post-meta mt-3">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item me-2 mb-0"><a href="javascript:void(0)" class="text-muted like"><i class="uil uil-eye me-1"></i>33</a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted comments"><i class="uil uil-comment me-1"></i>{{ $blog->blog_comments()->whereStatus(true)->count() }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card shadow rounded border-0 mt-4">
                    <div class="card-body">
                        <!-- SOCIAL -->
                        <div class="widget">
                            <h5 class="widget-title">Share</h5>
                            <ul class="list-unstyled social-icon mb-0 mt-2">
                                <li class="list-inline-item"><a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}" target="_blank" class="rounded"><i data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" target="_blank" class="rounded"><i data-feather="twitter" class="fea icon-sm fea-social"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" target="_blank" class="rounded"><i data-feather="linkedin" class="fea icon-sm fea-social"></i></a></li>
                            </ul><!--end icon-->
                        </div>
                        <!-- SOCIAL -->
                    </div>
                </div>

                @if ($blog->blog_comments()->whereStatus(true)->count() > 0)
                    <div class="card shadow rounded border-0 mt-4">
                        <div class="card-body">
                            <h5 class="card-title mb-0">Comments :</h5>

                            <ul class="media-list list-unstyled mb-0">
                                @foreach ($blog->blog_comments()->whereStatus(true)->get() as $item)
                                    <li class="mt-4">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <a class="pe-3" href="#">
                                                    <img src="{{ asset('default.png') }}" class="img-fluid avatar avatar-md-sm rounded-circle shadow" alt="img">
                                                </a>
                                                <div class="commentor-detail">
                                                    <h6 class="mb-0"><a href="javascript:void(0)" class="text-dark media-heading">{{ $item->name }}</a></h6>
                                                    <small class="text-muted">{{ $item->created_at->format('d M, Y H:i a') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-muted fst-italic p-3 bg-light rounded">" {{ $item->comment }} "</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="card shadow rounded border-0 mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Leave A Comment :</h5>

                        <form class="mt-3 comment-form" action="{{ route('post.comment', $blog->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Your Comment</label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="message-circle" class="fea icon-sm icons"></i>
                                            <textarea id="comment" placeholder="Your Comment" rows="5" name="comment" class="form-control ps-5" required=""></textarea>
                                        </div>
                                    </div>
                                </div><!--end col-->

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                            <input id="name" name="name" type="text" placeholder="Name" class="form-control ps-5" required="">
                                        </div>
                                    </div>
                                </div><!--end col-->

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <i data-feather="mail" class="fea icon-sm icons"></i>
                                            <input id="email" type="email" placeholder="Email" name="email" class="form-control ps-5" required="">
                                        </div>
                                    </div>
                                </div><!--end col-->

                                <div class="col-md-12">
                                    <div class="send d-grid">
                                        <button type="submit" class="btn btn-primary">Send Message</button>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </form><!--end form-->
                    </div>
                </div>

                <div class="card shadow rounded border-0 mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Related Posts :</h5>

                        <div class="row">
                            @foreach ($related as $item)
                                <div class="col-lg-6 mt-4 pt-2">
                                    <div class="card blog rounded border-0 shadow">
                                        <div class="position-relative blog-card-image">
                                            <img src="{{ asset($item->featured_image) }}" class="card-img-top rounded-top" alt="...">
                                        <div class="overlay rounded-top bg-dark"></div>
                                        </div>
                                        <div class="card-body content">
                                            <h5><a href="{{ route('blog', $item->slug) }}" class="card-title title text-dark">{{ Str::limit($item->title, 60, '...') }}</a></h5>
                                            <div class="post-meta d-flex justify-content-between mt-3">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="list-inline-item me-2 mb-0"><a href="javascript:void(0)" class="text-muted like"><i class="uil uil-eye me-1"></i>33</a></li>
                                                    <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted comments"><i class="uil uil-comment me-1"></i>{{ $item->blog_comments()->whereStatus(true)->count() }}</a></li>
                                                </ul>
                                                <a href="{{ route('blog', $item->slug) }}" class="text-muted readmore">Read More <i class="uil uil-angle-right-b align-middle"></i></a>
                                            </div>
                                        </div>
                                        <div class="author">
                                            <small class="text-light user d-block"><i class="uil uil-user"></i> {{ $item->user->name }}</small>
                                            <small class="text-light date"><i class="uil uil-calendar-alt"></i> {{ $item->created_at->format('d M, Y') }}</small>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            @endforeach
                        </div><!--end row-->
                    </div>
                </div>
            </div>
            <!-- BLog End -->

            <!-- START SIDEBAR -->
            <div class="col-lg-4 col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="card border-0 sidebar sticky-bar rounded shadow">
                    <div class="card-body">

                        <!-- Categories -->
                        <div class="widget mb-4 pb-2">
                            <h5 class="widget-title">Categories</h5>
                            <ul class="list-unstyled mt-4 mb-0 blog-categories">
                                @foreach ($categories as $item)
                                    <li><a href="{{ route('blog.category', $item->slug) }}">{{ $item->name }}</a> <span class="float-end">{{ $item->blog_posts_count }}</span></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Categories -->

                        <!-- RECENT POST -->
                        <div class="widget mb-4 pb-2">
                            <h5 class="widget-title">Recent Post</h5>
                            <div class="mt-4">
                                @foreach ($recent as $item)
                                    <div class="clearfix post-recent">
                                        <div class="post-recent-thumb float-start"> <a href="{{ route('blog', $item->slug) }}"> <img alt="img" src="{{ asset($item->featured_image) }}" class="img-fluid rounded"></a></div>
                                        <div class="post-recent-content float-start"><a href="{{ route('blog', $item->slug) }}">{{ Str::limit($item->title, 25, '...') }}</a><span class="text-muted mt-2">{{ $item->created_at->format('d M, Y') }}</span></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- RECENT POST -->

                        <!-- TAG CLOUDS -->
                        <div class="widget mb-4 pb-2">
                            <h5 class="widget-title">Tags Cloud</h5>
                            <div class="tagcloud mt-4">
                                @foreach ($tags as $item)
                                    <a href="jvascript:void(0)" class="rounded">{{ $item->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <!-- TAG CLOUDS -->


                    </div>
                </div>
            </div><!--end col-->
            <!-- END SIDEBAR -->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $(".body-content p").addClass('text-muted');
            $(".body-content li").addClass('text-muted');
            $(".body-content img").addClass('img-fluid');
        });

        $(".comment-form").submit(function (e) {
            e.preventDefault();
            let form = $(this);

            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    if (response.statusCode == 200) {
                        Swal.fire({
                            title: 'Congratulations!',
                            text: response.message,
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok!'
                        });
                    } else {
                        Swal.fire({
                            title: 'Woops!',
                            text: response.message,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok!'
                        });
                    }

                    form.find('input,textarea').val("");
                }
            });
        });
    </script>
@endsection
