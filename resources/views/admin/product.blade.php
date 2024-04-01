<!DOCTYPE html>
<html lang="en">
  <head>

    <style>
         .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
            color: black;
        }
        h1 {
            margin-bottom: 20px;
            color: white;
        }
        input[type="text"], input[type="file"], input[type="number"], select, option, textarea {
            padding: 8px;
            width: 100%;
            margin-bottom: 10px;
            box-sizing: border-box;
            
        }
        input[type="file"]{
            color: white;
        }
      
        #product-btn {
        padding: 8px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }
    #product-btn:hover {
        background-color: #0056b3;
    }
        .product{
        margin-bottom: 40px;
        font-size: 20px;
        position: relative;
        display: inline-block;
    }
    .product::after{
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 100%;
        height: 2px;
        background-color: #007bff;
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

                <div class="form-container">
                    <h1 class="product">Add Product</h1>
                    <form action="{{ url('/add_product') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="title" placeholder="Title" required><br>
                        <textarea name="description" placeholder="Description" required></textarea><br>
                        <input type="file" name="image" required><br>
                        <select name="category" required style="margin-bottom:10px;">
                            <option value="" disabled selected >Select category</option>
                            @foreach ($category as $category )
                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                            
                            <!-- Add more options as needed -->
                        </select><br>
                        <input type="number" name="price" placeholder="Price" required><br>
                        <input type="number" name="discount_price" placeholder="Discount Price"><br>
                        <button class="add-product-btn" type="submit" id="product-btn">Add Product</button>
                    </form>
                </div>
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