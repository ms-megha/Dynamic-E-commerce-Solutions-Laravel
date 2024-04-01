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


      <style>
        .checkout{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff; 
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #0056b3; 
}


.cart-container {
        width: 50%;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .cart-container h1 {
        text-align: center;
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .product {
        display: flex;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #ccc;
    }

    .product img {
        max-width: 100px;
        margin-right: 20px;
    }

    .product-details {
        flex: 1;
    }

    .product-details h2 {
        margin: 0;
    }

    .product-details p {
        margin: 5px 0;
    }

    .price {
        font-weight: bold;
    }

    .total-price {
        text-align: right;
        font-size: 20px;
        margin-top: 20px;
    }

    .checkout-btn {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        margin-top: 20px;
    }

    .checkout-btn:hover {
        background-color: #0056b3;
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
    .empty-cart-message {
    text-align: center;
    font-size: 20px;
    color: #555;
    margin-top: 20px;
}

      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         @if(session()->has('message'))
         <div class="alert alert-success">
           <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">X</button>
           {{ session()->get('message') }}

         </div>

       @endif



         <div class="cart-container">
            <h1>Product Cart Details</h1>
            @if($cart->isEmpty())
            <p class="empty-cart-message">Your cart is empty!!</p>
            @else
            <?php
            $totalPrice=0;
            ?>
            
            @foreach ($cart as $cart)
                
            
            <div class="product">
                <img src="/product/{{ $cart->product_image }}" alt="Product 1">
                <div class="product-details">
                    <h2>{{ $cart->product_title }}</h2>
                    <p>{{ $cart->product_description }}</p>
                    <p class="price">${{ $cart->product_price }}</p>
                    <form action="{{ url('update_cart',$cart->id) }}" method="post">
                        @csrf
                        <input type="number" name="cart_quantity" min="1" value="{{ $cart->cart_quantity }}" style="width: 20%;">
                        <button class="add-to-cart-button">Add To Cart</button>
                    </form>
                    <a onclick="return confirm('Are you sure want to delete this?')"  href="{{ url('/remove_cart',$cart->product_id) }}">Remove</a>
                </div>
                
            </div>
            <?php
            $totalPrice=$totalPrice + $cart->product_price;

            ?>
            @endforeach
            <div class="total-price">
                <p>Total: ${{ $totalPrice }}</p>
            </div>
            <h1>Proceed to Checkout</h1>
            <div class="checkout">
                <a href="{{ url('cash_order') }}" class="button">Cash on delevery</a>
            <a href="{{ url('stripe',$totalPrice) }}" class="button">Pay using card</a>
            </div>
            @endif
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