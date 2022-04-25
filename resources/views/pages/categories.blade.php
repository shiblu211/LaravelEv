@extends('layouts.app')

@section('content')
    <div class="d-flex container" id="wrapper">
    @include('layouts.sidebar')
    <!-- Page Content -->
        <div id="page-content-wrapper" class="col-md-6">
            <div class="container-fluid">
                <h2>Categories</h2>
                <table class="table table-striped table-responsive">
                    <thead>
                    <tr class="text-center">
                        <th>Sl No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach( $categories as $category)
                        <tr class="text-center">
                            <td>{{ $i++ }}</td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <form action="{{route('delete.category',$category)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
@endsection
@push('custom-script')
@endpush
