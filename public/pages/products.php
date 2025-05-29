<?php
if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['logged_in'] == true) {
        $usertype = $_SESSION['usertype'];
    }
}

require_once '../includes/product_functions.php';
$products = handleProductOperations($pdo);
include_once '../includes/connect_db.php';
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
<div class="w-full">
    <?php require_once '../includes/navbar.php' ?>
</div>

<body class="bg-gray-50 p-6">

    <div class="bg-white shadow rounded m-auto mt-4 md:w-10/12 p-2 px-4 w-11/12">

        <?php if ($usertype === 0): ?>
            <div class="flex justify-end items-center my-6 mr-3">
                <button onclick="document.getElementById('addModal').showModal()"
                    class="bg-[#fc8eac] hover:bg-[#e75480] text-white text-xs sm:text-base px-3 sm:px-4 py-1.5 sm:py-2 rounded sm:rounded-lg transition">
                    <i class="fas fa-plus mr-1 sm:mr-2"></i>Add Product
                </button>
            </div>
        <?php endif; ?>

        <div
            class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 sm:gap-1 md:gap-2 lg:gap-4 sm:mb-5 md:mb-5">
            <?php foreach ($products as $row): ?>
                <div class="bg-white rounded-xl shadow-md p-2 sm:p-6 flex flex-col text-center relative w-full max-w-[180px] sm:max-w-[200px] md:max-w-none"
                    id="item-<?= $row['idproduct'] ?>" data-idproduct="<?= $row['idproduct'] ?>"
                    data-name="<?= $row['name'] ?>" data-description="<?= $row['description'] ?>"
                    data-idcategory="<?= $row['idcategory'] ?>" data-description="<?= $row['description'] ?>"
                    data-stock="<?= $row['stock'] ?>" data-price="<?= $row['price'] ?>"
                    data-main_img="<?= base64_encode($row['main_img']) ?>">

                    <?php if ($usertype === 0): ?>
                        <div class="absolute right-3 top-3 dropdown w-4 h-4">
                            <button class="text-gray-500 hover:text-gray-700 focus:outline-none"
                                onclick="event.stopPropagation()">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-10"
                                onclick="event.stopPropagation()">
                                <a a href="edit_product.php?id=<?= $row['idproduct'] ?>"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                                <button
                                    onclick="event.stopPropagation(); openDeleteModal('<?= $row['idproduct'] ?>', '<?= htmlspecialchars($row['name']) ?>')"
                                    class="flex items-center px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-md transition-colors duration-200 w-full text-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php $image = getProductImage($row); ?>
                    <?php if ($image): ?>
                        <div
                            class="w-full h-40 sm:h-36 md:h-44 lg:h-48 mb-3 sm:mb-4 flex items-center justify-center overflow-hidden">
                            <img data-src="<?= $image ?>" alt="<?= htmlspecialchars($row['name']) ?>"
                                class="w-full h-full object-contain lozad">
                        </div>
                    <?php else: ?>
                        <div
                            class="w-full h-40 sm:h-36 md:h-44 lg:h-48 bg-gray-200 mb-3 sm:mb-4 flex items-center justify-center">
                            <span class="text-gray-500 text-sm">No image</span>
                        </div>
                    <?php endif; ?>

                    <div class="text-left">
                        <h2 class="text-xs sm:text-sm font-medium mb-1 truncate h-5"
                            title="<?= htmlspecialchars($row['name']) ?>">
                            <?= htmlspecialchars($row['name']) ?>
                        </h2>
                    </div>

                    <p class="text-[0.8rem] sm:text-[0.9rem] text-[#cd1c1c] font-semibold mb-1 text-left">
                        ₱<?= number_format($row['price'], 2) ?></p>
                    <a class="text-xs text-left hover:text-pink-400 text-gray-600"
                        href="product_view.php?id=<?= $row['idproduct'] ?>"><span>View Product</span></a>

                </div>
            <?php endforeach; ?>
        </div>

        <!-- Add Product Modal -->
        <dialog id="addModal" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
            <form method="POST" class="space-y-4" enctype="multipart/form-data">
                <h2 class="text-xl font-bold mb-4">Add New Product</h2>

                <div>
                    <input type="file" name="image" id="add_image" accept="image/*"
                        class="w-full hidden px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"
                        onchange="previewAddImage(event)">
                    <h4 class="block text-sm font-medium text-gray-700 mb-1">Product Image:</h4>
                    <div class="w-full h-60 rounded border border-pink-400 relative">
                        <img id="add_image_preview" src="" alt="Image Preview"
                            class="m-auto h-full object-contain hidden rounded-md" />
                        <label
                            class="absolute bottom-1 right-1 text-sm font-medium mb-1 px-2 py-1 rounded bg-pink-500 text-white cursor-pointer"
                            for="add_image"><i class="fa-solid fa-upload"></i></label>
                    </div>
                </div>

                <h4 class="block text-sm font-medium text-gray-700 mb-1">Carousel Images:</h4>
                <div class="w-full grid grid-cols-2 gap-2">
                    <input type="file" name="img1" id="add_img1" accept="image/*"
                        class="w-full hidden px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"
                        onchange="previewAddImg1(event)">
                    <input type="file" name="img2" id="add_img2" accept="image/*"
                        class="w-full hidden px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"
                        onchange="previewAddImg2(event)">
                    <input type="file" name="img3" id="add_img3" accept="image/*"
                        class="w-full hidden px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"
                        onchange="previewAddImg3(event)">
                    <input type="file" name="img4" id="add_img4" accept="image/*"
                        class="w-full hidden px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"
                        onchange="previewAddImg4(event)">

                    <div class="relative w-full h-32 border border-pink-400 rounded">
                        <img id="add_img1_preview" src="" alt="Image Preview"
                            class="h-full object-contain hidden rounded-md m-auto" />
                        <label
                            class="absolute bottom-1 right-1 text-sm font-medium mb-1 px-2 py-1 rounded bg-pink-500 text-white cursor-pointer"
                            for="add_img1"><i class="fa-solid fa-upload"></i></label>
                    </div>
                    <div class="relative w-full h-32 border border-pink-400 rounded">
                        <img id="add_img2_preview" src="" alt="Image Preview"
                            class="h-full object-contain hidden rounded-md m-auto" />
                        <label
                            class="absolute bottom-1 right-1 text-sm font-medium mb-1 px-2 py-1 rounded bg-pink-500 text-white cursor-pointer"
                            for="add_img2"><i class="fa-solid fa-upload"></i></label>
                    </div>
                    <div class="relative w-full h-32 border border-pink-400 rounded">
                        <img id="add_img3_preview" src="" alt="Image Preview"
                            class="h-full object-contain hidden rounded-md m-auto" />
                        <label
                            class="absolute bottom-1 right-1 text-sm font-medium mb-1 px-2 py-1 rounded bg-pink-500 text-white cursor-pointer"
                            for="add_img3"><i class="fa-solid fa-upload"></i></label>
                    </div>
                    <div class="relative w-full h-32 border border-pink-400 rounded">
                        <img id="add_img4_preview" src="" alt="Image Preview"
                            class="h-full object-contain hidden rounded-md m-auto" />
                        <label
                            class="absolute bottom-1 right-1 text-sm font-medium mb-1 px-2 py-1 rounded bg-pink-500 text-white cursor-pointer"
                            for="add_img4"><i class="fa-solid fa-upload"></i></label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                    <input type="text" name="name" required
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                    <input type="number" name="price" required step="0.01"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]">
                </div>

                <div>
                    <label for="add_category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select id="add_category" name="idcategory" required
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]">
                        <option value="" hidden>Choose a category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['idcategory'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock:</label>
                    <input type="number" name="stock" required step="0.01"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]">
                </div>

                <div>
                    <label for="add_description"
                        class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="add_description" name="description" rows="5"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac] resize-none"></textarea>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="document.getElementById('addModal').close()"
                        class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button type="submit" name="add_product"
                        class="bg-[#fc8eac] hover:bg-[#e75480] text-white px-4 py-2 rounded-lg transition">
                        Add Product
                    </button>
                </div>
            </form>
        </dialog>

        <!-- Edit Product Modal -->
        <dialog id="editModal" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md hidden">
            <form id="editForm" method="POST" class="space-y-4" enctype="multipart/form-data">
                <h2 class="text-xl font-bold mb-4">Edit Product</h2>
                <input type="hidden" name="idproduct" id="edit_idproduct">

                <div>
                    <input type="file" name="image" id="edit_image" accept="image/*"
                        class="w-full hidden px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"
                        onchange="previewAddImage(event)">
                    <h4 class="block text-sm font-medium text-gray-700 mb-1">Product Image:</h4>
                    <div class="w-full h-60 rounded border border-pink-400 relative">
                        <img id="edit_image_preview" src="" alt="Image Preview"
                            class="m-auto h-full object-contain hidden rounded-md" />
                        <label
                            class="absolute bottom-1 right-1 text-sm font-medium mb-1 px-2 py-1 rounded bg-pink-500 text-white cursor-pointer"
                            for="edit_image"><i class="fa-solid fa-upload"></i></label>
                    </div>
                </div>

                <h4 class="block text-sm font-medium text-gray-700 mb-1">Carousel Images:</h4>
                <div class="w-full grid grid-cols-2 gap-2">
                    <input type="file" name="img1" id="edit_img1" accept="image/*"
                        class="w-full hidden px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"
                        onchange="previewAddImg1(event)">
                    <input type="file" name="img2" id="edit_img2" accept="image/*"
                        class="w-full hidden px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"
                        onchange="previewAddImg2(event)">
                    <input type="file" name="img3" id="edit_img3" accept="image/*"
                        class="w-full hidden px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"
                        onchange="previewAddImg3(event)">
                    <input type="file" name="img4" id="edit_img4" accept="image/*"
                        class="w-full hidden px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"
                        onchange="previewAddImg4(event)">

                    <div class="relative w-full h-32 border border-pink-400 rounded">
                        <img id="edit_img1_preview" src="" alt="Image Preview"
                            class="h-full object-contain hidden rounded-md m-auto" />
                        <label
                            class="absolute bottom-1 right-1 text-sm font-medium mb-1 px-2 py-1 rounded bg-pink-500 text-white cursor-pointer"
                            for="edit_img1"><i class="fa-solid fa-upload"></i></label>
                    </div>
                    <div class="relative w-full h-32 border border-pink-400 rounded">
                        <img id="edit_img2_preview" src="" alt="Image Preview"
                            class="h-full object-contain hidden rounded-md m-auto" />
                        <label
                            class="absolute bottom-1 right-1 text-sm font-medium mb-1 px-2 py-1 rounded bg-pink-500 text-white cursor-pointer"
                            for="edit_img2"><i class="fa-solid fa-upload"></i></label>
                    </div>
                    <div class="relative w-full h-32 border border-pink-400 rounded">
                        <img id="edit_img3_preview" src="" alt="Image Preview"
                            class="h-full object-contain hidden rounded-md m-auto" />
                        <label
                            class="absolute bottom-1 right-1 text-sm font-medium mb-1 px-2 py-1 rounded bg-pink-500 text-white cursor-pointer"
                            for="edit_img3"><i class="fa-solid fa-upload"></i></label>
                    </div>
                    <div class="relative w-full h-32 border border-pink-400 rounded">
                        <img id="edit_img4_preview" src="" alt="Image Preview"
                            class="h-full object-contain hidden rounded-md m-auto" />
                        <label
                            class="absolute bottom-1 right-1 text-sm font-medium mb-1 px-2 py-1 rounded bg-pink-500 text-white cursor-pointer"
                            for="edit_img4"><i class="fa-solid fa-upload"></i></label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                    <input id="edit_name" type="text" name="name" required
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                    <input id="edit_price" type="number" name="price" required step="0.01"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]">
                </div>

                <div>
                    <label for="edit_idcategory" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select id="edit_idcategory" name="idcategory" required
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]">
                        <option value="" hidden>Choose a category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['idcategory'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock:</label>
                    <input type="number" name="stock" id="edit_stock" required step="0.01"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]">
                </div>

                <div>
                    <label for="edit_description"
                        class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="edit_description" name="description" rows="5"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac] resize-none"></textarea>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button type="submit" name="edit_product"
                        class="bg-[#fc8eac] hover:bg-[#e75480] text-white px-4 py-2 rounded-lg transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </dialog>


        <div id="deleteModal"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Confirm Deletion</h3>
                        <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-gray-600 mb-6">Are you sure you want to delete this item?</p>
                    <div class="flex justify-end space-x-3">
                        <button onclick="closeDeleteModal()"
                            class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-md border border-gray-300 transition-colors duration-200">
                            Cancel
                        </button>
                        <a id="confirmDeleteBtn" href="#"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors duration-200">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        const observer = lozad();
        observer.observe();

        // Dropdown menu functionality
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            const button = dropdown.querySelector('button');
            const menu = dropdown.querySelector('.dropdown-menu');

            button.addEventListener('click', (e) => {
                e.stopPropagation();
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    if (m !== menu) m.classList.add('hidden');
                });
                menu.classList.toggle('hidden');
            });
        });

        // Add this to your existing JavaScript
        document.addEventListener('DOMContentLoaded', function () {
            // Handle product card clicks
            document.querySelectorAll('[data-id]').forEach(card => {
                card.addEventListener('click', function (e) {
                    // Only navigate if the click wasn't on a dropdown or its children
                    if (!e.target.closest('.dropdown') && !e.target.closest('.dropdown-menu')) {
                        window.location.href = `product_view.php?id=${card.dataset.id}`;
                    }
                });
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
        });

        // Image preview functions
        function previewAddImage(event) {
            const preview = document.getElementById('add_image_preview');
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        }

        function previewAddImg1(event) {
            const preview = document.getElementById('add_img1_preview');
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        }

        function previewAddImg2(event) {
            const preview = document.getElementById('add_img2_preview');
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        }

        function previewAddImg3(event) {
            const preview = document.getElementById('add_img3_preview');
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        }

        function previewAddImg4(event) {
            const preview = document.getElementById('add_img4_preview');
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        }

        // function previewEditImage(event) {
        //     const newPreview = document.getElementById('new_image_preview');
        //     const currentPreview = document.getElementById('current_image_preview');
        //     const file = event.target.files[0];

        //     if (file) {
        //         newPreview.src = URL.createObjectURL(file);
        //         newPreview.classList.remove('hidden');
        //         currentPreview.classList.add('hidden');
        //     } else {
        //         newPreview.src = '';
        //         newPreview.classList.add('hidden');
        //         currentPreview.classList.remove('hidden');
        //     }
        // }

        // Edit modal function
        function openEditModal(idproduct) {
            $('#editModal').removeClass('hidden');
            let product = $('#item-' + idproduct);
            let name = product.data('name');
            let description = product.data('description');
            let price = product.data('price');
            let stock = product.data('stock');
            let idcategory = product.data('idcategory');
            let main_img = product.data('main_img');

            $('#edit_idproduct').val(idproduct);
            $('#edit_name').val(name);
            $('#edit_description').val(description);
            $('#edit_price').val(price);
            $('#edit_stock').val(stock);
            $('#edit_idcategory').val(idcategory);
            $('#edit_image_preview').attr('src', 'data:image/jpeg;base64,' + main_img);
            document.getElementById('editModal').showModal();



            $.ajax({
                url: 'get_carousel.php',
                method: 'GET',
                data: { idproduct: idproduct },
                success: function (response) {
                    console.log('AJAX response:', response); // Debug log
                    try {
                        let images = JSON.parse(response);
                        if (images.img1) {
                            let img1 = 'data:image/jpeg;base64,' + images.img1;
                            $('#edit_img1_preview').attr('src', img1);
                        }

                        if (images.img2) {
                            let img2 = 'data:image/jpeg;base64,' + images.img2;
                            $('#edit_img2_preview').attr('src', img2);
                        }

                        if (images.img3) {
                            let img3 = 'data:image/jpeg;base64,' + images.img3;
                            $('#edit_img3_preview').attr('src', img3);
                        }

                        if (images.img4) {
                            let img4 = 'data:image/jpeg;base64,' + images.img4;
                            $('#edit_img4_preview').attr('src', img4);
                        }
                    } catch (e) {
                        console.error("JSON parse error:", e.message);
                    }

                }
            });
        }

        function openDeleteModal(id, name) {
            event.stopPropagation();
            const modal = document.getElementById('deleteModal');
            const confirmBtn = document.getElementById('confirmDeleteBtn');

            confirmBtn.href = `?delete=${id}`;
            modal.classList.remove('hidden');
        }

        function closeEditModal() {
            $('#editModal').addClass('hidden');
            $('#editForm')[0].reset();
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                closeDeleteModal();
            }


        });

        $(document).ready(function () {
            const observer = lozad();
            observer.observe();
        })
    </script>
</body>

</html>
<?php include '../includes/footer.php'; ?>

?>