<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Exceptions\InvalidRequestException;
use App\Models\OrderItem;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $page    = $request->input('page', 1);
        $perPage = 16;

        // 构建查询
        $params = [
            'index' => 'products',
            'type'  => '_doc',
            'body'  => [
                'from'  => ($page - 1) * $perPage, // 通过当前页数与每页数量计算偏移值
                'size'  => $perPage,
                'query' => [
                    'bool' => [
                        'filter' => [
                            ['term' => ['on_sale' => true]],
                        ],
                    ],
                ],
            ],
        ];

        // 是否有提交order参数,如果有就赋值给$order变量
        // order参数用来控制商品的排序
        if ($order = $request->input('order', '')) {
            // 是否是以 _asc 或者 _desc 结尾
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // 如果字符串的开头是这 3 个字符串之一，说明是一个合法的排序值
                if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
                    // 根据传入的排序值来构造排序参数
                    $params['body']['sort'] = [[$m[1] => $m[2]]];
                }
            }
        }

        // ElasticSearch类目筛选
        if ($request->input('category_id') && $category = Category::find($request->input('category_id'))) {
            if ($category->is_directory) {
               // 如果是一个父类栏目,则使用category_path来筛选
                $params['body']['query']['bool']['filter'][] = [
                    'prefix' => ['category_path' => $category->path.$category->id . '-'],
                ]; 
            } else {
                // 否则直接通过category_id筛选
                $params['body']['query']['bool']['filter'][] = ['term' => ['category_id' => $category->id]];
            }
            
        }

        // ElasticSearch关键词查询
        if ($search = $request->input('search', '')) {
            // 将搜索词根据空格拆分成数组，并过滤掉空项
            $keywords = array_filter(explode(' ', $search));

            $params['body']['query']['bool']['must'] = [];
            // 遍历搜索词数组，分别添加到 must 查询中
            foreach ($keywords as $keyword) {
                $params['body']['query']['bool']['must'][] = [
                    'multi_match' => [
                        'query'  => $keyword,
                        'fields' => [
                            'title^2',
                            'long_title^2',
                            'category^2',
                            'description',
                            'skus_title',
                            'skus_description',
                            'properties_value',
                        ],
                    ],
                ];
            }
        }

        $result = app('es')->search($params);

        // 通过 collect 函数将返回结果转为集合，并通过集合的 pluck 方法取到返回的商品 ID 数组
        $productIds = collect($result['hits']['hits'])->pluck('_id')->all();
        // 通过 whereIn 方法从数据库中读取商品数据
        $products = Product::query()
            ->whereIn('id', $productIds)
            // orderByRaw可以让我们用远程的SQL来给查询结果排序
            ->orderByRaw(sprintf("FIND_IN_SET(id, '%s')", join(',', $productIds)))
            ->get();
        // 返回一个 LengthAwarePaginator 对象
        $pager = new LengthAwarePaginator($products, $result['hits']['total'], $perPage, $page, [
            'path' => route('products.index', false), // 手动构建分页的 url
        ]);

        return view('products.index', [
            'products' => $pager,
            'filters'  => [
                'search' => $search,
                'order'  => $order,
            ],
            'category' => $category ?? null,
        ]);









        // // 创建一个查询构造器
        // $builder = Product::query()->where('on_sale', true);
        // // 判断是否有提交search参数,如果有就赋值给$search变量
        // if ($search = $request->input('search', '')) {
        //     $like = '%'.$search.'%';
        //     // 模糊搜索商品标题,商品详情,SKU标题,sku描述
        //     $builder->where(function ($query) use ($like) {
        //         $query->where('title', 'like', $like)
        //             ->orWhere('description', 'like', $like)
        //             ->orWhereHas('skus', function ($query) use ($like) {
        //                 $query->where('title', 'like', $like)
        //                     ->orWhere('description', 'like', $like);
        //             });
        //     });
        // }

        // if ($request->input('category_id') && $category = Category::find($request->input('category_id'))) {
        //     // 如果这是一个父类目
        //     if ($category->is_directory) {
        //         // 则筛选出改父类目下所有自类目的商品
        //         $builder->whereHas('category', function ($query) use ($category) {
        //             // 整理的逻辑参考本章第一节
        //             $query->where('path', 'like', $category->path.$category->id.'-%');
        //         });
        //     } else {
        //         // 如果不是一个父类目,则直接筛选出次类目下的商品
        //         $builder->where('category_id', $category->id);
        //     }
        // }

        // // 是否有提交order参数,有就赋值给$order
        // if ($order = $request->input('order', '')) {
        //     if (preg_match('/(.+)_(asc|desc)/', $order, $m)) {
        //         // dd($m);
        //         // 如果字符串开头是这3个字符串之一,说明是一个合法的排序值
        //         if (in_array($m[1],['price', 'sold_count', 'rating'])) {
        //             // 根据传入的排序值来构造排序参数
        //             $builder->orderBy($m[1], $m[2]);
        //         }
        //     }
        // }

        // $products = $builder->paginate(16);

        // return view('products.index', [
        //     'products' => $products,
        //     'filters' => [
        //         'search' => $search,
        //         'order' => $order,
        //     ],
        //     'category' => $category ?? null,
        // ]);
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
