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
use App\Models\CrowdfundingProduct;

class CrowdfundingProductsController extends CommonProductsController
{
    // 获取商品类型
    public function getProductType()
    {
        return Product::TYPE_CROWDFUNDING;
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function customGrid(Grid $grid)
    {
        $grid->id('ID')->sortable();
        // $grid->type('Type');
        // $grid->category_id('Category id');
        $grid->title('商品名称');
        // $grid->description('Description');
        // $grid->image('Image');
        // $grid->on_sale('On sale');
        $grid->rating('已上架')->display(function ($value) {
            return $value ? '是' : '否';
        });
        $grid->price('价格');
        // 展示众筹相关字段
        $grid->column('crowdfunding.target_amount', '目标金额');
        $grid->column('crowdfunding.end_at', '结束时间');
        $grid->column('crowdfunding.total_amount', '目前金额');
        $grid->column('crowdfunding.status', ' 状态')->display(function ($value) {
            return CrowdfundingProduct::$statusMap[$value];
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function customForm(Form $form)
    {
        // 众筹相关字段
        $form->text('crowdfunding.target_amount', '众筹目标金额')->rules('required|numeric|min:0.01');
        $form->datetime('crowdfunding.end_at', '众筹结束时间')->rules('required|date');
    }
}
