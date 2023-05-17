<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')


    <style type="text/css">
    	#h1{
    		text-align: center;
    		font-size: 25px;
    		padding-bottom: 40px;
    		font-weight: bold;
    		
    	}
    	.table{
    		border: 2px solid white;
    		width: 80%;
    		margin:auto;
    		text-align: center;

    	}
    	th{
    		background-color: #fa6e6e;
    	}
    

    	
    	
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.slidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->

        <div class="main-panel">
          <div class="content-wrapper">

          	<h1 id="h1">All Orders</h1>
          	<div style="padding-left: 400px; padding-bottom:30px;">
          		<form action="{{url('search')}}" method="get">
          			@csrf
          			<input style="color:black;" type="text" name="search" placeholder="Search for Something">
          			<input type="submit" value="Search" class="btn btn-outline-primary">
          		</form>
          	</div>
          	<div class="table-div">
          	<table class="table">
          		<tr>
          			<th>Name</th>
          			<th>Email</th>
          			<th>Address</th>
          			<th>Phone</th>
          			<th>Product title</th>
          			<th>Quantity</th>
          			<th>Price</th>
          			<th>Payment Status</th>
          			<th>Delivery Status</th>
          			<th>Image</th>
          			<th>Delivered</th>
          			<th>Print <br> PDF</th>
          		</tr>
          		@forelse ($orders as $order)
          		<tr>
          			<td>{{$order->name}}</td>
          			<td>{{$order->email}}</td>
          			<td>{{$order->address}}</td>
          			<td>{{$order->phone}}</td>
          			<td>{{$order->product_title}}</td>
          			<td>{{$order->quantity}}</td>
          			<td>${{$order->price}}</td>
          			<td>{{$order->payment_status}}</td>
          			<td>{{$order->delivery_status}}</td>
          			<td>
          				<img  src="/product/{{$order->image}}">
          			</td>
          			<td>
          				@if($order->delivery_status=='processing')
          				<a href="{{url('delivered', $order->id)}}" class="btn btn-primary" onclick="return confirm('Are you sure this product is delivered?')">Delivered</a>

          				@elseif($order->delivery_status=='delivered')

          				<p>Delivered</p>

          				@endif
          			</td>
          			<td>
          				<a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary">Print <br> PDF</a>
          			</td>
          		</tr>
              @empty
              <tr>
                <td colspan="16">
                  No Data Found
                </td>
              </tr>
          		@endforelse
          	</table>
          	</div>

          </div>
        </div>
      
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>