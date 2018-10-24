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

class ProductsController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商品列表')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    // public function show($id, Content $content)
    // {
    //     return $content
    //         ->header('Detail')
    //         ->description('description')
    //         ->body($this->detail($id));
    // }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑商品')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('新增商品')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);

        // 使用 with 来预加载商品类目数据，减少 SQL 查询
        $grid->model()->where('type', Product::TYPE_NORMAL)->with(['category']);
        $grid->id('Id')->sortable();
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
        // $grid->created_at('Created at');
        // $grid->updated_at('Updated at');
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

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    // protected function detail($id)
    // {
    //     $show = new Show(Product::findOrFail($id));

    //     $show->id('Id');
    //     $show->title('Title');
    //     $show->description('Description');
    //     $show->image('Image');
    //     $show->on_sale('On sale');
    //     $show->rating('Rating');
    //     $show->sold_count('Sold count');
    //     $show->review_count('Review count');
    //     $show->price('Price');
    //     $show->created_at('Created at');
    //     $show->updated_at('Updated at');

    //     return $show;
    // }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        // 在表单中添加一个名为 type，值为 Product::TYPE_NORMAL 的隐藏字段
        $form->hidden('type')->value(Product::TYPE_NORMAL);
        $form->text('title', '商品名称')->rules('required');
        // 添加一个类目字段,与之前的类目管理类似,使用Ajax的方式来搜索添加
        $form->select('category_id', '类目')->options(function ($id) {
            $category = Category::find($id);
            if ($category) {
                return [$category->id => $category->full_name];
            }
        })->ajax('/admin/api/categories?is_directory=0');
        // $form->textarea('description', 'Description');
        $form->image('image', '封面图片')->rules('required|image');
        $form->editor('description', '商品描述')->rules('required');
        $form->switch('on_sale', '是否上架')->default(0);
        // 直接添加一对多的关联模型
        $form->hasMany('skus', 'SKU 列表', function (Form\NestedForm $form) {
            $form->text('title', 'SKU 名稱')->rules('required');
            $form->text('description', 'SKU 介紹')->rules('required');
            $form->text('price', '單價')->rules('required|numeric|min:0.01');
            $form->text('stock', '剩餘庫存')->rules('required|integer|min:0');
        });
        // 定义事件回调，当模型即将保存时会触发这个回调
        $form->saving(function (Form $form) {
            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ? : 0;
        });
        // $form->decimal('rating', 'Rating')->default(5.00);
        // $form->number('sold_count', 'Sold count');
        // $form->number('review_count', 'Review count');
        // $form->decimal('price', 'Price');
        return $form;
    }
}
