<div class="container mb-80">
    <div class="row">
        <div class="col-sm-12">
            <article class="post-8">
                <form class="cart-form" action="#" method="post">
                    <div class="cart-product-table-wrap responsive-table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-remove"></th>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name" style="width: 150px">Sản phẩm</th>
                                    <th class="product-sku">Mã hàng</th>
                                    <th class="product-color">Màu sắc</th>
                                    <th class="product-price">Giá gốc</th>
                                    <th class="product-discount">Giảm giá</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Thành tiền</th>
                                    <th class="product-update"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($carts as $id => $itemCart)
                                    @php
                                        $totalPrice += ($itemCart['price'] - ($itemCart['price'] * $itemCart['discount']) / 100) * $itemCart['quantity'];
                                    @endphp
                                    <tr>
                                        <td class="product-remove">
                                            <a href="" data-id="{{ $id }}" class="product-remove-item"><i
                                                    class="fa fa-times-circle" aria-hidden="true"></i></a>
                                        </td>
                                        <td class="product-thumbnail">
                                            <a>
                                                <img src="{{ $itemCart['image'] }}" alt="" /></a>
                                        </td>
                                        <td class="product-name">
                                            <a>{{ $itemCart['name'] }}</a>
                                        </td>
                                        <td class="product-sku">
                                            <a>{{ $itemCart['sku'] }}</a>
                                        </td>
                                        <td class="product-color">
                                            <a>{{ $itemCart['color'] }}</a>
                                        </td>
                                        <td class="product-discount">
                                            <a>{{ number_format($itemCart['price']) }} Đ</a>
                                        </td>
                                        <td class="product-discount">
                                            <a>{{ $itemCart['discount'] }} %</a>
                                        </td>
                                        <td>
                                            <input min="1" max="{{ $itemCart['quantity_max'] }}"
                                                value="{{ $itemCart['quantity'] }}" type="number">
                                        </td>
                                        <td class="product-subtotal">
                                            <a>{{ number_format(($itemCart['price'] - ($itemCart['price'] * $itemCart['discount']) / 100) * $itemCart['quantity']) }}
                                                Đ</a>
                                        </td>
                                        <td class="product-update">
                                            <a data-id="{{ $id }}" class="update-quantity">Cập
                                                nhập</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row cart-actions">
                        <div class="col-md-6">
                            <div class="coupon">

                                <a href="{{ route('home') }}" class="btn btn-md btn-black" name="coupon_code">Tiếp
                                    tục mua sắm</a>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <a onclick="return confirm('Bạn chắc chắn muốn xóa toàn bộ sản phẩm trong giỏ hàng ?')"
                                href="{{ route('delete.cart') }}" class="btn btn-md btn-gray" name="update_cart"
                                disabled="">Xóa tất cả sản
                                phẩm</a>
                        </div>
                    </div>
                </form>
                <div class="cart-collateral">
                    <div class="cart_totals">
                        <h3>TỔNG GIỎ HÀNG</h3>
                        <div class="responsive-table">
                            <table>
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Dự kiến</th>
                                        <td><span class="product-price-amount amount"><a>{{ number_format($totalPrice) }}
                                                    Đ</a></td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Phí vận chuyển</th>
                                        <td>
                                            Miễn phí vận chuyển toàn quốc
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Tổng tiền</th>
                                        <td>
                                            <a>{{ number_format($totalPrice) }} Đ</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product-proceed-to-checkout">
                            <a class="btn btn-lg btn-color form-full-width" href="{{ route('checkout.index') }}">Tiến
                                hành thanh
                                toán</a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
