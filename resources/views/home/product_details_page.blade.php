<!DOCTYPE html>
<html>
   <head>
    <base href="/public">
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


      <style>
        .product-container {
        max-width: 700px;
        height: 300px;
        margin: 20px auto;
        padding: 20px;
        /* border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        display: flex;
        align-items: center;
    }
    .product-details {
        flex: 1;
        padding: 30px;
    }
    .product-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .product-description {
        margin-bottom: 20px;
    }
    .product-price{
        
        margin-bottom: 10px;
        /* color: grey;
        text-decoration: line-through; */
    }
    .product-discount_price{
        margin-bottom: 10px;
        font-size: 24px;
        font-weight: bold;
    }
    .product-image {
        max-width: 500px;
        height: 350px;
        padding: 30px;
    }
    .add-to-cart-button{
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .add-to-cart-button:hover {
        background-color: #0056b3;
    }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         @if(session()->has('message'))
                <div class="alert alert-success">
                  <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                  {{ session()->get('message') }}

                </div>

              @endif

         <div class="product-container">
            <img class="product-image" src="/product/{{ $product->image }}" alt="Product Image">
            <div class="product-details">
                <h1 class="product-title">{{ $product->title }}</h1>
                
                <p class="product-description">{{ $product->description }}</p>
                @if($product->discount_price!=null)
                <p class="product-price" style="text-decoration: line-through; color:gray">${{ $product->price }}</p>
                <p class="product-discount_price">${{ $product->discount_price }}</p>
                @else
                <p class="product-price">${{ $product->price }}</p>
                @endif
                <form action="{{ url('add_cart',$product->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="cart_quantity" value="1">
                    <button class="add-to-cart-button">Add To Cart</button>
                </form>
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