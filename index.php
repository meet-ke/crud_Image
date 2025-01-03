<?php
    require ("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    
</head>
<body class="bg-light">
    <div class="container bg-dark text-light p-3 rounded my-4">
        <div class="d-flex align-items-center justify-content-between px-3">
            <h2>
                <a href="index.php" class="text-white text-decoration-none">
                <i class="bi bi-bar-chart-fill"></i> KE Product Store</a>
            </h2>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addproduct">
            <i class="bi bi-plus-lg"></i> Add Product
            </button>
        </div>
    </div>

   <div class="container mt-5">
        <table class="table table-hover text-center">
            <thead class="bg-dark text-light">
                <tr>
                    <th width="10%" scope="col" class="rounded-start">Sr No</th>
                    <th width="15%" scope="col">Image</th>
                    <th width="10%" scope="col">Name</th>
                    <th width="10%" scope="col">Price</th>
                    <th width="35%" scope="col">Description</th>
                    <th width="20%" scope="col" class="rounded-end">Action</th>
                </tr>
            </thead>

            <tbody class="bg-white">
                
                <?php
                   $query = "SELECT * FROM `product`";
                   $result = mysqli_query($con, $query);
                   $i=1;
                   $fetch_src=FETCH_SRC;
  
                   while ($fetch = mysqli_fetch_assoc($result))
                   {
                        echo<<<product
                             <tr class="align-center">
                                <th scope="row">$i</th>
                                <td><img src="$fetch_src$fetch[image]" width="150px"></td>
                                <td>$fetch[name]</td>
                                <td>$fetch[price]</td>
                                <td>$fetch[description]</td>
                                <td>
                                    <a href="?edit=$fetch[id]" class="btn btn-warning me-2"><i class="bi bi-pencil-square"></i></a>
                                    <button onclick="confirm_rem($fetch[id])" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </td>

                            </tr>
                        product;
                        $i++;
                   }
                ?>
            </tbody>
        </table>
   </div>

    <div class="modal fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Price</span>
                        <input type="number" class="form-control" name="price" min="1" required>
                    </div>
               
                    <div class="input-group">
                        <span class="input-group-text">Description</span>
                        <textarea class="form-control" name="desc" required></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="image" accept=".jpeg,.png,.svg" required>
                        <label class="input-group-text" >Image</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" name="addproduct">Add</button>
                </div>
                </div>
            </form>
        </div>
    </div> 

    <div class="modal fade" id="editproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" class="form-control" name="name" id="editname" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Price</span>
                        <input type="number" class="form-control" name="price" id="editprice" min="1" required>
                    </div>
               
                    <div class="input-group">
                        <span class="input-group-text">Description</span>
                        <textarea class="form-control" name="desc" id="editdesc" required></textarea>
                    </div>

                    <img src="" id="editimage" width="100px" class="mb-3"><br>

                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="image" accept=".jpeg,.png,.svg">
                        <label class="input-group-text" >Image</label>
                    </div>
                    <input type="hidden" name="productid" id="editpid">
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" name="editproduct">Edit</button>
                </div>
                </div>
            </form>
        </div>
    </div> 

    <?php
        
        if(isset($_GET['edit']) && $_GET['edit']>0)
        {
            $query = "SELECT * FROM `product` WHERE id='$_GET[edit]'";
            $result = mysqli_query($con, $query);
            $fetch = mysqli_fetch_assoc($result);
            echo "
            <script>
                var myModal = new bootstrap.Modal(document.getElementById('editproduct'),{
                keyboard: true
                });
                document.querySelector('#editname').value=$fetch[name];
                document.querySelector('#editprice').value=$fetch[price];
                document.querySelector('#editdesc').value=$fetch[description];
                document.querySelector('#editimg').src=$fetch_src$fetch[image];
                document.querySelectory('#editpid').value=$fetch[id];
                editproduct.show();
            </script>
            ";
        }
    ?>

    <script>
        function confirm_rem(id){
            if(confirm("Are You Sure, you Want to delete this item ?")){
                window.Location.href="crud.php?rem="+id;
            }
        }
    </script>
</body>
</html>