<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="../assets/logo/logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/fontawesome.min.css">
    <script>
        tailwind.config = {
            theme: {
                screens: {
                    'xs': '475px',
                    'sm': '640px',
                    'md': '768px',
                    'lg': '1024px',
                    'xl': '1280px',
                }
            }
        }
    </script>
</head>
          <div class="w-full">
        <?php require_once '../includes/navbar.php' ?>
    </div>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4 xs:p-6">
    <!-- Responsive container -->
    <div class="w-full max-w-2xl max-h-xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-lg text-center mb-10">
        
        <!-- Responsive image -->
        <div class="mb-6 sm:mb-8 flex justify-center">
            <img src="../assets/logo/cart.png" 
                 alt="Your Order" 
                 class="w-full max-w-xs xs:max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl h-auto max-h-64 xs:max-h-72 sm:max-h-80 md:max-h-96 object-contain rounded-lg">
        </div>
        
        <!-- Responsive text -->
        <div class="px-2 sm:px-0">
            <h1 class="text-2xl xs:text-2xl sm:text-3xl font-bold text-gray-800 mb-3 sm:mb-4">Thank you for your order!</h1>
            <p class="text-base xs:text-lg sm:text-lg text-gray-600 mb-6 sm:mb-8">
                We're processing it now. Shortly you will receive a confirmation email along with the content you ordered!
            </p>
        </div>
        
<div class="flex flex-col md:flex-row gap-3 sm:gap-4 justify-center px-2 sm:px-3 py-2">
    <a href="/" class="w-full md:w-auto px-5 py-2.5 sm:px-6 sm:py-3 bg-[#fc8eac] hover:bg-[#e75480] text-white rounded-lg transition text-sm sm:text-base font-medium">
        Homepage
    </a>
    <a href="contact.php" class="w-full md:w-auto px-5 py-2.5 sm:px-6 sm:py-3 text-[#fc8eac] hover:text-[#e75480] border border-[#fc8eac] hover:border-[#e75480] rounded-lg transition text-sm sm:text-base font-medium">
        Contact
    </a>
</div>
    </div>
</body>
</html>

<?php include '../includes/footer.php'; ?>
