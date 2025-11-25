<?php
$q_products = mysqli_query($koneksi, "SELECT p.*, c.category_name AS c_name FROM products AS p LEFT JOIN categories AS c ON p.category_id = c.id ORDER BY p.id DESC");
$products = mysqli_fetch_all($q_products, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $s_photo = mysqli_query($koneksi, "SELECT product_photo FROM products WHERE id = $id");
    $row = mysqli_fetch_assoc($s_photo);
    $filePath = $row['product_photo'];

    if (file_exists($filePath)) {
        unlink($filePath);
    }
    $delete = mysqli_query($koneksi, "DELETE FROM products WHERE id = $id");
    if ($delete) {
        header("location:?page=product");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Products</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end p-2">
                        <a href="?page=tambah-product" class="btn btn-primary">Tambah</a>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Product Name</th>
                            <th>Photo</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                        foreach ($products as $key => $v) {
                        ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $v['c_name'] ?></td>
                                <td><?php echo $v['product_name'] ?></td>
                                <td>
                                    <img src="<?php echo $v['product_photo'] ?>" width="115">
                                </td>
                                <td>Rp. <?php echo number_format($v['product_price'], 2, ',', '.') ?></td>
                                <td>
                                    <a href="?page=tambah-product&edit=<?php echo $v['id'] ?>" class="btn btn-success btn-sm">
                                        <i class="bi bi-pencil"></i>
                                        Edit</a>
                                    <a href="?page=product&delete=<?php echo $v['id'] ?>" class="btn btn-warning btn-sm" onclick="return confirm('Ingin delete??')">
                                        <i class="bi bi-trash"></i>
                                        Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>