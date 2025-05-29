<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> - Product Details</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/fontawesome.min.css">
    <link rel="icon" href="../assets/logo/logo1.ico" type="image/x-icon">
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <style>
        .carousel-container {
            scroll-snap-type: x mandatory;
        }

        .carousel-slide {
            scroll-snap-align: start;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            z-index: 50;
            min-width: 160px;
            background-color: white;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .dropdown-menu.show {
            display: block;
        }

        /* Add smooth transition for modal */
        #deleteModal {
            transition: opacity 0.3s ease;
        }

        #deleteModal.hidden {
            opacity: 0;
            pointer-events: none;
        }
    </style>
</head>

<body class="w-full h-screen bg-gray-50">
    <div class="w-full">
        <?php require_once '../includes/navbar.php' ?>
    </div>
    <div class="max-w-7xl mx-auto p-4 md:p-8">

        <!-- Breadcrumb Navigation -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="index.php"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#fc8eac]">
                        Home
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <a href="products.php"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#fc8eac]">
                        Products
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span
                            class="ml-1 text-sm font-medium text-gray-500 md:ml-2"><?= htmlspecialchars($product['name']) ?></span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid md:grid-cols-2 gap-8 bg-white p-6 rounded-lg shadow-md relative">
            <!-- 3-dot menu button -->
            <div class="absolute top-4 right-4 z-10">
                <div class="relative inline-block text-left">
                    <button id="dropdownButton"
                        class="p-2 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fc8eac]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownMenu" class="dropdown-menu">
                        <div class="py-1" role="none">
                            <a href="edit_product.php?id=<?= $id ?>"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                role="menuitem">Edit Product</a>
                            <button onclick="confirmDelete()"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 hover:text-red-900"
                                role="menuitem">Delete Product</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Images Section with Carousel -->
            <div class="relative">
                <!-- Carousel Container -->
                <div class="relative overflow-hidden rounded-lg">
                    <!-- Carousel Slides -->
                    <div id="carousel" class="carousel-container flex transition-transform duration-300 ease-in-out">
                        <?php foreach ($all_images as $index => $image): ?>
                            <div class="carousel-slide w-full flex-shrink-0">
                                <img src="data:image/jpeg;base64,<?= $image ?>"
                                    alt="<?= htmlspecialchars($product['name']) ?> - Image <?= $index + 1 ?>"
                                    class="w-full h-auto max-h-[500px] object-contain rounded-lg">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Navigation Arrows -->
                    <?php if (count($all_images) > 1): ?>
                        <button id="prevBtn"
                            class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/30 text-white rounded-full p-2 hover:bg-black/50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button id="nextBtn"
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/30 text-white rounded-full p-2 hover:bg-black/50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    <?php endif; ?>

                    <!-- Indicators -->
                    <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                        <?php foreach ($all_images as $index => $image): ?>
                            <button
                                class="carousel-indicator w-2 h-2 rounded-full bg-white/50 hover:bg-white/80 transition <?= $index === 0 ? 'bg-white/80' : '' ?>"
                                data-index="<?= $index ?>"></button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Thumbnail Gallery (optional) -->
                <?php if (count($all_images) > 1): ?>
                    <div class="grid grid-cols-5 gap-2 mt-4">
                        <?php foreach ($all_images as $index => $image): ?>
                            <div
                                class="cursor-pointer thumbnail-container <?= $index === 0 ? 'border-2 border-[#fc8eac]' : 'hover:border-2 hover:border-[#fc8eac]' ?> rounded-lg transition">
                                <img src="data:image/jpeg;base64,<?= $image ?>" alt="Thumbnail <?= $index + 1 ?>"
                                    class="w-full h-full object-cover rounded-md" onclick="goToSlide(<?= $index ?>)">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Product Info Section -->
            <div class="space-y-4">
                <h1 class="text-3xl font-bold"><?= htmlspecialchars($product['name']) ?></h1>

                <!-- Price -->
                <div class="mt-4">
                    <div class="text-2xl font-semibold text-[#fc8eac]">₱<?= number_format($product['price'], 2) ?></div>
                    <div class="text-sm text-gray-400 line-through">₱<?= number_format($product['price'] * 1.3, 2) ?>
                    </div>
                    <span class="text-sm text-green-600 ml-2">30% off</span>
                </div>

                <!-- Stock Status -->
                <div class="text-sm <?= $product['stock'] > 0 ? 'text-green-600' : 'text-red-600' ?>">
                    <?= $product['stock'] > 0 ? 'In Stock' : 'Out of Stock' ?>
                </div>

                <!-- Description -->
                <div class="py-4 border-t border-b border-gray-200">
                    <h3 class="font-medium text-lg mb-2">Description</h3>
                    <p class="text-gray-700"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                </div>

                <!-- Quantity Selector -->
                <div class="py-4">
                    <label for="quantity" class="block font-medium mb-2">Quantity:</label>
                    <div class="flex items-center">
                        <button type="button" onclick="decreaseQuantity()"
                            class="bg-gray-200 px-3 py-1 rounded-l-lg hover:bg-gray-300 transition">-</button>
                        <input type="number" id="quantity" name="quantity" value="1" min="1"
                            max="<?= $product['stock'] ?>"
                            class="w-10 text-center border-t border-b border-gray-200 py-1 appearance-none [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                        <button type="button" onclick="increaseQuantity()"
                            class="bg-gray-200 px-3 py-1 rounded-r-lg hover:bg-gray-300 transition">+</button>
                        <span class="ml-4 text-sm text-gray-500"><?= $product['stock'] ?> available</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4 w-full">
                    <form id="direct-checkout" method="POST" action="../includes/checkout_shortcut.php" class="w-1/2">
                        <input type="hidden" name="idproduct" id="selected-item" value="<?= $_GET['id'] ?>">
                        <input type="hidden" name="quantity" id="selected-quantity">
                        <button type="submit" id="checkout"
                            class="w-full bg-[#fc8eac] text-white px-2 py-3 rounded-lg hover:bg-[#e47a98] ">
                            Buy Now
                        </button>
                    </form>
                    <form method="post" action="cart.php" class="w-1/2">
                        <input type="hidden" name="idproduct" value="<?= $id ?>">
                        <input type="hidden" name="quantity" id="formQuantity" value="1">
                        <button type="submit" name="add_to_cart"
                            class="w-full border border-[#fc8eac] text-[#fc8eac] px-2 py-3 rounded-lg hover:bg-[#fc8eac] hover:text-white font-medium">
                            Add to Cart
                        </button>
                    </form>
                </div>

                <!-- Additional Info -->
                <div class="mt-6 text-sm text-gray-500">
                    <div class="flex items-center mb-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Free shipping on orders over ₱1000
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        30-day return policy
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 shadow-xl">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-bold text-gray-800">Confirm Deletion</h3>
                <button onclick="hideDeleteModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="mb-6">
                <p class="text-gray-600">Are you sure you want to delete this item?</p>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="hideDeleteModal()"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
                    Cancel
                </button>
                <button type="button" onclick="proceedWithDeletion()"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <script>
        // Carousel functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.carousel-indicator');
        const carousel = document.getElementById('carousel');

        function updateCarousel() {
            const slideWidth = slides[0].offsetWidth;
            carousel.style.transform = `translateX(-${currentSlide * slideWidth}px)`;

            // Update indicators
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('bg-white/80', index === currentSlide);
                indicator.classList.toggle('bg-white/50', index !== currentSlide);
            });

            // Update thumbnail borders
            updateThumbnailBorders();
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            updateCarousel();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            updateCarousel();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateCarousel();
        }

        // Event listeners
        document.getElementById('nextBtn')?.addEventListener('click', nextSlide);
        document.getElementById('prevBtn')?.addEventListener('click', prevSlide);

        indicators.forEach(indicator => {
            indicator.addEventListener('click', function () {
                goToSlide(parseInt(this.dataset.index));
            });
        });


        function updateThumbnailBorders() {
            const thumbnails = document.querySelectorAll('.thumbnail-container');
            thumbnails.forEach((container, index) => {
                if (index === currentSlide) {
                    container.classList.add('border-2', 'border-[#fc8eac]');
                    container.classList.remove('hover:border-2', 'hover:border-[#fc8eac]');
                } else {
                    container.classList.remove('border-2', 'border-[#fc8eac]');
                    container.classList.add('hover:border-2', 'hover:border-[#fc8eac]');
                }
            });
        }

        // Quantity controls
        function increaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            const formQuantity = document.getElementById('formQuantity');
            const max = parseInt(quantityInput.max);
            let value = parseInt(quantityInput.value);
            if (value < max) {
                quantityInput.value = value + 1;
                formQuantity.value = value + 1;
            }
        }

        function decreaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            const formQuantity = document.getElementById('formQuantity');
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                quantityInput.value = value - 1;
                formQuantity.value = value - 1;
            }
        }

        // Update form quantity when manually typing in input
        document.getElementById('quantity').addEventListener('change', function () {
            document.getElementById('formQuantity').value = this.value;
        });

        // Dropdown menu functionality
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        dropdownButton.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function () {
            dropdownMenu.classList.remove('show');
        });

        // Prevent dropdown from closing when clicking inside it
        dropdownMenu.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        // Confirm delete function
        function showDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function proceedWithDeletion() {
            // Create a form dynamically
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'product_view.php?id=<?= $id ?>';

            // Add the delete_product input
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_product';
            input.value = '1';

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }

        // Update the delete button to use showDeleteModal
        document.querySelector('[onclick="confirmDelete()"]').onclick = showDeleteModal;

        // Initialize carousel
        updateCarousel();

        function updateSelectedQuantity() {
            $('#selected-quantity').val($('#quantity').val());
            $('#formQuantity').val($('#quantity').val());
        }

        function increaseQuantity() {
            let current = parseInt($('#quantity').val());
            let max = parseInt($('#quantity').attr('max'));
            if (current < max) {
                $('#quantity').val(current + 1);
                updateSelectedQuantity();
            }
        }

        function decreaseQuantity() {
            let current = parseInt($('#quantity').val());
            if (current > 1) {
                $('#quantity').val(current - 1);
                updateSelectedQuantity();
            }
        }

        $(document).ready(function () {
            $('#quantity').on('input', function () {
                updateSelectedQuantity();
            });

            updateSelectedQuantity();
        });

    </script>
</body>

</html>
<?php include '../includes/footer.php'; ?>