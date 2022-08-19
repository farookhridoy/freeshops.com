@extends('layouts.front')

@section('title', 'Blogs')

@section('content')

@include('front.components.pages_banner')

<section class="section">
    <div class="container">
        <div class="row">
            <!-- BLog Start -->
            <div class="col-lg-8 col-md-6">
                <div class="row">
                    @foreach ($blogs as $item)
                        <div class="col-lg-6 col-md-12 mb-4 pb-2">
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


                    <!-- PAGINATION START -->
                    <div class="col-12">
                        {{ $blogs->links() }}
                    </div><!--end col-->
                    <!-- PAGINATION END -->
                </div><!--end row-->
            </div><!--end col-->
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
