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
   </head>
   <body>
   	 @include('sweetalert::alert')
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
     
      
      
    
      
     <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            <div class="row">

               @foreach ($product as $p)

               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details',$p->id)}}" class="option1">
                           Product Details
                           </a>

                                 <form action="{{url('add_cart', $p->id)}}" method="POST">
                                    @csrf
                                    <div class="row">
                                       <div class="col-md-4">
                                          <input type="number" name="quantity" value="1" min="1" style="width:100px;">
                                       </div>
                                       <div class="col-md-4">
                                          <input type="submit" name="" value="Add To Cart">
                                       </div>
                                    
                                    </div>
                                 </form>
                           



                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product/{{$p->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                          {{$p->title}}
                        </h5>
                        @if ($p->discount_price)
                        <h6 style="color:red">
                           Discount Price
                           <br>
                           ${{$p->discount_price}}
                        </h6>


                        <h6 style="text-decoration: line-through;">
                           Price
                           <br>
                           ${{$p->price}}
                        </h6>

                        @else

                        <h6>
                           Price
                           <br>
                           ${{$p->price}}
                        </h6>                        

                        @endif

                     </div>
                  </div>
               </div>
               
               @endforeach

               <span style="padding-top:20px;">
                  

               

               </span>
           
         </div>
      </section>

      
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