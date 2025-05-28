<?php
require_once '../includes/product_functions.php';
$stmt1 = $pdo->prepare("SELECT * FROM category");
$stmt1->execute();
$categories = $stmt1->fetchAll(PDO::FETCH_ASSOC);
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
            <h1 class="text-5xl font-semibold">Categories</h1>
        </div>

        <div class="bg-pink-100 w-11/12 md:w-10/12 mx-auto ">
            <div class="w-full flex flex-end px-6">
                <button class="ml-auto text-white bg-pink-500 my-4 px-2 py-1 rounded cursor-pointer hover:bg-pink-600"
                    id="add" type="button" onclick="showAddModal()">Add Category</button>
            </div>

            <div
                class=" shadow-md rounded-xl grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-6 w-full">
                <?php foreach ($categories as $category): ?>
                    <div id="category-<?= $category['idcategory'] ?>" data-idcategory="<?= $category['idcategory'] ?>"
                        data-name="<?= $category['name'] ?>" class="category group relative bg-white rounded-lg shadow transition-all duration-200 delay-0 p-4 flex items-center justify-center h-28 cursor-pointer 
           hover:shadow-lg hover:bg-pink-500 hover:text-white 
           [&:not(.showing-options)]:hover:bg-pink-500 
           [&:not(.showing-options)]:hover:text-white">

                        <!-- Options toggle -->
                        <i onclick="showOptions(this)"
                            class="fa-solid fa-ellipsis-vertical cursor-pointer hover:text-pink-200 top-2 right-2 absolute text-lg z-30"></i>

                        <!-- Options menu -->
                        <div
                            class="options-menu absolute top-6 border hidden w-24 p-1 -right-4 text-black bg-white flex-col rounded z-20">
                            <div class="hover:bg-gray-200 w-full border-b edit" id="edit"><i
                                    class="fa-solid fa-pen-to-square mr-2 hover:bg-gray-300"></i>Edit</div>
                            <div class="hover:bg-gray-200 w-full text-red-500 delete" id="delete"><i
                                    class="fa-solid fa-trash mr-2 hover:bg-gray-300"></i>Delete</div>
                        </div>

                        <span class="font-semibold text-2xl text-center hover:scale-105 transform transition-transform">
                            <?= $category['name'] ?>
                        </span>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <!-- Edit Category Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-40 hidden">
        <div class="bg-white rounded-xl p-6 w-11/12 max-w-md shadow-xl">
            <h2 class="text-2xl font-semibold mb-4">Edit Category</h2>
            <form id="editForm">
                <input type="hidden" id="editCategoryId" name="idcategory">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="editCategoryName">Category Name</label>
                    <input type="text" id="editCategoryName" name="name" class="w-full border rounded px-3 py-2"
                        required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 rounded bg-pink-500 text-white hover:bg-pink-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-40 hidden">
        <div class="bg-white rounded-xl p-6 w-11/12 max-w-md shadow-xl">
            <h2 class="text-2xl font-semibold mb-4">Add New Category</h2>
            <form id="addForm">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="addCategoryName">Category Name</label>
                    <input type="text" id="addCategoryName" name="name" class="w-full border rounded px-3 py-2"
                        required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeAddModal()"
                        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 rounded bg-pink-500 text-white hover:bg-pink-600">Add</button>
                </div>
            </form>
        </div>
    </div>

    <?php include_once '../includes/footer.php' ?>
</body>

</html>

<script>
    function showOptions(icon) {
        $('.options-menu').addClass('hidden');
        $('.category').removeClass('showing-options');

        const container = $(icon).closest('.category');
        container.find('.options-menu').removeClass('hidden');
        container.addClass('showing-options');
    }

    function hideAllOptions() {
        $('.options-menu').addClass('hidden');
        $('.category').removeClass('showing-options');
    }

    // Open edit modal and pre-fill data
    $('.edit').on('click', function () {
        const container = $(this).closest('.category');
        const id = container.data('idcategory');
        const name = container.data('name');

        $('#editCategoryId').val(id);
        $('#editCategoryName').val(name);
        $('#editModal').removeClass('hidden');
    });

    // Close edit modal
    function closeEditModal() {
        $('#editModal').addClass('hidden');
    }

    // Handle form submit (you can update this to use AJAX)
    $('#editForm').on('submit', function (e) {
        e.preventDefault();
        const id = $('#editCategoryId').val();
        const name = $('#editCategoryName').val();

        // Placeholder: send to backend via AJAX
        $.post('update_category.php', { idcategory: id, name: name }, function (response) {
            if (response === 'success') {
                location.reload(); // Or update DOM directly
            } else {
                alert('Failed to update category.');
            }
        });

        closeEditModal();
    });

    // Delete confirmation
    $('.delete').on('click', function () {
        const container = $(this).closest('.category');
        const id = container.data('idcategory');

        if (confirm('Are you sure you want to delete this category?')) {
            $.post('../includes/delete_category.php', { idcategory: id }, function (response) {
                if (response === 'success') {
                    location.reload();
                } else {
                    alert('Failed to delete category.');
                }
            });
        }
    });

    function showAddModal() {
        $('#addModal').removeClass('hidden');
    }

    function closeAddModal() {
        $('#addModal').addClass('hidden');
    }

    $('#addForm').on('submit', function (e) {
        e.preventDefault();
        const name = $('#addCategoryName').val();

        $.post('../includes/add_category.php', { name: name }, function (response) {
            if (response === 'success') {
                location.reload(); 
            } else {
                alert('Failed to add category.');
            }
        });

        closeAddModal();
    });


    $(document).on('click', function (event) {
        if (!$(event.target).closest('.options-menu').length && !$(event.target).closest('.fa-ellipsis-vertical').length) {
            hideAllOptions();
        }
    });
</script>