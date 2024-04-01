<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">

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
                    <h1 class="product">Update Product</h1>
                    <form action="{{ url('/update_product_confirm',$product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="title" placeholder="Title" value="{{ $product->title }}" required><br>
                        <textarea name="description" placeholder="Description"  required>{{ $product->description }}</textarea><br>

                        <div>
                            <label style="color:white;" for="">Current Product Image</label>
                            <img style="height:60px; width:60px; margin-left:130px" src="/product/{{ $product->image }}" alt="">
                        </div>
                        <input type="file" name="image"><br>
                        <select name="category" required style="margin-bottom:10px;">
                            <option value="{{ $product->category }}"  selected >{{ $product->category }}</option>
                            @foreach ($category as $category )
                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                            
                            
                        </select><br>
                        <input type="number" name="price" placeholder="Price" value="{{ $product->price }}" required><br>
                        <input type="number" name="discount_price" value="{{ $product->discount_price }}" placeholder="Discount Price"><br>
                        <button onclick="return confirm('Are you sure want to update this product?')" class="add-product-btn" type="submit" id="product-btn">Edit Product</button>
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