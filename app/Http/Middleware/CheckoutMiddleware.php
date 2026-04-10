<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('checkout_in_progress')) {
            $allowedRoutes = [
                'cart.cartpayment',
                'cart.payment.submit',
                'cart.momo_check',
                'cart.order_detail',
                'cart.getCoupons',
                'cart.applyCoupon',
                'cart.info_user',
                'cart.info_user.store',
                'dashboard',
                'product.detail',
                'cart.add',
                'cart.history_cart',
                'momo_payment',
                'cart.momo_check',
                'signout',
                'cart.cart',
                'cart.result_cart',
                'products.category',
                'gopy.index',
                'product',
                'product.search',
                'user.info',
                'change.password',
                'change.password.post',
                'chat.form',
                'chat.send'
            ];

            if (
                !in_array($request->route()->getName(), $allowedRoutes) &&
                !$request->is('provinces') &&
                !$request->is('districts/*') &&
                !$request->is('wards/*')
            ) {
                return redirect()->route('cart.cartpayment')
                    ->with('error', 'Vui lòng hoàn tất quá trình thanh toán trước khi rời đi.');
            }
        }

        return $next($request);
    }
}