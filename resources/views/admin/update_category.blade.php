<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">

    <style>
  .form-container {
        text-align: center;
        
    }
    .category{
        margin-bottom: 40px;
        font-size: 20px;
        position: relative;
        display: inline-block;
    }
    .category::after{
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 100%;
        height: 2px;
        background-color: #007bff;
    }
    input[type="text"] {
        padding: 8px;
        width: 200px;
        margin-right: 10px;
        color: black;
    }
    #category-btn {
        padding: 8px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }
    #category-btn:hover {
        background-color: #0056b3;
    }
    table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            
        }

        

        .action-buttons {
            display: flex;
            justify-content: center;

        }


        .action-buttons button {
            padding: 6px 12px;
            
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-right: 10px;
        }
        .action-buttons #edit{
          background-color: #0ccf6d;
        }
        .action-buttons  #delete{
          background-color: #d61324;
        }
        .action-buttons  #delete a{
          text-decoration: none;
          color: white;
        }
        .action-buttons  #edit a{
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
               
                <div class="form-container">
                    <h1 class="category">Update Category</h1>
                    <form action="{{ url('/update_category_confirm',$data->id) }}" method="post">
                      @csrf
                        <input type="text" name="category_name" value="{{ $data->category_name }}" placeholder="Enter category">
                        <button onclick="return confirm('Are you sure want to update this?')" type="submit" id="category-btn">Update Category</button>
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