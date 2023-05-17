<!DOCTYPE html>
<html>
   <head>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
      @include('sweetalert::alert')
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
      					<th>Image</th>
      					<th>Action</th>
      				</tr>
      				<?php $totalprice=0; ?>
      				@foreach($cart as $c)
      				
      				<tr>
      					<td>{{$c->product_title}}</td>
      					<td>{{$c->quantity}}</td>
      					<td>${{$c->price}}</td>
      					<td><img class="cart_image" src="/product/{{$c->image}}"></td>
       					<td><a class="btn btn-danger" onclick="confirmation(event)" href="{{url('remove_cart',$c->id)}}">Remove Product</a></td>
     				</tr>

     				<?php $totalprice=$totalprice + $c->price ?>
     				@endforeach

      			</table>
      			<div>
      				<h1 class="total_price">Total Price: ${{$totalprice}}</h1>
      			</div>

      			<div>
      				<h1 style="font-size: 25px; padding-bottom: 15px;">Proceed to Order</h1>
      				<a href="{{url('cash_order')}}" class="btn btn-danger">Cash On Delivery</a>
      				<a href="{{url('stripe', $totalprice)}}" class="btn btn-danger">Pay Using Card</a>
      			</div>
      		</div>
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>

      <script>
         function confirmation(ev){
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
               title: "Are you sure to cancel this product",
               text:"You will not be able to revert this!",
               icon: "warning",
               button: true,
               dangerMode: true,
            })
            .then((willcancel) => {
            if (willCancel){
                  window.location.href = urlToRedirect;
                  }
         });
      }
          
      </script>


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