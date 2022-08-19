@extends('layouts.front')

@section('title', 'Privacy Policy')

@section('content')

@include('front.components.pages_banner')


            <!-- BLog Start -->
    <section class="section" id="print">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card shadow rounded border-0">
                        <div class="card-body">
                            {!! setting('privacy') !!}

                            <button onclick="printDiv('print')" class="btn btn-soft-primary d-print-none">Print</button>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- END SIDEBAR -->

</section><!--end section-->
@endsection
@section('js')
    <script>
        function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}
    </script>
@endsection
