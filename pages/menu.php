<?php
$query = mysqli_query($config, "SELECT * FROM menus ORDER BY `order` ASC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $q_delete = mysqli_query($config, "DELETE FROM menus WHERE id = $id");
    header("location:?page=level");
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Data Menu</h3>
                <div class="d-flex justify-content-end m-2">
                    <a href="?page=tambah-menu" class="btn btn-primary">Add Menu</a>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Link</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    foreach ($rows as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo $value['icon'] ?></td>
                            <td><?php echo $value['link'] ?></td>
                            <td><?php echo $value['order'] ?></td>
                            <td>
                                <a class="btn btn-success btn-sm" href="?page=tambah-menu&edit=<?php echo $value['id'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a class="btn btn-warning btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data ini??')"
                                    href="?page=menu&delete=<?php echo $value['id'] ?>">
                                    <i class="bi bi-trash"></i>
                                </a>
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