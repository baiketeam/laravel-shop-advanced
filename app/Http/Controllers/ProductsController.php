<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Exceptions\InvalidRequestException;
use App\Models\OrderItem;
use App\Models\Category;
use App\Services\CategoryService;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        // 创建一个查询构造器
        $builder = Product::query()->where('on_sale', true);
        // 判断是否有提交search参数,如果有就赋值给$search变量
        if ($search = $request->input('search', '')) {
            $like = '%'.$search.'%';
            // 模糊搜索商品标题,商品详情,SKU标题,sku描述
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhereHas('skus', function ($query) use ($like) {
                        $query->where('title', 'like', $like)
                            ->orWhere('description', 'like', $like);
                    });
            });
        }

        if ($request->input('category_id') && $category = Category::find($request->input('category_id'))) {
            // 如果这是一个父类目
            if ($category->is_directory) {
                // 则筛选出改父类目下所有自类目的商品
                $builder->whereHas('category', function ($query) use ($category) {
                    // 整理的逻辑参考本章第一节
                    $query->where('path', 'like', $category->path.$category->id.'-%');
                });
            } else {
                // 如果不是一个父类目,则直接筛选出次类目下的商品
                $builder->where('category_id', $category->id);
            }
        }

        // 是否有提交order参数,有就赋值给$order
        if ($order = $request->input('order', '')) {
            if (preg_match('/(.+)_(asc|desc)/', $order, $m)) {
                // dd($m);
                // 如果字符串开头是这3个字符串之一,说明是一个合法的排序值
                if (in_array($m[1],['price', 'sold_count', 'rating'])) {
                    // 根据传入的排序值来构造排序参数
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }

        $products = $builder->paginate(16);

        return view('products.index', [
            'products' => $products,
            'filters' => [
                'search' => $search,
                'order' => $order,
            ],
            'category' => $category ?? null,
        ]);
    }

    public function show(Product $product, Request $request)
    {
        // 判断商品是否已上架,如果没有商家则抛出异常
        if (!$product->on_sale) {
            throw new InvalidRequestException('商品未上架');
        }

        $favored = false;
        // 用户为登陆时返回的是null,已登录时返回的对应的用户对象
        if ($user = $request->user()) {
            // 从当前用户已收藏的商品中搜索id为当前商品id的商品
            // boolval()函数用于把值转为布尔值
            $favored = boolval($user->favoriteProducts()->find($product->id));
        }

        $reviews = OrderItem::query()
            ->with(['order.user', 'productSku']) // 预先加载关联关系
            ->where('product_id', $product->id)
            ->whereNotNull('reviewed_at') // 筛选出已评价的
            ->orderBy('reviewed_at', 'desc') // 按评价时间倒序
            ->limit(10) // 取出 10 条
            ->get();

        return view('products.show', ['product' => $product, 'favored' => $favored, 'reviews' => $reviews]);
    }

    public function favor(Product $product, Request $request)
    {
        $user = $request->user();
        if ($user->favoriteProducts()->find($product->id)) {
            return [];
        }

        $user->favoriteProducts()->attach($product);

        return [];
    }

    public function disfavor(Product $product, Request $request)
    {
        $user = $request->user();
        $user->favoriteProducts()->detach($product);

        return [];
    }

    public function favorites(Request $request)
    {
        $products = $request->user()->favoriteProducts()->paginate(16);

        return view('products.favorites', ['products' => $products]);
    }
}
