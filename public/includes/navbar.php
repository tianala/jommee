<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Jommee Navbar</title>
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/fontawesome.min.css">
</head>
<body class="bg-white">
  <nav class="bg-[#fdb3c2] w-full flex flex-col md:flex-row justify-between items-center px-4 md:px-6 py-3 md:py-4 border-b">
    
    <!-- Logo and Mobile Menu Button -->
    <div class="w-full md:w-auto flex justify-between items-center">
      <div class="flex items-center text-xl font-bold text-white">
        <img src="../assets/logo/logo1.png" alt="Logo" class="w-10 h-10 md:w-12 md:h-12" />
        <span class="-ml-2 font-[TREBUCHET MS]">OMMEE</span>
      </div>
      
      <!-- Mobile Menu Button (Hamburger) -->
      <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>

    <!-- Search Bar and Icons Container -->
    <div class="w-full md:flex-1 flex items-center justify-between md:justify-center mt-3 md:mt-0">
      <!-- Search Bar - Always visible -->
      <div class="flex-1 max-w-xl md:mx-6">
        <div class="relative">
          <input type="text" placeholder="Enter your product name..." 
                class="w-full border rounded-lg px-4 py-2 pl-5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300"/>
          <div class="absolute right-3 top-2.5 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" />
            </svg>
          </div>
        </div>
      </div>

      <!-- Icons - Visible on all screen sizes -->
      <div class="flex items-center ml-4 space-x-4 text-white">
        <a href="#" class="text-lg hover:text-gray-200"><i class="fa-solid fa-user"></i></a>
        <a href="../pages/cart.php" class="text-lg hover:text-gray-200 relative">
          <i class="fa-solid fa-cart-shopping"></i>
          <!-- Cart counter badge -->
          <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">0</span>
        </a>
      </div>
    </div>

<div id="mobile-links" class="hidden md:flex flex-col md:flex-row w-full md:w-auto space-y-3 md:space-y-0 md:space-x-6 text-white font-semibold text-sm mt-3 md:mt-0 pl-4 md:pl-0">
  <a href="#" class="hover:underline py-1 md:py-0">Log In</a>
  <a href="#" class="hover:underline py-1 md:py-0">Sign Up</a>
  <a href="../pages/about_us.php" class="hover:underline py-1 md:py-0">About Us</a>
  <a href="../pages/contact.php" class="hover:underline py-1 md:py-0">Contact Us</a>
</div>

  <!-- Mobile Menu Toggle Script -->
  <script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
      const links = document.getElementById('mobile-links');
      
      // Toggle visibility
      links.classList.toggle('hidden');
      
      // Toggle between block and flex for proper layout
      if (!links.classList.contains('hidden')) {
        links.classList.add('flex');
      }
    });
  </script>
</body>
</html>