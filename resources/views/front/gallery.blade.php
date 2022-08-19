@extends('layouts.front')

@section('title', 'Video Gallery')

@section('content')

@include('front.components.pages_banner')


            <!-- BLog Start -->
    <section class="section" >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card shadow rounded border-0">
                        <div class="card-body">
                            <section class="section">

                                <h5 class="card-title">Tutorial Videos</h5>
                                @foreach($list as $item)
                                    <div class="accordion mt-4 pt-2" id="payquestion{{ $item->id }}">
                                        <div class="accordion-item rounded">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button border-0 bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $item->id }}"
                                                    aria-expanded="true" aria-controls="collapseOne{{ $item->id }}">
                                                    {{ $item->name }}
                                                </button>
                                            </h2>
                                            <div id="collapseOne{{ $item->id }}" class="accordion-collapse border-0 collapse " aria-labelledby="headingOne"
                                                data-bs-parent="#payquestion{{ $item->id }}">
                                                <div class="accordion-body text-muted bg-white">
                                                    <video class="w-100 rounded" controls="" loop="">
                                                        <source src="{{ asset($item->video)}}" type="video/mp4">
                                                    </video>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                                        <!--end container-->
                            </section><!--end section-->
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- END SIDEBAR -->

</section><!--end section-->
@endsection

