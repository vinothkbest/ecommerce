<table style="border:1px solid #000">

    @foreach($orders as $order)
    <tr>
        <th style="border:1px solid #000; color:#fff; background: #494949; font-weight:bold">ORDER ID</th>
        <th style="border:1px solid #000; color:#fff; background: #494949; font-weight:bold">CUSTOMER NAME</th>
        <th style="border:1px solid #000; color:#fff; background: #494949; font-weight:bold">COMPANY NAME</th>
        <th style="border:1px solid #000; color:#fff; background: #494949; font-weight:bold;width:100%" colspan="2">ADDRESS</th>
        <th style="border:1px solid #000; color:#fff; background: #494949; font-weight:bold">ORDER PLACED</th>
        <th style="border:1px solid #000; color:#fff; background: #494949; font-weight:bold">STATUS</th>
    </tr>
        <tr>
            <td style="border:1px solid #000;">{{ $order->order_id }}</td>
            <td style="border:1px solid #000; wrap-text:true">{{ $order->user->name }}</td>
            <td style="border:1px solid #000;">{{ $order->user->shop_name }}</td>
            <td style="border:1px solid #000;" colspan="2">{{ $order->user->address }}</td>
            <td style="border:1px solid #000;">{{ $order->created_at->format('M d, Y') }}</td>
            <td style="border:1px solid #000;">{{ $order->status_text }}</td>
        </tr>
        <tr>
            <th style="border:1px solid #000; text-align:center;font-weight:bold" colspan="7">ORDER PRODUCTS</th>
        </tr>
        <tr>
            <th style="border:1px solid #000;background-color:#ccc;color:#000">Code</th>
            <th style="border:1px solid #000;background-color:#ccc;color:#000">Name</th>
            <th style="border:1px solid #000;background-color:#ccc;color:#000">Brand</th>
            <th style="border:1px solid #000;background-color:#ccc;color:#000">Size</th>
            <th style="border:1px solid #000;background-color:#ccc;color:#000">Color</th>
            <th style="border:1px solid #000;background-color:#ccc;color:#000">Quantity</th>
            <th style="border:1px solid #000;background-color:#ccc;color:#000">Amount</th>
        </tr>
        @foreach($order->products as $product)
            @foreach($product->variants as $varient)
            <tr>
                <td style="border:1px solid #000;">YRPC{{ $product->meta['id'] }}</td>
                <td style="border:1px solid #000;">{{ $product->meta['name'] }}</td>
                <td style="border:1px solid #000;">{{ $product->meta['brand_name'] }}</td>
                <td style="border:1px solid #000;">{{ $varient->size }}</td>
                <td style="border:1px solid #000;">{{ explode("||",$varient->color)[1] }}</td>
                <td style="border:1px solid #000;">{{ $varient->quantity }}</td>
                <td style="border:1px solid #000;">{{ 10000 }}</td>
            </tr>
            @endforeach
        @endforeach
        <tr>
            <th colspan="7"></th>
        </tr>
        <tr>
            <th colspan="7"></th>
        </tr>

    @endforeach

</table>
