<!DOCTYPE html>
<html lang="en">
  <head>

    <style>
        td img {
    display: block;
    margin: 0 auto;
    max-width: 100%;
    max-height: 100%;
    vertical-align: middle;
}
#product-img{
    height: 50px;
    width: 60px;
}
.all-product {
    margin-bottom: 40px;
    font-size: 30px;
    text-align: center; /* Center the text */
}

.all-product::after {
    content: '';
    display: block;
    margin: 0 auto; /* Center the line */
    width: 20%; /* Adjust line width as needed */
    height: 2px;
    background-color: #007bff;
    margin-bottom: 20px; /* Adjust margin-bottom as needed */
}



        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            color: #007bff;
        }
        .action-buttons {
            display: flex;
        }
        .edit-button, .delete-button {
            padding: 5px 10px;
            margin-right: 5px;
            color: white;
            border: none;
            cursor: pointer;
        }
        .delete-button{
            background-color: #c43408;

        }
        .edit-button{
            background-color: #11d45c;

        }
        #edit{
            text-decoration: none;
            color: white;
        }
        #delete{
            text-decoration: none;
            color: white;
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
                @if(session()->has('message'))
                <div class="alert alert-success">
                  <button type="submit" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                  {{ session()->get('message') }}

                </div>

              @endif
                <h1 class="all-product">All Products</h1>

                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $product )
                            
                        
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                <img src="/product/{{ $product->image }}" id="product-img">

                            </td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->discount_price }}</td>
                            <td>
                                <button class="edit-button"><a id="delete" href="{{ url('/update_product',$product->id) }}" id="edit" href="">Edit</a></button>
                                <button class="delete-button"><a onclick="return confirm('Are you sure want to delete this product?')" id="delete" href="{{ url('/delete_product',$product->id) }}">Delete</a></button>
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