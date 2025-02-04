<nav class="sidebar">
    <div class="menu-items">
        <?php if ($role == 'manager' || $role == 'admin' || $role == 'student_manager' || $role == 'accountant'): ?>
            <div class="menu-item">
                <div class="menu-title">
                    <i class="fas fa-door-open"></i>
                    <span>Quản lý phòng</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <ul class="submenu">
                    <li><a href="./view_floor_plan.php"><i class="fas fa-map"></i>Xem sơ đồ</a></li>
                    <li><a href="./rooms_list.php"><i class="fas fa-eye"></i>Xem tình trạng</a></li>
                    <li><a href="./manage_rooms.php"><i class="fas fa-cog"></i>Thiết lập tình trạng</a></li>
                    <li><a href="./room_prices.php"><i class="fas fa-dollar-sign"></i>Thiết lập giá</a></li>
                    <li><a href="./statistics.php"><i class="fas fa-chart-line"></i>Thống kê</a></li>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($role == 'manager' || $role == 'admin' || $role == 'student_manager' || $role == 'accountant'): ?>
            <div class="menu-item">
                <div class="menu-title">
                    <i class="fas fa-building"></i>
                    <span>Cơ sở vật chất</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <ul class="submenu">
                    <li><a href="./view_facilities.php"><i class="fas fa-list"></i>Xem cơ sở vật chất</a></li>
                    <li><a href="./manage_facilities.php"><i class="fas fa-tools"></i>Thiết lập cơ sở vật chất</a></li>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($role == 'student_manager' || $role == 'admin' || $role == 'manager' || $role == 'accountant'): ?>
            <div class="menu-item">
                <div class="menu-title">
                    <i class="fas fa-user-graduate"></i>
                    <span>Quản lý sinh viên</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <ul class="submenu">
                    <li><a href="./import_students.php"><i class="fas fa-plus"></i>Thêm sinh viên vào danh sách cư trú</a></li>
                    <li><a href="./students_list.php"><i class="fas fa-edit"></i>Thêm, sửa, xóa sinh viên theo phòng</a></li>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($role == 'accountant' || $role == 'admin' || $role == 'manager' || $role == 'student_manager'): ?>
            <div class="menu-item">
                <div class="menu-title">
                    <i class="fas fa-money-bill"></i>
                    <span>Quản lý thanh toán</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <ul class="submenu">
                    <li><a href="./payments_list.php"><i class="fas fa-tint"></i>Nhập số điện nước theo phòng</a></li>
                    <li><a href="./all_payments.php"><i class="fas fa-file-invoice"></i>Tổng hóa đơn (theo phòng)</a></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>
