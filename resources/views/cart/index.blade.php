@extends('layouts.app')

@section('title', '购物车')

@section('content')
<div class="row">
<div class="col-lg-10 col-lg-offset-1">
<div class="panel panel-default">
  <div class="panel-heading">我的购物车</div>
  <div class="panel-body">
    <table class="table table-striped">
      <thead>
      <tr>
        <th><input type="checkbox" id="select-all"></th>
        <th>商品信息</th>
        <th>单价</th>
        <th>数量</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody class="product_list">
      @foreach($cartItems as $item)
        <tr data-id="{{ $item->productSku->id }}">
          <td>
            <input type="checkbox" name="select" value="{{ $item->productSku->id }}" {{ $item->productSku->product->on_sale ? 'checked' : 'disabled' }}>
          </td>
          <td class="product_info">
            <div class="preview">
              <a target="_blank" href="{{ route('products.show', [$item->productSku->product_id]) }}">
                <img src="{{ $item->productSku->product->image_url }}">
              </a>
            </div>
            <div @if(!$item->productSku->product->on_sale) class="not_on_sale" @endif>
              <span class="product_title">
                <a target="_blank" href="{{ route('products.show', [$item->productSku->product_id]) }}">{{ $item->productSku->product->title }}</a>
              </span>
              <span class="sku_title">{{ $item->productSku->title }}</span>
              @if(!$item->productSku->product->on_sale)
                <span class="warning">该商品已下架</span>
              @endif
            </div>
          </td>
          <td><span class="price">￥{{ $item->productSku->price }}</span></td>
          <td>
            <input type="text" class="form-control input-sm amount" @if(!$item->productSku->product->on_sale) disabled @endif name="amount" value="{{ $item->amount }}">
          </td>
          <td>
            <button class="btn btn-xs btn-danger btn-remove">移除</button>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
@endsection
@section('scriptsAfterJs')
<script>
  $(document).ready(function () {
    // 监听移除按钮的点击事件
    $('.btn-remove').click(function () {
      // $(this) 可以获取到当前点击的 移除 按钮的 jQuery 对象
      // closest() 方法可以获取到匹配选择器的第一个祖先元素，在这里就是当前点击的 移除 按钮之上的 <tr> 标签
      // data('id') 方法可以获取到我们之前设置的 data-id 属性的值，也就是对应的 SKU id
      var id = $(this).closest('tr').data('id');
      swal({
        title: "确认要将该商品移除？",
        icon: "warning",
        buttons: ['取消', '确定'],
        dangerMode: true,
      })
      .then(function (willDelete) {
        if (!willDelete) {
          return;
        }
        axios.delete('/cart/' + id)
          .then(function () {
            location.reload();
          })
      });
    });
    $('#select-all').change(function () {
      var checked = $(this).prop('checked');
      $('input[name=select][type=checkbox]:not([disabled])').each(function () {
        $(this).prop('checked', checked);
      });
    });
  });
</script>
@endsection