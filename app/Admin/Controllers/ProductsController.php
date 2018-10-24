<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends CommonProductsController
{
    // 获取商品类型
    public function getProductType()
    {
        return Product::TYPE_NORMAL;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function customGrid(Grid $grid)
    {
        // 使用 with 来预加载商品类目数据，减少 SQL 查询
        $grid->model()->with(['category']);
        $grid->id('ID')->sortable();
        $grid->title('商品名称');
        // Laravel-Admin 支持用符号 . 来展示关联关系的字段
        $grid->column('category.name', '类目');
        // $grid->description('商品描述');
        // $grid->image('Image');
        $grid->on_sale('上架状态')->display(function ($value) {
            return $value ? '已上架' : '未上架';
        });
        $grid->price('价格');
        $grid->rating('评分');
        $grid->sold_count('销量');
        $grid->review_count('评论数');
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function customForm(Form $form)
    {
        // 普通商品没有额外字段
    }
}
