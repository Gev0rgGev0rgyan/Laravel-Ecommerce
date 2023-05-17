<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style type="text/css">
    	.div_center{
    		text-align: center;
    		padding-top:px 40px;
    	}
    	.add_product{
    		font-size: 40px;
    		padding-bottom: 40px;
    	}
    	.title_input{
    		color: black;
/*    		padding-bottom: 20px;*/
    	}
    	label{
    		display: inline-block;
    		width: 200px;
    	}
    	.table_row{
    		padding-bottom: 15px;

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

          	<div class="div_center">
          		<h1 class="add_product">Add Product</h1>


          		<form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">

          			@csrf



          		<div class="table_row">
          			<label>Product Title</label>
          			<input class="title_input" type="text" name="title" placeholder="Write a title" required="">
          		</div>

          		

          		<div class="table_row">
          			<label>Product Description</label>
          			<input class="title_input" type="text" name="description" placeholder="Write a description" required="">
          		</div>


          		<div class="table_row">
          			<label>Product Price</label>
          			<input class="title_input" type="number" name="price" placeholder="Write a price" required="">
          		</div>

				<div class="table_row">
          			<label>Discount Price</label>
          			<input class="title_input" type="number" name="discount_price" placeholder="Discount Price">
          		</div>

          		<div class="table_row">
          			<label>Product Quantity</label>
          			<input class="title_input" type="number" name="quantity" placeholder="Quantity" required="">
          		</div>

          		

          		<div class="table_row">
          			<label>Product Category</label>
          			<select class="title_input" name="category">
          				<option value="" selected="">Add a Category here</option>
          			@foreach ($category as $c)


          				<option value="{{$c->category_name}}">{{$c->category_name}}</option>
          			

          			@endforeach
          			</select>
          		</div>

          		<div class="table_row">
          			<label>Product Image</label>

          			<input type="file" name="image">
          		</div>

          		<div class="table_row">
          			<input type="submit" value="Add Product" class="btn btn-primary" required="">
          		</div>
          		</form>

          	</div>

          </div>
      </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>