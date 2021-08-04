@extends('backend.master')

@section('blog_active')
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
                            <h4 class="page-title float-left">Blog</h4>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Deshboard</a></li>
                                <li class="breadcrumb-item"><a>Blog List</a></li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <!-- end row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h2 class="m-t-0 header-title text-center">Total Bloh</h2>
                            <div class="text-center">
                                <a href="{{ route('blog.create') }}" class="btn btn-outline-primary mb-3"> <i class="fi-plus"></i> Add Blog</a>
                            </div>
                            {{-- Message Success --}}
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            {{-- Message Error --}}
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <form action="{{ route('CategorySelectedDelete') }}" method="POST">
                                @csrf
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
                                        <th>Title</th>
                                        <th>Thumbnail</th>
                                        <th>Views</th>
                                        <th width="400">Summary</th>
                                        <th width="180" class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $key => $blog)
                                        <tr>
                                            <td class="valign-center">
                                                <label class="form-check-label mg-b-0">
                                                    @if ($blog->id != 1)
                                                    <input type="checkbox" id="checkAll" name="cat_id[]" value="{{ $blog->id }}"><span></span>
                                                    @endif
                                                </label>
                                            </td>
                                            <td scope="row">{{ $blogs->firstitem() + $key }}</td>
                                            {{-- fastitem function or method ti akhane kaj korbe jodi amar pagination use kori tokhon --}}
                                            <td>{{ $blog->title }}</td>
                                            <td><a href="{{ asset('thumbnail/'.$blog->created_at->format('Y/m/').$blog->id.'/'.$blog->thumbnail) }}" download ><img width="100px" src="{{ asset('thumbnail/'.$blog->created_at->format('Y/m/').$blog->id.'/'.$blog->thumbnail) }}" alt=""></a></td>
                                            <td>{{ $blog->views }}</td>
                                            <td>{!! Str::words($blog->summary,30) !!}</td>
                                            <td class="text-center">
                                                @if ($blog->id == 1)
                                                <button class="btn btn-danger" disabled >Not Allow</button>
                                                @else
                                                <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-outline-primary rounded-5">Edit</a>
                                                <a href="{{ url('admin/category-delete') }}/{{ $blog->id }}" class="btn btn-outline-danger rounded-5">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $blogs->links() }}
                                {{-- Pagination Button Show korbe --}}
                                <button class="btn btn-danger">Delete All</button>
                            </form>
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
