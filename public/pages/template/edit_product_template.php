<?php
function displayBreadcrumbs($productName)
{
    ?>
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="index.php" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#fc8eac]">
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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit
                        <?= htmlspecialchars($productName) ?></span>
                </div>
            </li>
        </ol>
    </nav>
    <?php
}

function displaySuccessMessage($id)
{
    ?>
    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative">
        <p>Product updated successfully!</p>
        <button onclick="window.location.href='products.php'"
            class="absolute top-2 right-2 text-green-700 hover:text-green-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="mt-2 flex gap-2">
            <button onclick="window.location.href='products.php'"
                class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                Back to Products
            </button>
            <button onclick="window.location.href='product_view.php?id=<?= $id ?>'"
                class="px-3 py-1 bg-white text-green-600 border border-green-600 rounded hover:bg-green-50 text-sm">
                View Item
            </button>
        </div>
    </div>
    <?php
}

function displayImageCarousel($all_images, $productName, $errors)
{
    ?>
    <div class="space-y-6">
        <div class="relative">
            <div class="relative overflow-hidden rounded-lg">
                <div id="carousel" class="carousel-container flex transition-transform duration-300 ease-in-out">
                    <?php foreach ($all_images as $index => $image): ?>
                        <div class="carousel-slide w-full flex-shrink-0">
                            <img src="data:image/jpeg;base64,<?= $image ?>"
                                alt="<?= htmlspecialchars($productName) ?> - Image <?= $index + 1 ?>"
                                class="w-full h-auto max-h-[500px] object-contain rounded-lg" id="current-image-<?= $index ?>">
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (count($all_images) > 1): ?>
                    <button type="button" id="prevBtn"
                        class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/30 text-white rounded-full p-2 hover:bg-black/50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button type="button" id="nextBtn"
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/30 text-white rounded-full p-2 hover:bg-black/50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                <?php endif; ?>
            </div>

            <div class="mt-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Main Image</label>
                    <input type="file" name="main_img" accept="image/*" class="image-upload block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-[#fc8eac] file:text-white
                        hover:file:bg-[#e47a98]" data-preview-target="current-image-0">
                    <div id="main-img-preview" class="mt-2 hidden">
                        <img id="main-img-preview-img" class="mt-1 max-h-40 rounded-lg border border-gray-200">
                    </div>
                    <?php if (isset($errors['main_img'])): ?>
                        <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['main_img']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image <?= $i ?></label>
                            <input type="file" name="img<?= $i ?>" accept="image/*" class="image-upload block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-gray-100 file:text-gray-700
                            hover:file:bg-gray-200" data-preview-target="current-image-<?= $i ?>">
                            <div id="img<?= $i ?>-preview" class="mt-2 hidden">
                                <p class="text-sm text-gray-500">New image preview:</p>
                                <img id="img<?= $i ?>-preview-img" class="mt-1 max-h-40 rounded-lg border border-gray-200">
                            </div>
                            <?php if (isset($errors['img' . $i])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['img' . $i]) ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
function displayProductForm($product, $errors, $categories, $res)
{
    ?>
    <div class="space-y-6">
        <h1 class="text-3xl font-bold">Edit Product</h1>

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" id="name" name="name"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#fc8eac] focus:ring focus:ring-[#fc8eac] focus:ring-opacity-50 p-2 border">
            <?php if (isset($product['name'])): ?>
                <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($product['name']) ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">₱</span>
                </div>
                <input type="number" step="0.01" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>"
                    class="block w-full pl-7 pr-12 rounded-md border-gray-300 focus:border-[#fc8eac] focus:ring focus:ring-[#fc8eac] focus:ring-opacity-50 p-2 border">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">PHP</span>
                </div>
            </div>
            <?php if (isset($errors['price'])): ?>
                <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['price']) ?></p>
            <?php endif; ?>
        </div>

        <!-- Category -->

        <div class="">
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category" name="category" required value="<?= $res['idcateg'] ?>"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#fc8eac] focus:ring focus:ring-[#fc8eac] focus:ring-opacity-50 p-2 border">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['idcategory'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="stock" class="block text-sm font-medium text-gray-700">Stock Quantity</label>
            <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($product['stock']) ?>"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#fc8eac] focus:ring focus:ring-[#fc8eac] focus:ring-opacity-50 p-2 border">
            <?php if (isset($errors['stock'])): ?>
                <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['stock']) ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#fc8eac] focus:ring focus:ring-[#fc8eac] focus:ring-opacity-50 p-2 border"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="flex flex-row gap-3 pt-4">
            <button type="submit"
                class="flex-1 bg-[#fc8eac] text-white px-4 py-3 rounded-lg hover:bg-[#e47a98] font-medium text-sm sm:text-base sm:px-6">
                Save Changes
            </button>
            <a href="product_view.php?id=<?= $product['idproduct'] ?>"
                class="flex-1 text-center border border-[#fc8eac] text-[#fc8eac] px-4 py-3 rounded-lg hover:bg-[#fc8eac] hover:text-white font-medium text-sm sm:text-base sm:px-6">
                Cancel
            </a>
        </div>
    </div>
    <?php
}

function displayCarouselScript()
{
    ?>
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const carousel = document.getElementById('carousel');

        function updateCarousel() {
            const slideWidth = slides[0].offsetWidth;
            carousel.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            updateCarousel();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            updateCarousel();
        }

        document.getElementById('nextBtn')?.addEventListener('click', nextSlide);
        document.getElementById('prevBtn')?.addEventListener('click', prevSlide);

        // Image preview functionality
        document.querySelectorAll('.image-upload').forEach(input => {
            input.addEventListener('change', function (e) {
                const previewContainer = document.getElementById(`${this.name}-preview`);
                const previewImage = document.getElementById(`${this.name}-preview-img`);
                const currentImage = document.getElementById(this.dataset.previewTarget);

                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        previewContainer.classList.remove('hidden');

                        // Also update the carousel preview if this is the main image
                        if (currentImage) {
                            currentImage.src = e.target.result;
                        }
                    }

                    reader.readAsDataURL(this.files[0]);
                } else {
                    previewContainer.classList.add('hidden');
                }
            });
        });

        updateCarousel();
    </script>
    <?php
}
?>