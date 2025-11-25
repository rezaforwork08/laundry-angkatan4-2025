<?php
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($config, "SELECT * FROM levels WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($query);

$level_id = $rowEdit['id'];

$queryMenus = mysqli_query($config, "SELECT * FROM menus ORDER BY id DESC");
$rowMenus   = mysqli_fetch_all($queryMenus, MYSQLI_ASSOC);

$selectedMenu = mysqli_query($config, "SELECT * FROM level_menus WHERE level_id='$level_id'");
$selectedMenuIds = [];
$rowSelectedMenus = mysqli_fetch_all($selectedMenu, MYSQLI_ASSOC);
foreach ($rowSelectedMenus as $selectedMenus) {
    $selectedMenuIds[] = $selectedMenus['menu_id'];
}

if (isset($_POST['save'])) {
    $level_id = $_POST['level_id'];
    $menu_id = $_POST['menu_id'];

    mysqli_query($config, "DELETE FROM level_menus WHERE level_id ='$level_id'");

    foreach ($menu_id as $key => $menu) {
        $insert = mysqli_query($config, "INSERT INTO level_menus (menu_id, level_id) VALUES ('$menu','$level_id')");
    }
    header("Location:?page=level&tambah=success");
}

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"><?php echo isset($_GET['edit']) ? 'Update' : 'Tambah' ?> Level</h3>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Level Name</label>
                        <input placeholder="Enter Level Name"
                            type="text" class="form-control"
                            value="<?php echo $rowEdit['name'] ?? '' ?>" readonly>

                        <input type="hidden" name="level_id" value="<?php echo $rowEdit['id'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <?php foreach ($rowMenus as $menu): ?>
                            <label for="" class="form-label">
                                <input type="checkbox"
                                    name="menu_id[]"
                                    value="<?php echo $menu['id'] ?>"
                                    <?php echo in_array($menu['id'], $selectedMenuIds) ? 'checked' : '' ?>> <?php echo $menu['name'] ?>
                            </label>
                            <br>
                        <?php endforeach ?>
                    </div>
                    <button type="submit" class="btn btn-primary" name="save">Save Change</button>
                </form>
            </div>
        </div>
    </div>
</div>