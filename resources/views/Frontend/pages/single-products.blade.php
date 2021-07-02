@extends('frontend.frontend-master')
@section('title'){{ $singleProducts->title }}@endsection
@section('meta_desc'){{ Str::limit($singleProducts->summary, '160') }}@endsection
@section('content')
        <!-- .breadcumb-area start -->
        <div class="breadcumb-area bg-img-4 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcumb-wrap text-center">
                            <h2>Shop Page</h2>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><span>Shop</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .breadcumb-area end -->
        <!-- single-product-area start-->
        <div class="single-product-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-single-img">
                            <div class="product-active owl-carousel">
                                <div class="item">
                                    <img src="{{ asset('images/'.$singleProducts->created_at->format('Y/m/').$singleProducts->id.'/'.$singleProducts->product_thumbnail) }}" alt="{{ $singleProducts->title }}">
                                </div>
                                @foreach ($singleProducts->ProductGallery as $proGalActive)
                                    <div class="item">
                                        <img src="{{ asset('images/product-gallery/'.$proGalActive->created_at->format('Y/m/').$proGalActive->product_id.'/'.$proGalActive->image_name) }}" alt="{{ $singleProducts->title }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="product-thumbnil-active  owl-carousel">
                                <div class="item">
                                    <img src="{{ asset('images/'.$singleProducts->created_at->format('Y/m/').$singleProducts->id.'/'.$singleProducts->product_thumbnail) }}" alt="{{ $singleProducts->title }}">
                                </div>
                                @foreach ($singleProducts->ProductGallery as $proThumbActive)
                                    <div class="item">
                                        <img src="{{ asset('images/product-gallery/'.$proThumbActive->created_at->format('Y/m/').$proThumbActive->product_id.'/'.$proThumbActive->image_name) }}" alt="{{ $singleProducts->title }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-single-content">
                            <h3>{{ $singleProducts->title }}</h3>
                            <div class="rating-wrap fix">
                                <span class="pull-left priceOfSize">${{ $singleProducts->product_price }}</span>
                                <ul class="rating pull-right">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li>(05 Customar Review)</li>
                                </ul>
                            </div>
                            <p>{{ $singleProducts->summary }}</p>

                            <form action="{{ route('productCart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $singleProducts->id }}">
                                <ul class="cetagory">
                                    <li>Categories:</li>
                                    <li><a href="#">{{ $singleProducts->category->category_name }}</a></li>
                                </ul>
                                {{-- Product Color Variation --}}
                                <div class="form-group">
                                    <label for="color">Select Color: </label>
                                    <select class="form-control" name="color" id="color">
                                        <option value="">Select Color</option>
                                        @foreach ( $groupByColor as $key => $data)
                                        <option data-product="{{ $data[0]->product_id }}" value="{{ $data[0]->color_id }}">{{ $data[0]->Color->color_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Product Size Variation --}}
                                <div class="form-group">
                                    <label for="size">Product Size:</label>
                                    <select name="size" id="size" class="form-control @error('size') is-invalid @enderror">
                                    </select>
                                    @error('size')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>

                                {{-- <ul class="Color">
                                    <li>Color:</li>
                                    <li>
                                    @foreach ( $groupByColor as $data)
                                        <input type="radio" data-product="{{ $data[0]->product_id }}" class="color_id" name="color_id" id="color_id{{ $data[0]->id }}" value="{{ $data[0]->color_id }}">
                                        <label for="color_id{{ $data[0]->id }}">{{ $data[0]->Color->color_name }}</label>
                                    @endforeach
                                    </li>
                                    @error('color_id')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </ul> --}}

                                {{-- <ul class="Size">
                                    <li id="sizeadd">
                                    </li>
                                    @error('size_id')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </ul> --}}

                                <ul class="cetagory">
                                    <li>
                                        <span class="availableQuantity text-success">{{ 'Total Available Quanity: '.$singleProducts->ProductAttribute->sum('quantity') }}</span>
                                    </li>
                                </ul>
                                <ul class="input-style">
                                    <li class="quantity cart-plus-minus">
                                        <input type="text" name="quantity" value="1" />
                                        <div class="dec qtybutton qtyMinus">-</div>
                                        <div class="inc qtybutton qtyPlus">+</div>
                                    </li>
                                    <li><button type="submit" class="btn btn-danger ml-4">Add to Cart</button></li>
                                </ul>
                            </form>

                            <ul class="socil-icon">
                                <li>Share :</li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mt-60">
                    <div class="col-12">
                        <div class="single-product-menu">
                            <ul class="nav">
                                <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                                <li><a data-toggle="tab" href="#tag">Faq</a></li>
                                <li><a data-toggle="tab" href="#review">Review</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="tab-content">
                            <div class="tab-pane active" id="description">
                                <div class="description-wrap">
                                    <p>{{ $singleProducts->description }}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tag">
                                <div class="faq-wrap" id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5><button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">General Inquiries ?</button> </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How To Use ?</button></h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Shipping & Delivery ?</button></h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingfour">
                                            <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">Additional Information ?</button></h5>
                                        </div>
                                        <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingfive">
                                            <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">Return Policy ?</button></h5>
                                        </div>
                                        <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="review">
                                <div class="review-wrap">
                                    <ul>
                                        <li class="review-items">
                                            <div class="review-img">
                                                <img src="assets/images/comment/1.png" alt="">
                                            </div>
                                            <div class="review-content">
                                                <h3><a href="#">GERALD BARNES</a></h3>
                                                <span>27 Jun, 2019 at 2:30pm</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="review-items">
                                            <div class="review-img">
                                                <img src="assets/images/comment/2.png" alt="">
                                            </div>
                                            <div class="review-content">
                                                <h3><a href="#">Olive Oil</a></h3>
                                                <span>15 may, 2019 at 2:30pm</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-half-o"></i></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="review-items">
                                            <div class="review-img">
                                                <img src="assets/images/comment/3.png" alt="">
                                            </div>
                                            <div class="review-content">
                                                <h3><a href="#">Nature Honey</a></h3>
                                                <span>14 janu, 2019 at 2:30pm</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="add-review">
                                    <h4>Add A Review</h4>
                                    <div class="ratting-wrap">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>task</th>
                                                    <th>1 Star</th>
                                                    <th>2 Star</th>
                                                    <th>3 Star</th>
                                                    <th>4 Star</th>
                                                    <th>5 Star</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>How Many Stars?</td>
                                                    <td>
                                                        <input type="radio" name="a" />
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="a" />
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="a" />
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="a" />
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="a" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <h4>Name:</h4>
                                            <input type="text" placeholder="Your name here..." />
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <h4>Email:</h4>
                                            <input type="email" placeholder="Your Email here..." />
                                        </div>
                                        <div class="col-12">
                                            <h4>Your Review:</h4>
                                            <textarea name="massage" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn-style">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single-product-area end-->
        <!-- featured-product-area start -->
        <div class="featured-product-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-left">
                            <h2>Related Product</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="featured-product-wrap">
                            <div class="featured-product-img">
                                <img src="assets/images/product/1.jpg" alt="">
                            </div>
                            <div class="featured-product-content">
                                <div class="row">
                                    <div class="col-7">
                                        <h3><a href="shop.html">Nature Honey</a></h3>
                                        <p>$219.56</p>
                                    </div>
                                    <div class="col-5 text-right">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="featured-product-wrap">
                            <div class="featured-product-img">
                                <img src="assets/images/product/2.jpg" alt="">
                            </div>
                            <div class="featured-product-content">
                                <div class="row">
                                    <div class="col-7">
                                        <h3><a href="shop.html">Olive Oil</a></h3>
                                        <p>$354.75</p>
                                    </div>
                                    <div class="col-5 text-right">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="featured-product-wrap">
                            <div class="featured-product-img">
                                <img src="assets/images/product/3.jpg" alt="">
                            </div>
                            <div class="featured-product-content">
                                <div class="row">
                                    <div class="col-7">
                                        <h3><a href="shop.html">Sunrise Oil</a></h3>
                                        <p>$214.80</p>
                                    </div>
                                    <div class="col-5 text-right">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="featured-product-wrap">
                            <div class="featured-product-img">
                                <img src="assets/images/product/4.jpg" alt="">
                            </div>
                            <div class="featured-product-content">
                                <div class="row">
                                    <div class="col-7">
                                        <h3><a href="shop.html">Coconut Oil</a></h3>
                                        <p>$241.00</p>
                                    </div>
                                    <div class="col-5 text-right">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- featured-product-area end -->
