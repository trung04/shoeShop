            <div class = "invoice-container">
                <div class = "invoice-head">
                    <div class = "invoice-head-top">
                        <div class = "invoice-head-top-left text-start">
                            {{-- <img src = "images/logo.png"> --}}
                        </div>
                        <div class = "" style="text-align:center">

                            @auth
                                <h3>Xin chào {{ auth()->user()->name }}</h3>
                            @else
                                <h3>Xin chào !</h3>
                            @endauth

                            <p>
                                Bạn đã đặt hàng tại hệ thống của chúng tôi,vui lòng kiểm tra lại thông tin đơn hàng của
                                bạn và nhấn vào nút xác nhận đơn hàng
                            </p>
                            @auth
                                <p>
                                    <a href="{{ route('fe.mail.confirm', [
                                        'order_id' => $mailData['order']->id,
                                        'user_id' => auth()->user()->id,
                                    ]) }}"
                                        style="display:inline-block;background:blue;color:#fff;padding:7px 25px;font-weight:bold"
                                        target="_blank">Xác
                                        nhận đơn hàng của bạn</a>
                                </p>
                            @else
                                <a href="{{ route('fe.mail.confirm', $mailData['order']->id) }}"
                                    style="display:inline-block;background:blue;color:#fff;padding:7px 25px;font-weight:bold"
                                    target="_blank">Xác
                                    nhận đơn hàng của bạn</a>
                                </p>

                            @endauth

                        </div>
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
                <h4>Chưa xác nhận đơn hàng</h4>
                <div class = "" style="text-align:center">
                    <p>
                        Bạn đã đặt hàng tại hệ thống của chúng tôi,vui lòng kiểm tra lại thông tin đơn hàng của
                        bạn và nhấn vào nút xác nhận đơn hàng
                    </p>
                    <p>
                        <a href="{{ route('fe.mail.confirm', $mailData['order']->id) }}"
                            style="display:inline-block;background:blue;color:#fff;padding:7px 25px;font-weight:bold"
                            target="_blank">Xác
                            nhận đơn hàng của bạn</a>
                    </p>
                </div>

            </div>
