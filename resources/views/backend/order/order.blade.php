@extends('backend.master')
@section('order_active')
    active
@endsection
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title float-left">Dashboard</h4>

                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="{{ url('admin/category-list') }}">Order List</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Add Order</a></li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-md-12 text-right">
                        <div>
                            <form action="{{ route('OrderSearch') }}" method="get">
                                @csrf
                                <label for="start">Start Date:</label>
                                <input type="date" name="start">
                                <label for="end">End Date:</label>
                                <input type="date" name="end">
                                <input type="submit" value="search">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card-box">
                            {{-- <h2 class="m-t-0 header-title text-center">Total order({{ $count }})</h2> --}}
                            {{-- Suceess Message --}}
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            {{-- Error Message --}}
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            {{-- <form action="" method="POST"> --}}
                                {{-- @csrf --}}
                                <label for="checkAll">Select All</label>
                                <table class="table">
                                    <thead class="thead-default">
                                    <tr>
                                        <th>
                                            <label class="form-check-label mg-b-0">
                                                <input type="checkbox" id="checkAll"><span></span>
                                            </label>
                                        </th>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Created</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)

                                        <tr
                                        @if ( $order->ending_time < date('Y-m-d') )
                                        style=" color:red "
                                        @endif

                                        class="color">
                                            <td class="valign-center">
                                                <label class="form-check-label mg-b-0">
                                                    <input type="checkbox" id="checkAll" name="coupon_id[]" value=""><span></span>
                                                </label>
                                            </td>
                                            <td scope="row">{{ $orders->firstItem() + $key }}</td>
                                            {{-- fastitem function or method ti akhane kaj korbe jodi amar pagination use kori tokhon --}}
                                            <td>{{ $order->product->title ?? "N/A" }}</td>
                                            <td>{{ $order->color->color_name ?? "N/A" }}</td>
                                            <td>{{ $order->size->size_name ?? "N/A" }}</td>
                                            <td>{{ $order->product_price }}</td>
                                            <td>{{ $order->product_quantity }}</td>
                                            <td>{{ $order->created_at != null ? $order->created_at->diffForHumans() : 'N/A' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('couponEdit', $order->id ) }}" class="btn btn-outline-primary rounded-5">Edit</a>
                                                <a href="" class="btn btn-outline-danger rounded-5">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $orders->links() }}
                                {{-- Pagination Button Show korbe --}}
                                <button class="btn btn-danger">Delete All</button>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>

            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            2021 © milon. - codermilon.com
        </footer>

    </div>
@endsection
