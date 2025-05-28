<?php 
  include_once '../includes/connect_db.php';
  $stmt1 = $pdo->prepare("SELECT * FROM category");
  $stmt1->execute();
  $categories = $stmt1->fetchAll(PDO::FETCH_ASSOC);
  function renderProductManagement($products)
{ ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Management</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->
    <link href="/public/assets/css/output.css" rel="stylesheet">
    <link rel="icon" href="../assets/logo/logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/js/jquery-3.7.1.min.js">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/fontawesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/lozad"></script>

  </head>
  <div class="w-full">
    <?php require_once '../includes/navbar.php' ?>
  </div>

  <body class="bg-gray-50 p-6">

    <div class="flex justify-end items-center mt-6 mr-3">
      <button onclick="document.getElementById('addModal').showModal()"
        class="bg-[#fc8eac] hover:bg-[#e75480] text-white text-xs sm:text-base px-3 sm:px-4 py-1.5 sm:py-2 rounded sm:rounded-lg transition">
        <i class="fas fa-plus mr-1 sm:mr-2"></i>Add Product
      </button>
    </div>

    <div
      class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 sm:gap-1 md:gap-2 lg:gap-4 sm:mb-5 md:mb-5">
      <?php foreach ($products as $row): ?>
        <div
          class="bg-white rounded-xl shadow-md p-2 sm:p-6 flex flex-col text-center relative w-full max-w-[180px] sm:max-w-[200px] md:max-w-none"
          data-id="<?= $row['idproduct'] ?>">

          <div class="absolute right-3 top-3 dropdown w-4 h-4">
            <button class="text-gray-500 hover:text-gray-700 focus:outline-none" onclick="event.stopPropagation()">
              <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-10"
              onclick="event.stopPropagation()">
              <button
                onclick="event.stopPropagation(); openEditModal(<?= $row['idproduct'] ?>, '<?= htmlspecialchars($row['name'], ENT_QUOTES) ?>', '<?= $row['price'] ?>')"
                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <i class="fas fa-edit mr-2"></i>Edit
              </button>
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

          <?php $image = getProductImage($row); ?>
          <?php if ($image): ?>
            <div class="w-full h-40 sm:h-36 md:h-44 lg:h-48 mb-3 sm:mb-4 flex items-center justify-center overflow-hidden">
              <img data-src="<?= $image ?>" alt="<?= htmlspecialchars($row['name']) ?>"
                class="w-full h-full object-contain lozad">
            </div>
          <?php else: ?>
            <div class="w-full h-40 sm:h-36 md:h-44 lg:h-48 bg-gray-200 mb-3 sm:mb-4 flex items-center justify-center">
              <span class="text-gray-500 text-sm">No image</span>
            </div>
          <?php endif; ?>

          <div class="text-left">
            <h2 class="text-xs sm:text-sm font-medium mb-1 truncate h-5" title="<?= htmlspecialchars($row['name']) ?>">
              <?= htmlspecialchars($row['name']) ?>
            </h2>
          </div>

          <p class="text-[0.8rem] sm:text-[0.9rem] text-[#cd1c1c] font-semibold mb-1 text-left">
            ₱<?= number_format($row['price'], 2) ?></p>

          <div class="flex justify-center items-center gap-2 sm:gap-3 mt-2">
            <button
              class="bg-[#fc8eac] text-white text-sm sm:text-sm px-3 sm:px-4 py-1 rounded sm:rounded-lg hover:bg-[#e75480] transition">
              Buy
            </button>
            <form method="POST" action="cart.php">
              <input type="hidden" name="idproduct" value="<?= $row['idproduct'] ?>">
              <button type="submit" name="add_to_cart"
                class="text-[#ff0090] bg-[#fcf1f2] text-sm sm:text-sm px-2 sm:px-3 py-1 rounded sm:rounded-lg hover:bg-gray-300 transition border border-pink-300">
                Add to Cart
              </button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Add Product Modal -->
    <dialog id="addModal" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
      <form method="POST" class="space-y-4" enctype="multipart/form-data">
        <h2 class="text-xl font-bold mb-4">Add New Product</h2>

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
          <select id="add_category" name="category" required
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]">
            <option value="" hidden>Choose a category</option>
            <?php foreach ($categories AS $category): ?>
              <option value="<?=$category['idcategory']?>"><?=$category['name']?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
          <input type="number" name="stock" required step="0.01"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]">
        </div>

        <div>
          <label for="add_description" class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
          <textarea id="add_description" type="number" name="stock"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"></textarea>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
          <input type="file" name="image" id="add_image" accept="image/*"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"
            onchange="previewAddImage(event)">
          <img id="add_image_preview" src="" alt="Image Preview"
            class="mt-3 w-full max-h-48 object-contain hidden rounded-md border" />
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
    <dialog id="editModal" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
      <form method="POST" class="space-y-4" enctype="multipart/form-data">
        <h2 class="text-xl font-bold mb-4">Edit Product</h2>
        <input type="hidden" name="id" id="edit_id">

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
          <input type="text" name="name" id="edit_name" required
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
          <input type="number" name="price" id="edit_price" required step="0.01"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
          <input type="file" name="image" id="edit_image" accept="image/*"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac]"
            onchange="previewEditImage(event)">
          <div class="mt-3">
            <p class="text-sm text-gray-500 mb-1">Current Image:</p>
            <img id="current_image_preview" src="" alt="Current Product Image"
              class="w-full max-h-48 object-contain rounded-md border">
          </div>
          <img id="new_image_preview" src="" alt="New Image Preview"
            class="mt-2 w-full max-h-48 object-contain rounded-md border hidden">
        </div>

        <div class="flex justify-end space-x-3 pt-4">
          <button type="button" onclick="document.getElementById('editModal').close()"
            class="px-4 py-2 text-gray-600 hover:text-gray-800">
            Cancel
          </button>
          <button type="submit" name="update_product"
            class="bg-[#fc8eac] hover:bg-[#e75480] text-white px-4 py-2 rounded-lg transition">
            Update Product
          </button>
        </div>
      </form>
    </dialog>


    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 hidden">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="p-6">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Confirm Deletion</h3>
            <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-500">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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

      function previewEditImage(event) {
        const newPreview = document.getElementById('new_image_preview');
        const currentPreview = document.getElementById('current_image_preview');
        const file = event.target.files[0];

        if (file) {
          newPreview.src = URL.createObjectURL(file);
          newPreview.classList.remove('hidden');
          currentPreview.classList.add('hidden');
        } else {
          newPreview.src = '';
          newPreview.classList.add('hidden');
          currentPreview.classList.remove('hidden');
        }
      }

      // Edit modal function
      function openEditModal(id, name, price) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_price').value = price;
        document.getElementById('editModal').showModal();

        // Clear any previous image selection
        document.getElementById('edit_image').value = '';
        document.getElementById('new_image_preview').classList.add('hidden');

        // Get the current image from the product card
        const productCard = document.querySelector(`[data-id="${id}"]`);
        if (productCard) {
          const imgElement = productCard.querySelector('img');
          if (imgElement) {
            const preview = document.getElementById('current_image_preview');
            preview.src = imgElement.src;
            preview.classList.remove('hidden');
          }
        }

        // Show the modal
        document.getElementById('editModal').showModal();
      }

      function openDeleteModal(id, name) {
        event.stopPropagation();
        const modal = document.getElementById('deleteModal');
        const confirmBtn = document.getElementById('confirmDeleteBtn');

        confirmBtn.href = `?delete=${id}`;
        modal.classList.remove('hidden');
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
<?php } ?>