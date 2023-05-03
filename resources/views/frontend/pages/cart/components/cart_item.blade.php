<div class="main-cart" style="padding: 30px 0" id="cart_items" data-url="{{ route('cart.delete') }}">
    @if (session()->get('cart'))
        <div class="table-responsive cart_info">
            <table class="table table-condensed update_cart_url" data-url="{{ route('cart.update') }}">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                @php
                    $total = 0;
                @endphp
                <tbody>
                    @foreach ($cart as $id => $item)
                        @php
                            $total += $item['price'] * $item['quantity'];
                        @endphp
                        <tr>
                            <td class="cart_product">
                                <a href="{{ route('product.detail', ['slug' => $item['slug']]) }}"><img
                                        src="{{ $item['feature_image_path'] }}" alt="{{ $item['name'] }}"
                                        style="width: 40px; height: 40px; object-fit: cover"></a>
                            </td>
                            <td class="cart_description">
                                <h4><a
                                        href="{{ route('product.detail', ['slug' => $item['slug']]) }}">{{ $item['name'] }}</a>
                                </h4>
                            </td>
                            <td class="cart_price">
                                <p>{{ number_format((float) $item['price'], 0) }} vnđ</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <input class="cart_quantity_input" type="number" name="quantity"
                                        value="{{ $item['quantity'] }}" autocomplete="off" min="1">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    {{ number_format((float) $item['price'] * $item['quantity'], 0) }} vnđ
                                </p>
                            </td>
                            <td class="cart_action" style="display: flex;">
                                <a class="btn btn-primary cart_update" href="" style="margin-right: 2px"
                                    data-id="{{ $id }}">
                                    <i class="fa fa-refresh"></i>
                                </a>
                                <a class="btn btn-primary cart_delete" href="" data-id="{{ $id }}">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="total_cart cart_total_price text-center" style="padding-bottom: 20px">
                Tổng cộng : {{ number_format((float) $total, 0) }} vnđ
                <p class="check_out">
                    <a href="{{ route('cart.checkout') }}" class="btn btn-primary"
                        style="margin-top: 0; display: block">Thanh toán</a>
                </p>
            </div>
        </div>
    @else
        <div class="empty">
            Không có sản phẩm nào trong giỏ hàng của bạn
        </div>
    @endif
</div>
