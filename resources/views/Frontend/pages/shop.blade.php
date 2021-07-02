@extends('frontend.frontend-master')
@section('title')
{{ __('shop Page') }}
@endsection
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
    <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="product-menu">
                        <ul class="nav justify-content-center">
                            <li>
                                <a class="active" data-toggle="tab" href="#all">All product</a>
                            </li>
                            @foreach ($categories as $catItems)
                                <li class="mb-2">
                                    <a data-toggle="tab" href="#chair{{ $catItems->id }}">{{ $catItems->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">
                        @foreach ($products as $productsItem)
                            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                <div class="product-wrap">
                                    <div class="product-img">
                                        <span>Sale</span>
                                        <img src="{{ asset('images/'.$productsItem->created_at->format('Y/m/').$productsItem->id.'/'.$productsItem->product_thumbnail ) }}" alt="{{ $productsItem->title }}">
                                        <div class="product-icon flex-style">
                                            <ul>
                                                {{-- Product View --}}
                                                <li><a data-toggle="modal" data-target="#allModal{{ $productsItem->id }}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                                {{-- Add to wishlist --}}
                                                <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                {{-- Add to cart modal view --}}
                                                <li><a data-toggle="modal" data-target="#allModal{{ $productsItem->id }}" href="javascript:void(0);"><i class="fa fa-shopping-bag"></i></a></li>
                                                {{-- <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{ route('singleProduct', $productsItem->slug ) }}">{{ $productsItem->title }}</a></h3>
                                        <p class="pull-left">${{ $productsItem->product_price }}</p>
                                        <ul class="pull-right d-flex">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-half-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- Modal area start -->
                                <div class="modal fade" id="allModal{{ $productsItem->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="modal-body d-flex">
                                                <div class="product-single-img w-50">
                                                    <img src="{{ asset('images/'.$productsItem->created_at->format('Y/m/').$productsItem->id.'/'.$productsItem->product_thumbnail) }}" alt="{{ $productsItem->title }}">
                                                </div>
                                                <div class="product-single-content w-50">
                                            <h3>{{ $productsItem->title }}</h3>
                                                    <div class="rating-wrap fix">
                                                        <span class="pull-left priceOfSize">${{ $productsItem->product_price }}</span>
                                                        <ul class="rating pull-right">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li>(05 Customar Review)</li>
                                                        </ul>
                                                    </div>
                                                    <p>{{ $productsItem->summary }}</p>

                                                    <form action="{{ route('productCartFromModel') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $productsItem->id }}">
                                                        {{-- Color Group By Color_id --}}
                                                        <ul class="color">
                                                            @php
                                                                $productAttri = App\Models\ProductAttribute::with('Color', 'Size')->where('product_id', $productsItem->id)->get();
                                                                $collect = collect($productAttri);
                                                                $groupby = $collect->groupBy('color_id');
                                                            @endphp

                                                            <li>Color:</li>
                                                            @foreach ( $groupby as $item)
                                                                <input type="radio" data-product="{{ $productsItem->id }}" name="color_id" class="color_id" id="color_id{{ $item[0]->id }}" value="{{ $item[0]->color_id }}"><label for="color_id{{ $item[0]->id }}">{{ $item[0]->Color->color_name }}</label>
                                                            @endforeach
                                                        </ul>

                                                        <ul class="Size">
                                                            <li class="sizeadd"></li>
                                                            @error('size_id')
                                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                            @enderror
                                                        </ul>

                                                        <ul class="availablequantity">
                                                            <li>
                                                                <span class="availableQuantity text-success">{{ 'Total Available Quanity: '.$productsItem->ProductAttribute->sum('quantity') }}</span>
                                                            </li>
                                                        </ul>

                                                        <ul class="input-style">
                                                            <li class="quantity cart-plus-minus">
                                                                <input type="text" name="quantity" value="1" />
                                                                <div class="dec qtybutton qtyMinus">-</div>
                                                                <div class="inc qtybutton qtyPlus">+</div>
                                                            </li>
                                                            <li><input class="btn btn-danger" type="submit" value="Add to Cart"></li>
                                                        </ul>

                                                    </form>

                                                    <ul class="cetagory">
                                                        <li>Categories:</li>
                                                        <li><a href="#">{{ $productsItem->Category->category_name }}</a></li>
                                                        <li><a href="#">{{ $productsItem->SubCategory->subcategory_name ?? '' }}</a></li>
                                                    </ul>

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
                                    </div>
                                </div>
                        <!-- Modal area start -->
                        @endforeach
                    </ul>
                </div>
                @foreach ($categories as $catItems)
                    <div class="tab-pane" id="chair{{ $catItems->id }}">
                        <ul class="row">
                            @foreach ($catItems->Product as $pitem)
                                <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <div class="product-wrap">
                                        <div class="product-img">
                                            <span>Sale</span>
                                            <img src="{{ asset('images/'.$pitem->created_at->format('Y/m/').$pitem->id.'/'.$pitem->product_thumbnail ) }}" alt="{{ $pitem->title }}">
                                            <div class="product-icon flex-style">
                                                <ul>
                                                    <li><a data-toggle="modal" data-target="#exampleModalCenter{{ $pitem->id }}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                    <li><a data-toggle="modal" data-target="#exampleModalCenter{{ $pitem->id }}" href="javascript:void(0);"><i class="fa fa-shopping-bag"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3><a href="{{ route('singleProduct', $pitem->slug) }}">{{ $pitem->title }}</a></h3>
                                            <p class="pull-left">${{ $pitem->product_price }}</p>
                                            <ul class="pull-right d-flex">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-half-o"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <!-- Modal area start -->
                                <div class="modal fade" id="exampleModalCenter{{ $pitem->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="modal-body d-flex">
                                                <div class="product-single-img w-50">
                                                    <img src="{{ asset('images/'.$pitem->created_at->format('Y/m/').$pitem->id.'/'.$pitem->product_thumbnail) }}" alt="{{ $pitem->title }}">
                                                </div>
                                                <div class="product-single-content w-50">
                                            <h3>{{ $pitem->title }}</h3>
                                                    <div class="rating-wrap fix">
                                                        <span class="pull-left priceOfSize">${{ $pitem->product_price }}</span>
                                                        <ul class="rating pull-right">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li>(05 Customar Review)</li>
                                                        </ul>
                                                    </div>
                                                    <p>{{ $pitem->summary }}</p>

                                                    <form action="{{ route('productCartFromModel') }}" method="post">

                                                        {{-- Color Group By Color_id --}}
                                                        <ul class="color">
                                                            @php
                                                                $productAttri = App\Models\ProductAttribute::with(['Color'])->where('product_id', $pitem->id)->get();
                                                                $collect = collect($productAttri);
                                                                $groupby = $collect->groupBy('color_id');
                                                            @endphp

                                                            <li>Color:</li>
                                                            @foreach ( $groupby as $item)
                                                                <input type="radio" data-product="{{ $pitem->id }}" name="color_id" class="color_id" id="color_id{{ $item[0]->id }}" value="{{ $item[0]->color_id }}"><label for="color_id{{ $item[0]->id }}">{{ $item[0]->Color->color_name }}</label>
                                                            @endforeach
                                                        </ul>

                                                        <ul class="Size">
                                                            <li class="sizeadd"></li>
                                                            @error('size_id')
                                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                            @enderror
                                                        </ul>

                                                        <ul class="availablequantity">
                                                            <li>
                                                                <span class="availableQuantity text-success">{{ 'Total Available Quanity: '.$pitem->ProductAttribute->sum('quantity') }}</span>
                                                            </li>
                                                        </ul>

                                                        <ul class="input-style">
                                                            <li class="quantity cart-plus-minus">
                                                                <input type="text" name="quantity" value="1" />
                                                                <div class="dec qtybutton qtyMinus">-</div>
                                                                <div class="inc qtybutton qtyPlus">+</div>
                                                            </li>
                                                            <li><input class="btn btn-danger" type="submit" value="Add to Cart"></li>
                                                        </ul>

                                                    </form>
                                                    <ul class="cetagory">
                                                        <li>Categories:</li>
                                                        <li><a href="#">{{ $pitem->Category->category_name }}</a></li>
                                                        <li><a href="#">{{ $pitem->SubCategory->subcategory_name ?? '' }}</a></li>
                                                    </ul>
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
                                    </div>
                                </div>
                                <!-- Modal area start -->
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- product-area end -->
@endsection
@section('footer_js')
        <script>

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

            $('.color_id').change(function(){
                let colorId = $(this).val();
                let productId = $(this).attr('data-product');
                // alert(productId);
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/get-product-size') }}/"+colorId+'/'+productId,
                    success:function(response_result){
                        if(response_result){
                            $('.sizeadd').empty();
                            $('.availableQuantity').empty();
                            $('.sizeadd').append('Size: ');
                            $.each(response_result, function(key, value){
                                $('.sizeadd').append('<input type="radio" data-quantity="'+value.quantity+'" data-price="'+value.price+'" name="size_id" class="sizecheck" id="size" value="'+value.size_id+'"><label class="pr-3">'+value.size_id+'</label>')
                            })

                            $('.sizecheck').change(function(){
                                let price = $(this).attr('data-price');
                                let quantity = $(this).attr('data-quantity');
                                $('.priceOfSize').html('$'+price);
                                $('.availableQuantity').html('Total Available Quanity: '+quantity);
                            })
                        }else{
                            $('.sizeadd').empty();
                            $('.availableQuantity').empty();
                        }
                    }
                })
            })

        </script>
@endsection
