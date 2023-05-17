<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />

      <style type="text/css">
      	.cart_table_div{
      		margin: auto;
      		width: 50%;
      		text-align: center;
      		padding: 30px;
      	}
      	table, th, td{
      		border: 1px solid grey;
      	}
      	th{
      		font-size: 30px;
      		padding: 5px;
      		background: lightgrey;
      	}
      	.cart_image{
      		width: 100px;
      		height: auto;
      	}
      	.total_price{
      		font-size: 20px;
      		padding: 40px;
      	}
      </style>
   </head>
   <body>
   	@if(session()->has('message'))

          	<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          		{{session()->get('message')}}
          	</div>

          	@endif
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         
      
      
      		<div class="cart_table_div">
      			<table>

      				<tr>
      					<th>Product title</th>
      					<th>Product Quantity</th>
      					<th>Price</th>
                     <th>Payment Status</th>
                     <th>Delivery Status</th>
      					<th>Image</th>
                     <th>Cancel Order</th>
      				</tr>
      				
                  
      				@foreach($orders as $o)
                  
                  <tr>
                     <td>{{$o->product_title}}</td>
                     <td>{{$o->quantity}}</td>
                     <td>${{$o->price}}</td>
                     <td>{{$o->payment_status}}</td>
                     <td>{{$o->delivery_status}}</td>
                     <td><img class="cart_image" src="/product/{{$o->image}}"></td>
                     <td>
                        @if($o->delivery_status=='processing')
                        <a class="btn btn-danger" onclick="return confirm('Are you sure to Cancel this order?')" href="{{url('cancel_order', $o->id)}}">Cancel Order</a>
                        @else
                        <p style="color: red;">Not Allowed</p>

                        @endif

                     </td>
                     
               </tr>

              
               @endforeach

      			</table>
      			

      			
      		</div>
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>