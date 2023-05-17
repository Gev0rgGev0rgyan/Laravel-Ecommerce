<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style type="text/css">
    	.product_table{
    		margin: auto;
    		width: 50%;
    		border: 2px solid white;
    		text-align: center;
    		margin-top: 40px;
    	}

    	.all_products{
    		text-align: center;
    		font-size: 40px;
    		padding-top: 20px;

    	}

    	th{
    		padding: 30px;
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


          	@if(session()->has('message'))

          	<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          		{{session()->get('message')}}
          	</div>

          	@endif


          		<h2 class="all_products">All Products</h2>

          		<table class="product_table">
          			
          			<tr>
          				<th>Product title</th>
          				<th>Description</th>
          				<th>Quantity</th>
          				<th>Category</th>
          				<th>Price</th>
          				<th>Discount Price</th>
          				<th>Product Image</th>
          				<th>Delete</th>
          				<th>Edit</th>

          			</tr>
          			@foreach($product as $p)

          			<tr>
          				<td>{{$p->title}}</td>
          				<td>{{$p->description}}</td>
          				<td>{{$p->quantity}}</td>
          				<td>{{$p->category}}</td>
          				<td>{{$p->price}}</td>
          				<td>{{$p->discount_price}}</td>
          				<td>
          					<img class="product_image" src="/product/{{$p->image}}">
          				</td>
          				<td>
          					<a class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')" href="{{url('/delete_product', $p->id)}}">Delete</a>
          				</td>
          				<td>
          					<a class="btn btn-success" href="{{url('/update_product', $p->id)}}">Edit</a>
          				</td>



          			</tr>
          			@endforeach


          		</table>



          </div>

      </div>/
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>