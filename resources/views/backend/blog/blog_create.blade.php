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
                            <h4 class="page-title float-left">Dashboard</h4>

                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="{{ url('admin/category-list') }}">Category-list</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Add Category</a></li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-md-8 m-auto">
                        <div class="card-box">
                            <h4 class="m-t-0 m-b-30 header-title text-center">Add Category</h4>
                            <div class="text-center">
                                <a href="{{ url('admin/category-list') }}" class="btn btn-outline-primary"> <i
                                        class="fi-menu"></i> View Category</a>
                            </div>
                            <form role="form" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-layout">
                                    <div class="row mg-b-25">
                                        <div class="col-lg-12">
                                            <div class="form-group mg-b-10-force">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" class="form-control @error('title')is-invalid @enderror" id="title" placeholder="Ex: Web Design" value="{{ old('title') }}">
                                            </div>
                                            @error('title')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mg-b-10-force">
                                                <label for="category">Category</label>
                                                <select name="category_id" id="category_id" class="form-control">
                                                    <option value="">Select One</option>
                                                    @foreach ( $categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('title')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mg-b-10-force">
                                                <label for="thumbnail">Thumbnail</label>
                                                <input type="file" name="thumbnail" class="form-control @error('thumbnail')is-invalid @enderror" id="thumbnail" value="{{ old('thumbnail') }}">
                                            </div>
                                            @error('thumbnail')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mg-b-10-force">
                                                <label for="featured_image">Featured Image</label>
                                                <input type="file" name="featured_image" class="form-control @error('featured_image')is-invalid @enderror" id="featured_image" value="{{ old('featured_image') }}">
                                            </div>
                                            @error('featured_image')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-lable">Featured :</label>
                                                <input type="radio" name="featured" class=" @error('featured')is-invalid @enderror" id="featured" value="2" placeholder="Ex: Web Design">
                                                <label for="featured" class="form-control-lable">Featured</label>
                                                <input type="radio" name="featured" class=" @error('general')is-invalid @enderror" id="general" value="1" placeholder="Ex: Web Design" value="{{ old('general') }}">
                                                <label for="general" class="form-control-lable">General</label>
                                            </div>
                                            @error('featured')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mg-b-10-force">
                                                <label for="keywords">Keywords</label>
                                                <input type="text" name="keywords" class="form-control @error('keywords')is-invalid @enderror" id="keywords">
                                            </div>
                                            @error('keywords')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="summary">Summary</label>
                                                <textarea type="text" name="summary" class="form-control @error('summary')is-invalid @enderror" id="summary" placeholder="Ex: Web Design"></textarea>
                                            </div>
                                            @error('summary')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </form>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
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

@section('footer_js')
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
        var options = {
          filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
          filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
          filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
          filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };

        CKEDITOR.replace('summary', options);
      </script>
@endsection
