<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Order PDF</title>
</head>
<body>
	<h1>Order Details</h1>
	<h3>Customer Name: {{$order->name}}</h3>
	<h3>Customer Email: {{$order->email}}</h3>
	<h3>Customer Phone: {{$order->phone}}</h3>
	<h3>Customer Address: {{$order->address}}</h3>
	<h3>Customer ID: {{$order->user_id}}</h3>
	<h3>Product name: {{$order->product_title}}</h3>
	<h3>Product Quantity: {{$order->quantity}}</h3>
	<h3>Product Price: {{$order->price}}</h3>
	<h3>Payment Status: {{$order->payment_status}}</h3>
	<h3>Product ID: {{$order->product_id}}</h3>

</body>
</html>