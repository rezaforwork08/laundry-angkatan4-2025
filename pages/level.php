<?php
$query = mysqli_query($config, "SELECT * FROM levels");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $q_delete = mysqli_query($config, "DELETE FROM levels WHERE id = $id");
    header("location:?page=level");
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Data Level</h3>
                <div class="d-flex justify-content-end m-2">
                    <a href="?page=tambah-level" class="btn btn-primary">Add Level</a>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    foreach ($rows as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td>
                                <a class="btn btn-danger btn-sm" href="?page=add-role-menu&edit=<?php echo $value['id'] ?>">
                                    <i class="bi bi-plus"></i>
                                </a>
                                <a class="btn btn-success btn-sm" href="?page=tambah-level&edit=<?php echo $value['id'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a class="btn btn-warning btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data ini??')"
                                    href="?page=level&delete=<?php echo $value['id'] ?>">
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