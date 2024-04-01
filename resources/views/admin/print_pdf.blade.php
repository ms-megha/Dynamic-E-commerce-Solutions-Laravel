<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .invoice {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .invoice h2 {
            margin-top: 0;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details div {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        .product-image {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <h2>Invoice</h2>
        <div class="invoice-details">
            <div><strong>Name:</strong>{{ $order->user_name }}</div>
            <div><strong>Email:</strong>{{ $order->user_email }}</div>
            <div><strong>Phone:</strong>{{ $order->user_phone }}</div>
            <div><strong>Address:</strong>{{ $order->user_address }}</div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->cart_quantity }}</td>
                    <td>{{ $order->product_price }}</td>
                    <td><img height="100px" width="100px" src="/public/{{ $order->product_image }}"  class="product-image"></td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->delivery_status }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>


