<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\Content;
use App\Models\Category;

// grid方法与form方法
use Encore\Admin\Grid;
use Encore\Admin\Form;

abstract class CommonProductsController extends Controller
{
    use HasResourceActions;

    // 定义一个抽象方法,返回当前管理的商品类型
    abstract public function getProductType();

    public function index(Content $content)
    {
        return $content
            ->header(Product::$typeMap[$this->getProductType()] . '列表')
            ->description('description')
            ->body($this->grid());
    }

    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑'.Product::$typeMap[$this->getProductType()])
            ->description('description')
            ->body($this->form()->edit($id));
    }

    public function create(Content $content)
    {
        return $content
            ->header('新增' . Product::$typeMap[$this->getProductType()])
            ->description('description')
            ->body($this->form());
    }

    protected function grid()
    {
        $grid = new Grid(new Product);

        // 筛选出当前类型的商品，默认 ID 倒序排序
        $grid->model()->where('type', $this->getProductType())->orderBy('id', 'desc');
        // 调用自定义方法
        $this->customGrid($grid);

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
        });

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });
        
        return $grid;
    }

    // 定义一个抽象方法,各个类型的控制器将实现本方法来定义列表应该显示那些内容
    abstract protected function customGrid(Grid $grid);

    protected function form()
    {
        $form = new Form(new Product);

        // 在表单中添加一个名为 type，值为 Product::TYPE_NORMAL 的隐藏字段
        $form->hidden('type')->value($this->getProductType());
        $form->text('title', '商品名称')->rules('required');
        $form->text('long_title', '商品长标题')->rules('required');
        // 添加一个类目字段,与之前的类目管理类似,使用Ajax的方式来搜索添加
        $form->select('category_id', '类目')->options(function ($id) {
            $category = Category::find($id);
            if ($category) {
                return [$category->id => $category->full_name];
            }
        })->ajax('/admin/api/categories?is_directory=0');
        $form->image('image', '封面图片')->rules('required|image');
        $form->editor('description', '商品描述')->rules('required');
        $form->switch('on_sale', '是否上架')->default(0);
        // 调用自定义方法
        $this->customForm($form);
        // 直接添加一对多的关联模型
        $form->hasMany('skus', 'SKU 列表', function (Form\NestedForm $form) {
            $form->text('title', 'SKU 名稱')->rules('required');
            $form->text('description', 'SKU 介紹')->rules('required');
            $form->text('price', '單價')->rules('required|numeric|min:0.01');
            $form->text('stock', '剩餘庫存')->rules('required|integer|min:0');
        });
        // 放在 SKU 下面
        $form->hasMany('properties', '商品属性', function (Form\NestedForm $form) {
            $form->text('name', '属性名')->rules('required');
            $form->text('value', '属性值')->rules('required');
        });
        // 定义事件回调，当模型即将保存时会触发这个回调
        $form->saving(function (Form $form) {
            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ? : 0;
        });
        
        return $form;
    }

    // 定义一个抽象方法,各类型的控制器将实现本方法来定义表单应用应该有那些额外字段
    abstract protected function customForm(Form $form);
}