@endsection
@section('footer_js')
        <script>
            // Show The Size According to Product color and Size.
            $('#color').change(function(){
                let colorId = $(this).val();
                let productId = $(this).find(':selected').attr('data-product');
                // alert(productId);
                if(colorId){
                    $.ajax({
                        type: 'GET',
                        url: "{{ url('/get-product-size-2') }}/"+colorId+'/'+productId,
                        success: function(result){
                            if(result){
                                $('#size').empty();
                                $('#size').append('<option value="">Select Size</option>');
                                $.each(result, function(key, value){
                                    $('#size').append('<option name="size_id" class="sizecheck" id="size" data-quantity="'+value.quantity+'" data-price="'+value.price+'" value="'+value.size_id+'">'+value.size_id+'</option>');
                                })

                                $('#size').change(function(){
                                    let price = $(this).find(':selected').attr('data-price');
                                    let quantity = $(this).find(':selected').attr('data-quantity');

                                    $('.priceOfSize').html('$'+price);
                                    $('.availableQuantity').html('Total Available Quanity: '+quantity);
                                })
                            }else{
                                $('#size').empty();
                            }
                        }
                    })
                }
            })

            // $('.color_id').change(function(){
            //     let colorId = $(this).val();
            //     let productId = $(this).attr('data-product');
            //     $.ajax({
            //         type: 'GET',
            //         url: "{{ url('/get-product-size') }}/"+colorId+'/'+productId,
            //         success:function(response_result){
            //             if(response_result){
            //                 $('#sizeadd').empty();
            //                 $('.availableQuantity').empty();
            //                 $('#sizeadd').append('Size: ');
            //                 $.each(response_result, function(key, value){
            //                     $('#sizeadd').append('<input type="radio" data-quantity="'+value.quantity+'" data-price="'+value.price+'" name="size_id" class="sizecheck" id="size" value="'+value.size_id+'"><label class="pr-3">'+value.size_id+'</label>')
            //                 })

            //                 $('.sizecheck').change(function(){
            //                     let price = $(this).attr('data-price');
            //                     let quantity = $(this).attr('data-quantity');
            //                     $('.priceOfSize').html('$'+price);
            //                     $('.availableQuantity').html('Total Available Quanity: '+quantity);
            //                 })
            //             }

            //         }
            //     })
            // })

            // Show The Size According to Product color and Size.

            /*-----------------------
            cart-plus-minus-button
            -------------------------*/
            $(".qtybutton").on("click", function() {
                var $button = $(this);
                var oldValue = $button.parent().find("input").val();
                if ($button.text() == "+") {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below zero
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }
                $button.parent().find("input").val(newVal);
            });

        </script>
@endsection

