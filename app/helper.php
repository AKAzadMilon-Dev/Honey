<?php

    use App\Models\Cart;
    use Illuminate\Support\Facades\Cookie;

    function cart(){
        $oldCookie = Cookie::get('cookie_id');
        return $carts = Cart::where('cookie_id', $oldCookie)->get();
    }




?>
