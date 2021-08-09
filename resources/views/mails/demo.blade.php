<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xác nhận đơn hàng</title>
</head>

<body>
    <div class="container" style="background-color: #222; border-radius: 12px;padding: 15px">
        <div class="col-md-12">
            <p style="text-align: center; color: #fff">Đây là email tự động, quý khách vui lòng không phản hồi luồng
                emai này !</p>
            <div class="row" style="background-color: cadetblue;padding: 15px">
                <div class="col-md-12" style="font-size: 30px; color: #fff; text-align: center">ANHQUANSTORE
                    - ĐẲNG CẤP TẠO UY
                    TÍN</div>
                <div class="col-md-12">
                    <p style="font-weight: bold;">Xin chào {{ $name }} !</p>
                    <p>Cảm ơn bạn đã đặt hàng ở AnhQuanStore !</p>
                    <h4>THÔNG TIN ĐƠN HÀNG</h4>
                    <p>Mã đơn hàng: <span style="color: #fff">{{ $invoice_hr }}</span></p>
                    <p>Dịch vụ: <span style="color: #fff">ĐẶT HÀNG TRỰC TUYẾN</span></p>
                    -----------------------------------------------------
                    <h4>THÔNG TIN NGƯỜI NHẬN</h4>
                    <p>Họ tên: <span style="color: #fff">{{ $name }}</span></p>
                    <p>Địa chỉ: <span style="color: #fff">{{ $address }}</span></p>
                    <p>Điện thoại liên hệ: <span style="color: #fff">{{ $phone }}</span></p>
                    <p>Email: <span style="color: #fff">{{ $email }}</span></p>
                    <p>Ghi chú đơn hàng: <span style="color: #fff">{{ $note }}</span></p>
                    <p>Hình thức thanh toán: <span style="color: #fff">Trả tiền mặt sau khi nhận hàng</span></p>
                    <i>Nếu thông tin cá nhân không chính xác quý khách vui lòng liên hệ 0853009301 để được hỗ trợ
                        !</i><br>
                    -----------------------------------------------------
                    <h4>CHI TIẾT ĐƠN HÀNG</h4>
                    <table>
                        <thead>
                            <tr>
                                <th class="product-name" style="width: 150px">Sản phẩm</th>
                                <th class="product-sku">Mã hàng</th>
                                <th class="product-color">Màu sắc</th>
                                <th class="product-price">Giá gốc</th>
                                <th class="product-discount">Giảm giá</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $itemCart)
                                <tr>

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
                                        <a>{{ $itemCart['quantity'] }}</a>
                                    </td>
                                    <td class="product-subtotal">
                                        <a>{{ number_format(($itemCart['price'] - ($itemCart['price'] * $itemCart['discount']) / 100) * $itemCart['quantity']) }}
                                            Đ</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <h4>TỔNG TIỀN: {{ number_format($totalPrice) }} Đ</h4>
                    -----------------------------------------------------
                    <br>
                    <i>Mọi thắc mắc về đơn hàng quý khách vui lòng liên hệ đến 0853009301 ! Một lần nữa cảm ơn quý khách
                        đã tin tưởng ANHQUANSTORE !</i>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
