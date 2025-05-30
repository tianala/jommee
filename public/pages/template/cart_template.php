<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="../assets/logo/logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/output.css">
    <link rel="stylesheet" href="../../assets/css/fontawesome/all.min.css">
    <link rel="stylesheet" href="../../assets/css/fontawesome/fontawesome.min.css">

</head>

<body class="bg-gray-50">
    <div class="w-full">
        <?php require_once '../includes/navbar.php' ?>
    </div>

    <div class="container mx-auto px-4 py-8">

        <?php if (empty($cartItems)): ?>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-600 mb-4">Your cart is empty</p>
                <a href="products.php" class="bg-[#fc8eac] hover:bg-[#e75480] text-white px-6 py-2 rounded-lg transition">
                    Continue Shopping
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="hidden md:grid grid-cols-12 bg-gray-100 p-4 font-medium">
                            <div class="col-span-6 text-center">Product</div>
                            <div class="col-span-2 text-center">Price</div>
                            <div class="col-span-3 text-center">Quantity</div>
                            <div class="col-span-1 text-center">Remove</div>
                        </div>

                        <?php foreach ($cartItems as $item): ?>
                            <div class="grid grid-cols-12 p-4 border-b items-center cart-item" data-id="<?= $item['idcart'] ?>">
                                <!-- Selector -->
                                <div
                                    class="flex items-start gap-2 md:col-span-1 md:justify-center mb-2 md:mb-0 col-span-12 md:col-span-1">
                                    <label class="inline-flex items-center ml-4 md:ml-0">
                                        <input type="checkbox"
                                            class="item-selector h-5 w-5 rounded accent-[#fc8eac] border-gray-300 focus:ring-[#fc8eac] focus:ring-offset-0 focus:ring-2 cursor-pointer"
                                            onchange="updateOrderSummary()">
                                    </label>
                                </div>
                                <!-- Product Info - Mobile Stacked Layout -->
                                <div
                                    class="col-span-12 md:col-span-5 flex flex-col md:flex-row items-start md:items-center space-y-2 md:space-y-0">
                                    <div class="flex items-center w-full md:w-auto">
                                        <?php if (!empty($item['main_img'])): ?>
                                            <img src="data:image/jpeg;base64,<?= base64_encode($item['main_img']) ?>"
                                                alt="<?= htmlspecialchars($item['name']) ?>"
                                                class="w-16 h-16 md:w-20 md:h-20 object-contain mr-4">
                                        <?php else: ?>
                                            <div
                                                class="w-16 h-16 md:w-20 md:h-20 bg-gray-200 flex items-center justify-center mr-4">
                                                <span class="text-gray-500 text-xs">No image</span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="flex-1 md:flex-none break-word">
                                            <div class="w-1/3">
                                                <h3 class="font-medium text-sm md:text-base">
                                                    <?= htmlspecialchars($item['name']) ?>
                                                </h3>
                                            </div>
                                            <!-- Mobile Price -->
                                            <div class="md:hidden flex justify-between items-center mt-1">
                                                <span class="text-gray-500 text-sm">Price:</span>
                                                <span class="font-medium text-sm item-price" data-price="<?= $item['price'] ?>">
                                                    ₱<?= number_format($item['price'], 2) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price - Hidden on mobile (shown in product info) -->
                                <div class="hidden md:block col-span-2 text-center item-price"
                                    data-price="<?= $item['price'] ?>">
                                    ₱<?= number_format($item['price'], 2) ?>
                                </div>

                                <!-- Quantity -->
                                <!-- Replace the quantity section with this: -->
                                <div class="col-span-6 md:col-span-3 mt-2 md:mt-0">
                                    <div class="flex items-center justify-between md:justify-center">
                                        <span class="md:hidden text-sm text-gray-500">Qty:</span>
                                        <form method="POST" action="cart.php" class="flex items-center">
                                            <input type="hidden" name="idcart" value="<?= $item['idcart'] ?>">
                                            <input type="hidden" name="update_quantity" value="1">
                                            <button type="button" onclick="updateQuantity(this, -1)"
                                                class="bg-gray-200 px-2 py-1 rounded-l-lg hover:bg-gray-300 transition text-sm md:text-base">
                                                -
                                            </button>
                                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1"
                                                class="w-10 md:w-12 text-center border-t border-b border-gray-200 py-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none item-quantity text-sm md:text-base">
                                            <button type="button" onclick="updateQuantity(this, 1)"
                                                class="bg-gray-200 px-2 py-1 rounded-r-lg hover:bg-gray-300 transition text-sm md:text-base">
                                                +
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Remove -->
                                <div class="col-span-6 md:col-span-1 mt-2 md:mt-0 flex justify-end md:justify-center">
                                    <form method="POST">
                                        <input type="hidden" name="idcart" value="<?= $item['idcart'] ?>">
                                        <button type="submit" name="remove_item"
                                            class="text-red-500 hover:text-red-700 text-sm md:text-base">
                                            <i class="fas fa-trash"></i>
                                            <span class="md:hidden ml-1">Remove</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Order Summary - Full width on mobile -->
                <div class="col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-4 md:p-6 sticky top-4">
                        <h2 class="text-lg md:text-xl font-bold mb-4">Order Summary</h2>

                        <div class="space-y-3 mb-4 md:mb-6">
                            <div class="flex justify-between text-sm md:text-base">
                                <span>Subtotal</span>
                                <span id="order-subtotal">₱0.00</span>
                            </div>
                            <div class="flex justify-between text-sm md:text-base">
                                <span>Shipping</span>
                                <span>Free</span>
                            </div>
                            <div class="flex justify-between font-bold text-base md:text-lg pt-2 border-t">
                                <span>Total</span>
                                <span id="order-total">₱0.00</span>
                            </div>
                        </div>

                        <form method="POST" action="../includes/checkout.php" id="checkout-form">
                            <input type="hidden" name="selected_items" id="selected-items">
                            <button type="submit"
                                class="w-full bg-[#fc8eac] hover:bg-[#e75480] text-white py-2 md:py-3 rounded-lg transition font-medium text-sm md:text-base">
                                Proceed to Checkout
                            </button>
                        </form>

                        <div class="mt-3 md:mt-4 text-center">
                            <a href="products.php" class="text-[#fc8eac] hover:text-[#e75480] text-xs md:text-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Update quantity function
        function updateQuantity(button, change) {
            const form = button.closest('form');
            const quantityInput = form.querySelector('input[name="quantity"]');
            let newQuantity = parseInt(quantityInput.value) + change;

            // Ensure quantity doesn't go below 1
            if (newQuantity < 1) newQuantity = 1;

            quantityInput.value = newQuantity;
            form.submit();
        }

        // Update order summary when items are selected
        function updateOrderSummary() {
            let subtotal = 0;
            const selectedItems = [];

            document.querySelectorAll('.cart-item').forEach(item => {
                const checkbox = item.querySelector('.item-selector');
                if (checkbox.checked) {
                    const price = parseFloat(item.querySelector('.item-price').dataset.price);
                    const quantity = parseInt(item.querySelector('.item-quantity').value);
                    const idcart = item.getAttribute('data-id');

                    subtotal += price * quantity;
                    selectedItems.push({ idcart, quantity });
                }
            });

            document.getElementById('order-subtotal').textContent = `₱${subtotal.toFixed(2)}`;
            document.getElementById('order-total').textContent = `₱${subtotal.toFixed(2)}`;
            document.getElementById('selected-items').value = JSON.stringify(selectedItems);
        }

        // Initialize event listeners
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.item-selector').forEach(checkbox => {
                checkbox.addEventListener('change', updateOrderSummary);
            });

            document.querySelectorAll('.item-quantity').forEach(input => {
                input.addEventListener('change', function () {
                    this.closest('form').submit();
                });
            });

            // Initial calculation
            updateOrderSummary();
        });
    </script>

</body>

</html>
<?php include '../includes/footer.php'; ?>