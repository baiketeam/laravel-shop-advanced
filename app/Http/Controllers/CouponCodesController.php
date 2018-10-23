<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CouponCode;
use Carbon\Carbon;
use App\Exceptions\CouponCodeUnavailableException;

class CouponCodesController extends Controller
{
    public function show($code, Request $request)
    {
        // // 判断优惠券是否存在
        // if (!$record = CouponCode::where('code', $code)->first()) {
        //     abort(404);
        // }

        // // 如果优惠券没有启用则等同于没有优惠券
        // if (!$record->enabled) {
        //     abort(404);
        // }

        // if ($record->total - $record->used <= 0) {
        //     return response()->json(['msg' => '优惠券已经被兑完'], 403);
        // }

        // if ($record->not_before && $record->not_before->gt(Carbon::now())) {
        //     return response()->json(['msg' => '该优惠券现在还不能使用'], 403);
        // }

        // if ($record->not_after && $record->not_after->lt(Carbon::now())) {
        //     return response()->json(['msg' => '该优惠券已过期'], 403);
        // }
        if (!$record = CouponCode::where('code', $code)->first()) {
            throw new CouponCodeUnavailableException('优惠券不存在');
        }

        $record->checkAvailable($request->user());

        return $record; 
    }
}
