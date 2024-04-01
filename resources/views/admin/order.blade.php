<!DOCTYPE html>
<html lang="en">
  <head>

    <style>
        h1 {
    text-align: center;
    position: relative;
    font-weight: bold;
    font-family: Arial, sans-serif;
    color:white;
  }

  h1::after {
    content: "";
    position: absolute;
    bottom: -5px; /* adjust this value to change the distance between the text and underline */
    left: 50%;
    transform: translateX(-50%);
    width: 150px; /* adjust this value to change the width of the underline */
    height: 2px; /* adjust this value to change the thickness of the underline */
    background-color: skyblue;
  }

  table {
    border-collapse: collapse;
    width: 100%;
    border: 2px solid white;
    margin-top: 15px;
  }

  th, td {
    border: 1px solid white;
    padding: 10px;
    text-align: center;
  }

  th {
    background-color: #333;
    color: #fff;
    font-weight: bold;
  }

 
    </style>
    <!-- Required meta tags -->
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper">

                <h1 style="font-size: 30px">All Orders</h1>


                <table>
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Delivered</th>
                        <th>Download</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $order)
                            
                        
                      <tr>
                        <td>{{ $order->user_name }}</td>
                        <td>{{ $order->user_email }}</td>
                        <td>{{ $order->user_phone }}</td>
                        <td>{{ $order->user_address }}</td>
                        <td>{{ $order->product_title }}</td>
                        <td>{{ $order->cart_quantity }}</td>
                        <td>{{ $order->product_price }}</td>
                        <td>
                            <img src="/product/{{ $order->product_image }}" alt="">
                        </td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->delivery_status }}</td>
                        <td>

                            @if ($order->delivery_status=='proccessing')
                                
                            <a onclick="return confirm('Are you sure this product is delivered?')" class="btn btn-primary" href="{{ url('delivered',$order->id) }}">Delivered</a>

                            @else
                            <p style="color:green">Delivered</p>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{ url('print_pdf',$order->id) }}">Print PDF</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>