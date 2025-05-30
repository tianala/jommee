<?php
require_once '../includes/product_functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Management</title>
    <link href="/public/assets/css/output.css" rel="stylesheet">
    <link rel="icon" href="../assets/logo/logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/fontawesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/lozad"></script>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
</head>

<body class="w-full">
    <div class="w-full">
        <?php include_once '../includes/navbar.php' ?>
    </div>

    <?php
    require_once '../includes/connect_db.php';

    $iduser = $_SESSION['iduser'];
    $usertype = $_SESSION['usertype'];
    $stmt1 = $pdo->prepare("SELECT * FROM `order` WHERE iduser=?");
    $stmt1->execute([$iduser]);
    $orders = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <main class="w-full py-6">
        <div class="w-11/12 md:w-10/12 p-6 mb-3 mx-auto">
            <h1 class="text-5xl font-semibold">Purchases</h1>
        </div>

        <div class="w-11/12 md:w-10/12 mx-auto">
            <?php if ($usertype === 1): ?>
                <table class="w-full table-auto border border-gray-300 bg-white rounded">
                    <thead class="bg-pink-300 text-white">
                        <tr>
                            <th class="py-2 px-4 border">Order ID</th>
                            <th class="py-2 px-4 border">Product Name</th>
                            <th class="py-2 px-4 border">Quantity</th>
                            <th class="py-2 px-4 border">Price</th>
                            <th class="py-2 px-4 border">Date</th>
                            <th class="py-2 px-4 border">Ref. No.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr class="text-center">
                                <td class="py-2 px-4 border"><?= $order['idorder'] ?></td>
                                <td class="py-2 px-4 border"><?= $order['name'] ?></td>
                                <td class="py-2 px-4 border"><?= $order['quantity'] ?></td>
                                <td class="py-2 px-4 border"><?= $order['price'] ?></td>
                                <td class="py-2 px-4 border"><?= date("F j, Y", strtotime($order['created_at'])) ?></td>
                                <td class="py-2 px-4 border"><?= $order['ref_num'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <?php 
                $stmt2 = $pdo->prepare(
                    'SELECT idorder, `order`.iduser AS iduser, user.username AS user, 
                            quantity, name, price, created_at, ref_num
                            FROM `order`
                            INNER JOIN user
                            ON `order`.iduser = user.iduser
                ');
                $stmt2->execute();
                $orderlist = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table class="w-full table-auto border border-gray-300 bg-white rounded">
                    <thead class="bg-pink-300 text-white">
                        <tr>
                            <th class="py-2 px-4 border">Order ID</th>
                            <th class="py-2 px-4 border">Product Name</th>
                            <th class="py-2 px-4 border">User</th>
                            <th class="py-2 px-4 border">Quantity</th>
                            <th class="py-2 px-4 border">Price</th>
                            <th class="py-2 px-4 border">Date</th>
                            <th class="py-2 px-4 border">Ref. No.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderlist as $order): ?>
                            <tr class="text-center">
                                <td class="py-2 px-4 border"><?= $order['idorder'] ?></td>
                                <td class="py-2 px-4 border"><?= $order['name'] ?></td>
                                <td class="py-2 px-4 border"><?= $order['user'] ?></td>
                                <td class="py-2 px-4 border"><?= $order['quantity'] ?></td>
                                <td class="py-2 px-4 border"><?= $order['price'] ?></td>
                                <td class="py-2 px-4 border"><?= date("F j, Y", strtotime($order['created_at'])) ?></td>
                                <td class="py-2 px-4 border"><?= $order['ref_num'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>

    <?php include_once '../includes/footer.php' ?>
</body>

</html>