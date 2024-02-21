<div class = "" style="text-align:center">
    @auth
        <h3>Xin chào {{ auth()->user()->name }}</h3>
    @else
        <h3>Xin chào !</h3>
    @endauth
    <p>
        Cảm ơn bạn đã tin tưởng và mua hàng tại shop !
    </p>
    <p>Chúc bạn có một ngày vui vẻ !</p>
</div>
<div class = "hr"></div>
<div class = "invoice-head-middle">
    <div class = "invoice-head-middle-left text-start">
        <p><span class = "text-bold">Date</span>:{{ $mailData['order']->created_at }}</p>
    </div>
    <div class = "invoice-head-middle-right text-end">
        <p>
            <span class = "text-bold">Invoice No:</span>#{{ $mailData['order']->id }}
        </p>
    </div>
</div>
<div class = "hr"></div>
<div class = "invoice-head-bottom">
    <div class = "invoice-head-bottom-left">
        <ul>
            <li class = 'text-bold'>Invoiced To:</li>
            <li>Tên khách hàng:{{ $mailData['order']->name }}</li>
            <li>Địa chỉ:{{ $mailData['order']->address }}</li>
            <li>SDT:{{ $mailData['order']->phone }}</li>
            @if ($mailData['order']->phone2 != null)
                <li>SDT(dự phòng):{{ $mailData['order']->phone2 }}</li>
            @endif
        </ul>
    </div>
</div>
</div>
<div class = "overflow-view">
    <div class = "invoice-body">
        <table border="1" cellspacing="0" cellpadding="10" style="width:auto">
            <thead>
                <tr>
                    <td class = "text-bold" style="width:auto">Sản phẩm</td>
                    <td class = "text-bold">Size</td>
                    <td class = "text-bold">Màu</td>
                    <td class = "text-bold">Giá</td>
                    <td class = "text-bold">Số lượng</td>
                    <td class = "text-bold">Tổng</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($mailData['orderProducts'] as $orderProduct)
                    <tr>
                        <td>{{ $orderProduct->product->name }}</td>
                        <td>{{ $orderProduct->size }}</td>
                        <td>{{ $orderProduct->color }}</td>
                        <td>{{ number_format($orderProduct->price, 0, ',', '.') }}Đ</td>
                        <td>{{ $orderProduct->quantity }}</td>
                        <td class = "text-end">{{ number_format($orderProduct->total, 0, ',', '.') }}Đ
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <hr>
        <div class = "invoice-body-bottom" style="font-size: 15px">
            <div class = "invoice-body-info-item border-bottom">
                SubTotal:{{ number_format($mailData['order']->sub_total, 0, ',', '.') }}Đ
            </div>
            <div class = "invoice-body-info-item border-bottom">
                <span>Tax :{{ number_format($mailData['order']->tax, 0, ',', '.') }}Đ</span>
            </div>
            <div class = "invoice-body-info-item border-bottom">
                <span>Discount
                    :{{ number_format($mailData['order']->sub_total - $mailData['order']->total, 0, ',', '.') }}Đ</span>
            </div>
            <div class = "invoice-body-info-item">
                <span>Total:{{ number_format($mailData['order']->total, 0, ',', '.') }}Đ</span>
            </div>
        </div>
    </div>
</div>

<hr>
<h3>Trạng thái đơn hàng:</h3>
<h2>Đã xác nhận đơn hàng</h2>
