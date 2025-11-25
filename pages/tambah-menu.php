<?php
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($config, "SELECT * FROM menus WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($query);
// var_dump($category);

if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $link = $_POST['link'];
    $icon = $_POST['icon'];
    $order = $_POST['order'];
    $insert = mysqli_query($config, "INSERT INTO menus (name, icon, link, `order`) VALUES 
    ('$name','$icon','$link','$order')");

    header("Location:?page=menu");
}
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $link = $_POST['link'];
    $icon = $_POST['icon'];
    $order = $_POST['order'];
    $update = mysqli_query($config, "UPDATE menus SET `order`='$order', name='$name', icon='$icon',
     link='$link' WHERE id = $id");

    header('location:?page=menu');
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"><?php echo isset($_GET['edit']) ? 'Update' : 'Tambah' ?> Menu</h3>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input placeholder="Enter name" type="text" class="form-control" name="name" value="<?php echo $rowEdit['name'] ?? '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Icon</label>
                        <input placeholder="Enter icon" type="text" class="form-control" name="icon" value="<?php echo $rowEdit['icon'] ?? '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Link</label>
                        <input placeholder="Enter link" type="text" class="form-control" name="link" value="<?php echo $rowEdit['link'] ?? '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Order</label>
                        <input placeholder="Enter order" type="text" class="form-control"
                            name="order" value="<?php echo $rowEdit['order'] ?? '' ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'update' : 'simpan' ?>"><?php echo isset($_GET['edit']) ? 'Edit' : 'Create' ?></button>
                </form>
            </div>
        </div>
    </div>
</div>