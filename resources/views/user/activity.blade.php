@extends('layouts.user')

@section('title', 'My Listings')

@section('content')
<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> Recent Activities </h4>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Narration</th>
                            {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format('d/m/y') }}</td>
                                    @if($item->logable_type == 'App\Models\Order')
                                        <td><img style="width: 50px; height: 50px" src="{{ asset( $item->logable->listing->featured_image) }}"></td>
                                        <td>{{ $item->logable->listing->title }}</td>
                                    @else
                                        <td><img style="width: 50px; height: 50px" src="{{ asset( $item->logable->featured_image) }}"></td>
                                        <td>{{ $item->logable->title }}</td>
                                    @endif
                                    <td>{{ $item->narration }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $list->links() !!}
                    </div>
                </div>
            </div>

          {{-- <div class="card-footer text-right">
            <nav class="d-inline-block">
              <ul class="pagination mb-0">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                <li class="page-item">
                  <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                </li>
              </ul>
            </nav>
          </div> --}}
        </div>
      </div>
</div>
@endsection
