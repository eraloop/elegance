@extends('emails.layout')

@section('title', $isAdminCopy ? 'New Order Received' : 'Order Confirmation')

@section('content')
    <h2>{{ $isAdminCopy ? 'New Order Received' : 'Thank You for Your Order!' }}</h2>

    <p>Hello {{ $isAdminCopy ? 'Admin' : $order->customer_name }},</p>

    @if($isAdminCopy)
        <p>A new order has been placed on the website. Please review the details below.</p>
    @else
        <p>We have received your order and it is currently being processed. We will contact you shortly regarding delivery and
            payment.</p>
    @endif

    <div style="background-color: #f9f9f9; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
        <h3
            style="margin-top: 0; color: #333; font-size: 16px; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
            Order Details</h3>
        <table style="width: 100%; font-size: 14px;">
            <tr>
                <td style="padding: 5px 0; color: #777;">Order Number:</td>
                <td style="padding: 5px 0; font-weight: bold; text-align: right;">{{ $order->order_number }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0; color: #777;">Date:</td>
                <td style="padding: 5px 0; font-weight: bold; text-align: right;">
                    {{ $order->created_at->format('M d, Y H:i') }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0; color: #777;">Status:</td>
                <td style="padding: 5px 0; font-weight: bold; text-align: right; text-transform: capitalize;">
                    {{ $order->status }}</td>
            </tr>
        </table>
    </div>

    <div style="margin-bottom: 30px;">
        <h3 style="color: #333; font-size: 16px; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
            Items Ordered</h3>
        <table style="width: 100%; font-size: 14px; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 10px; text-align: left; border-bottom: 1px solid #ddd;">Product</th>
                    <th style="padding: 10px; text-align: center; border-bottom: 1px solid #ddd;">Qty</th>
                    <th style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd;">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $item->product_name }}</td>
                        <td style="padding: 10px; text-align: center; border-bottom: 1px solid #eee;">{{ $item->quantity }}</td>
                        <td style="padding: 10px; text-align: right; border-bottom: 1px solid #eee;">
                            ${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2"
                        style="padding: 15px 10px; text-align: right; font-weight: bold; border-top: 2px solid #ddd;">Total
                    </td>
                    <td
                        style="padding: 15px 10px; text-align: right; font-weight: bold; border-top: 2px solid #ddd; color: #084734; font-size: 16px;">
                        ${{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="background-color: #f9f9f9; border-radius: 8px; padding: 20px;">
        <h3
            style="margin-top: 0; color: #333; font-size: 16px; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
            Customer Information</h3>
        <p style="margin: 5px 0; font-size: 14px;"><strong>Name:</strong> {{ $order->customer_name }}</p>
        <p style="margin: 5px 0; font-size: 14px;"><strong>Email:</strong> {{ $order->customer_email }}</p>
        <p style="margin: 5px 0; font-size: 14px;"><strong>Phone:</strong> {{ $order->customer_phone }}</p>
        <p style="margin: 5px 0; font-size: 14px;"><strong>Address:</strong> {{ $order->shipping_address }}</p>
        @if($order->notes)
            <p style="margin: 5px 0; font-size: 14px;"><strong>Notes:</strong> {{ $order->notes }}</p>
        @endif
    </div>

    @if(!$isAdminCopy)
        <div style="text-align: center; margin-top: 30px;">
            <p>If you have any questions, simply reply to this email.</p>
            <a href="{{ route('web.products.index') }}" class="btn">Continue Shopping</a>
        </div>
    @endif
@endsection