<?php
require_once '../includes/product_functions.php';
$stmt1 = $pdo->prepare("SELECT * FROM user");
$stmt1->execute();
$users = $stmt1->fetchAll(PDO::FETCH_ASSOC);
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

    <main class="w-full py-6">
        <div class="w-11/12 md:w-10/12 p-6 mb-3 mx-auto">
            <h1 class="text-5xl font-semibold">Users</h1>
        </div>

        <div class="w-11/12 md:w-10/12 mx-auto">
            <div class="w-full flex flex-end px-6">
                <button class="ml-auto text-white bg-pink-500 my-4 px-2 py-1 rounded cursor-pointer hover:bg-pink-600"
                    id="add" type="button" onclick="showAddModal()">Add User</button>
            </div>


            <table class="min-w-full table-auto border border-gray-300 bg-white rounded">
                <thead class="bg-pink-300 text-white">
                    <tr>
                        <th class="py-2 px-4 border">ID</th>
                        <th class="py-2 px-4 border">User Type</th>
                        <th class="py-2 px-4 border">Username</th>
                        <th class="py-2 px-4 border">Email</th>
                        <th class="py-2 px-4 border">Contact #</th>
                        <th class="py-2 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr class="text-center <?= $user['usertype'] == 1 ? 'text-black' : 'text-blue-600' ?>">
                            <td class="py-2 px-4 border"><?= $user['iduser'] ?></td>
                            <td class="py-2 px-4 border"><?= $user['usertype'] == 1 ? 'User' : 'Admin' ?></td>
                            <td class="py-2 px-4 border"><?= $user['username'] ?></td>
                            <td class="py-2 px-4 border"><?= $user['email'] ?></td>
                            <td class="py-2 px-4 border"><?= $user['contact_num'] ?></td>
                            <td class="py-2 px-4 border">
                                <button class="text-blue-600 mr-2"
                                    onclick="openEditUserModal(<?= htmlspecialchars(json_encode($user)) ?>)">Edit</button>
                                <button class="text-red-600" onclick="deleteUser(<?= $user['iduser'] ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </main>

    <div id="editUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-40 hidden">
        <div class="bg-white p-6 rounded-lg shadow-md w-11/12 max-w-md">
            <h2 class="text-2xl font-bold mb-4">Edit User</h2>
            <form id="editUserForm">
                <input type="hidden" name="iduser" id="editIdUser">
                <div class="mb-4">
                    <label for="editUsername">Username</label>
                    <input type="text" id="editUsername" name="username" class="w-full border px-3 py-2 rounded"
                        required>
                </div>
                <div class="mb-4">
                    <label for="editEmail">Email</label>
                    <input type="email" id="editEmail" name="email" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editUserType">User Type</label>
                    <select type="usertype" id="editUserType" name="usertype" class="w-full border px-3 py-2 rounded"
                        required>
                        <option value="0">Admin</option>
                        <option value="1">User</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="editContact">Contact #</label>
                    <input type="text" id="editContact" name="contact_num" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="$('#editUserModal').addClass('hidden')"
                        class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                    <button type="submit"
                        class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div id="addUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-40 hidden">
        <div class="bg-white p-6 rounded-lg shadow-md w-11/12 max-w-md">
            <h2 class="text-2xl font-bold mb-4">Add User</h2>
            <form id="addUserForm">
                <div class="mb-4">
                    <label for="addUsername">Username</label>
                    <input type="text" id="addUsername" name="username" class="w-full border px-3 py-2 rounded"
                        required>
                </div>
                <div class="mb-4">
                    <label for="addEmail">Email</label>
                    <input type="email" id="addEmail" name="email" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addUserType">User Type</label>
                    <select id="addUserType" name="usertype" class="w-full border px-3 py-2 rounded" required>
                        <option value="0">Admin</option>
                        <option value="1" selected>User</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="addContact">Contact #</label>
                    <input type="text" id="addContact" name="contact_num" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="$('#addUserModal').addClass('hidden')"
                        class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                    <button type="submit"
                        class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded">Add</button>
                </div>
            </form>
        </div>
    </div>



    <?php include_once '../includes/footer.php' ?>
</body>

</html>

<script>
    function openEditUserModal(user) {
        $('#editIdUser').val(user.iduser);
        $('#editUsername').val(user.username);
        $('#editEmail').val(user.email);
        $('#editContact').val(user.contact_num);
        $('#editUserType').val(user.usertype);
        $('#editUserModal').removeClass('hidden');
    }

    $('#editUserForm').on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.post('../includes/update_user.php', formData, function (response) {
            if (response === 'success') {
                location.reload();
            } else {
                alert('Update failed');
            }
        });
    });

    function deleteUser(id) {
        if (confirm('Are you sure you want to delete this user?')) {
            $.post('../includes/delete_user.php', { iduser: id }, function (response) {
                if (response === 'success') {
                    location.reload();
                } else {
                    alert('Delete failed');
                }
            });
        }
    }

    function showAddModal() {
        $('#addUserModal').removeClass('hidden');
    }

    $('#addUserForm').on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.post('../includes/add_user.php', formData, function (response) {
            if (response === 'success') {
                location.reload();
            } else {
                alert('Failed to add user');
            }
        });
    });

</script>