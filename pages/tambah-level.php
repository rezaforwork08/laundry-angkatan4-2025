<?php
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($config, "SELECT * FROM levels WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($query);
// var_dump($category);

if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $insert = mysqli_query($config, "INSERT INTO levels (name) VALUES ('$name')");

    header("Location:?page=level");
}
if (isset($_POST['update'])) {
    $name = $_POST['na$name'];
    $update = mysqli_query($config, "UPDATE levels SET na$name='$name' WHERE id = $id");

    header('location:?page=level');
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"><?php echo isset($_GET['edit']) ? 'Update' : 'Tambah' ?> Level</h3>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input placeholder="Enter Level Name" type="text" class="form-control" name="name" value="<?php echo $category['name'] ?? '' ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'update' : 'simpan' ?>"><?php echo isset($_GET['edit']) ? 'Edit' : 'Create' ?></button>
                </form>
            </div>
        </div>
    </div>
</div>