<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// session_start();
include __DIR__ . '\db_connect.php';
require '../vendor/autoload.php';

// Kiểm tra quyền truy cập
// if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['manager', 'student_manager', 'accountant'])) {
//     $_SESSION['error'] = "Bạn không có quyền truy cập.";
//     header('Location: login.php');
//     exit();
// }

if (isset($_GET['payment_id'])) {
    $payment_id = filter_input(INPUT_GET, 'payment_id', FILTER_VALIDATE_INT);
    if ($payment_id === false) {
        $_SESSION['error'] = "ID hóa đơn không hợp lệ.";
        header('Location: view_payments.php?room_id=' . urlencode($_GET['room_id']));
        exit();
    }

    // Truy vấn hóa đơn
    $sql_payment = "SELECT p.*, r.building, r.room_number FROM Payments p JOIN Rooms r ON p.room_id = r.room_id WHERE p.payment_id = ?";
    $stmt_payment = $conn->prepare($sql_payment);
    $stmt_payment->bind_param("i", $payment_id);
    $stmt_payment->execute();
    $result_payment = $stmt_payment->get_result();
    $payment = $result_payment->fetch_assoc();

    if (!$payment) {
        $_SESSION['error'] = "Hóa đơn không tồn tại.";
        header('Location: view_payments.php?room_id=' . urlencode($_GET['room_id']));
        exit();
    }

    // Tạo PDF
    $pdf = new TCPDF();
    $pdf->AddPage();
    $html = '<h1>Hóa Don Thanh Toán</h1>';
    $html .= '<p>Tòa nhà: ' . htmlspecialchars($payment['building']) . '</p>';
    $html .= '<p>Phòng: ' . htmlspecialchars($payment['room_number']) . '</p>';
    $html .= '<p>Tháng: ' . date('m/Y', strtotime($payment['payment_date'])) . '</p>';
    $html .= '<table border="1" cellpadding="4">
                <tr>
                    <th>Số điện (kWh)</th>
                    <th>Số nước (m³)</th>
                    <th>Tổng tiền (VNĐ)</th>
                    <th>Trạng thái</th>
                </tr>
                <tr>
                    <td>' . htmlspecialchars($payment['electricity_usage']) . '</td>
                    <td>' . htmlspecialchars($payment['water_usage']) . '</td>
                    <td>' . number_format($payment['total_amount'], 0, ',', '.') . '</td>
                    <td>' . htmlspecialchars($payment['payment_status'] == 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán') . '</td>
                </tr>
              </table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('invoice_' . $payment['payment_code'] . '.pdf', 'D');
} else {
    $_SESSION['error'] = "Không tìm thấy ID hóa đơn.";
    header('Location: payments_list.php');
    exit();
}
?>
