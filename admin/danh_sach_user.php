<?php
$page = 1;
$search = null;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
$limit = 10;
$start_from = ($page - 1) * $limit;
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sqlkh = "SELECT * FROM khachhang WHERE tenkh LIKE '%$search%' LIMIT $start_from, $limit";
    $sql = "SELECT * FROM khachhang WHERE tenkh LIKE '%$search%'";
} else {
    $sqlkh = "SELECT * FROM khachhang LIMIT $start_from, $limit";
    $sql = "SELECT * FROM khachhang";
}
?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h4 class="mb-4">Danh sách khách hàng</h4>
                <div class="d-flex justify-content-between align-items-center mb-3 row">
                    <a href="?pages=them_user" class="btn btn-outline-info ms-2 col-12 col-lg-3">Thêm khách hàng<i class="ms-2 fa-solid fa-plus"></i></a>
                    <form class="d-md-flex w-50 col-12 col-lg-9" action="" method="get">
                        <input type="hidden" name="pages" value='danh_sach_user'>
                        <input class="form-control bg-dark border-0" type="search" name="search" placeholder="Tìm kiếm..." value="<?= $search ?>">
                        <button type="submit" class="btn btn-square btn-primary ms-2"><i class="fa-solid fa-search"></i></button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark text-center">
                        <thead>
                            <tr>
                                <th scope="col">Mã khách hàng</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Giới tính</th>
                                <th scope="col">Ngày sinh</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Email</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $list = executeList($sqlkh);
                            if (!$list) {
                                echo '<tr><td colspan="10">Không có khách hàng nào!</td></tr>';
                            } {
                                foreach ($list as $kh) { ?>
                                    <tr>
                                        <th scope="row"><?= $kh["idkh"] ?></th>
                                        <td><?= $kh["tenkh"] ?></td>
                                        <td><?= $kh["sdt"] ?></td>
                                        <td><?= $kh["gioitinh"] ?></td>
                                        <td><?= $kh["ngaysinh"] ?></td>
                                        <td><?= $kh["diachi"] ?></td>
                                        <td><?= $kh["email"] ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Mới
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li class="text-center"><a href="xoa_user.php?idkh=<?= $kh["idkh"] ?>" class="d-block btn btn-danger m-1"><i class="fa-solid fa-trash me-3"></i>Xóa</a></li>
                                                    <li class="text-center"><a href="?pages=sua_user&idkh=<?= $kh["idkh"] ?>&tenkh=<?= $kh["tenkh"] ?>&sdt=<?= $kh["sdt"] ?>&gioitinh=<?= $kh["gioitinh"] ?>&ngaysinh=<?= $kh["ngaysinh"] ?>&diachi=<?= $kh["diachi"] ?>&email=<?= $kh["email"] ?>" class="d-block btn btn-light m-1"><i class="fa-solid fa-pen-to-square me-3"></i>Sửa</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php include 'phan_trang.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>