<?php
// session_start();
// if ($_SESSION['logged_in'] == true) {
//     $usertype = $_SESSION['usertype'];
//     $iduser = $_SESSION['iduser'];
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlowEssence - Premium Beauty & Skincare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="assets/logo/logo1.ico" type="image/x-icon">
    <link rel="icon" href="./assets/logo/logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/output.css">
    <link rel="stylesheet" href="./assets/css/fontawesome/all.min.css">
    <link rel="stylesheet" href="./assets/css/fontawesome/fontawesome.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .heading-font {
            font-family: 'Playfair Display', serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, rgba(252, 142, 172, 0.1) 0%, rgba(255, 255, 255, 1) 100%);
        }

        .btn-primary {
            background-color: #fc8eac;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e75480;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(252, 142, 172, 0.5);
        }

        .text-primary {
            color: #fc8eac;
        }

        .border-primary {
            border-color: #fc8eac;
        }

        .collection-card:hover .collection-overlay {
            opacity: 1;
        }

        .collection-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, transparent 100%);
            transition: opacity 0.3s ease;
        }

        .testimonial-card {
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
        }

        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-white text-gray-800">
    <nav
        class="bg-[#fdb3c2] w-full flex flex-col md:flex-row justify-between items-center px-4 md:px-6 py-3 md:py-4 border-b">
        <!-- Logo and Mobile Menu Button -->
        <div class="w-full md:w-auto flex justify-between items-center">
            <div class="flex items-center text-xl font-bold text-white">
                <img src="./assets/logo/logo1.png" alt="Logo" class="w-10 h-10 md:w-12 md:h-12" />
                <span class="-ml-2 font-[TREBUCHET MS]">OMMEE</span>
            </div>

            <!-- Mobile Menu Button (Hamburger) -->
            <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Search Bar and Icons Container -->
        <div class="w-full md:flex-1 flex items-center justify-between md:justify-center mt-3 md:mt-0">
            <!-- Search Bar - Always visible -->
            <div class="flex-1 max-w-xl md:mx-6">
                <div class="relative">
                    <input type="text" placeholder="Enter your product name..."
                        class="w-full border rounded-lg px-4 py-2 pl-5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300" />
                    <div class="absolute right-3 top-2.5 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Icons - Visible on all screen sizes -->
            <div class="flex items-center ml-4 space-x-4 text-white">
                <!-- <a href="./pages/profile.php" class="text-lg hover:text-gray-200"><i class="fa-solid fa-user"></i></a>
                <a href="./pages/products.php" class="text-lg hover:text-gray-200 relative">
                    <i class="fa-solid fa-house"></i> </a>
                <a href="./pages/orders.php" class="text-lg hover:text-gray-200 relative">
                    <i class="fa-solid fa-table-list"></i>
                    <a href="./pages/cart.php" class="text-lg hover:text-gray-200 relative">
                        <i class="fa-solid fa-cart-shopping"></i> -->

                        <!-- Cart counter badge -->
                        <!-- <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"><?= $count['count'] ?></span> -->
                    </a>
            </div>
        </div>

        <div id="mobile-links"
            class="hidden md:flex flex-col md:flex-row w-full md:w-auto space-y-3 md:space-y-0 md:space-x-6 text-white font-semibold text-sm mt-3 md:mt-0 pl-4 md:pl-0">
            <a href="./pages/login.php" class="hover:underline py-1 md:py-0">Log In</a>
            <a href="./pages/register.php" class="hover:underline py-1 md:py-0">Sign Up</a>
            <a href="./pages/about_us.php" class="hover:underline py-1 md:py-0">About Us</a>
            <a href="./pages/contact.php" class="hover:underline py-1 md:py-0">Contact Us</a>
        </div>

        <!-- Mobile Menu Toggle Script -->
        <script>
            document.getElementById('mobile-menu-button').addEventListener('click', function () {
                const links = document.getElementById('mobile-links');

                // Toggle visibility
                links.classList.toggle('hidden');

                // Toggle between block and flex for proper layout
                if (!links.classList.contains('hidden')) {
                    links.classList.add('flex');
                }
            });
        </script>
    </nav>
    </div>
    <?php
    // Include product functions and get products
    require_once './includes/product_functions.php';
    $products = handleProductOperations($pdo)->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as associative array
    $featuredProducts = array_slice($products, 0, 12); // Now this will work
    ?>

    <!-- Hero Section -->
    <section class="bg-rose-50 py-10 md:py-16 px-4">
        <div class="max-w-screen-2xl mx-auto">
            <!-- Carousel Container -->
            <div class="relative overflow-hidden rounded-xl md:rounded-2xl shadow-xl">
                <!-- Carousel Slides -->
                <div id="beauty-carousel" class="flex transition-transform duration-500 ease-in-out">
                    <!-- Slide 1 - Japanese Beauty -->
                    <div class="w-full flex-shrink-0 relative">
                        <img src="https://images.unsplash.com/photo-1556228578-8c89e6adf883?ixlib=rb-1.2.1&auto=format&fit=crop&w=1800&q=80"
                            alt="Japanese Beauty Products"
                            class="w-full h-[300px] sm:h-[400px] md:h-[500px] object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-black/15 md:from-black/20 to-transparent flex items-center">
                            <div class="container mx-auto px-6 md:px-12 lg:px-16">
                                <div class="ml-[5%] md:ml-[10%] max-w-md lg:max-w-2xl text-white">
                                    <span
                                        class="bg-white/20 backdrop-blur-sm px-4 py-1 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-medium mb-4 md:mb-6 inline-block font-sans">
                                        JAPANESE BEAUTY
                                    </span>
                                    <h2
                                        class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-bold mb-4 md:mb-6 font-serif italic leading-tight">
                                        Pure Rituals<br>From Japan
                                    </h2>
                                    <p
                                        class="text-sm sm:text-base md:text-xl lg:text-2xl mb-6 md:mb-8 font-light max-w-xs sm:max-w-md md:max-w-lg">
                                        Browse our wide selection of high-quality J-Beauty products at great prices
                                    </p>
                                    <a href="#"
                                        class="bg-[#fc8eac] text-white px-6 py-2 md:px-8 md:py-3 rounded-full text-sm md:text-base font-medium hover:bg-rose-100 transition font-sans">
                                        LET'S GO! →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 - Korean Beauty -->
                    <div class="w-full flex-shrink-0 relative">
                        <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-1.2.1&auto=format&fit=crop&w=1800&q=80"
                            alt="Korean Beauty Products"
                            class="w-full h-[300px] sm:h-[400px] md:h-[500px] object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-black/15 md:from-black/20 to-transparent flex items-center">
                            <div class="container mx-auto px-6 md:px-12 lg:px-16">
                                <div class="ml-[5%] md:ml-[10%] max-w-md lg:max-w-2xl text-white">
                                    <span
                                        class="bg-white/20 backdrop-blur-sm px-4 py-1 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-medium mb-4 md:mb-6 inline-block font-sans">
                                        KOREAN BEAUTY
                                    </span>
                                    <h2
                                        class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-bold mb-4 md:mb-6 font-serif italic leading-tight">
                                        Glass Skin<br>Essentials
                                    </h2>
                                    <p
                                        class="text-sm sm:text-base md:text-xl lg:text-2xl mb-6 md:mb-8 font-light max-w-xs sm:max-w-md md:max-w-lg">
                                        Discover the secrets behind Korea's famous skincare routines
                                    </p>
                                    <a href="#"
                                        class="bg-white text-[#fc8eac] px-6 py-2 md:px-8 md:py-3 rounded-full text-sm md:text-base font-medium hover:bg-rose-100 transition font-sans">
                                        SHOP NOW →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 - Clean Beauty -->
                    <div class="w-full flex-shrink-0 relative">
                        <img src="https://images.unsplash.com/photo-1625772452859-1c03d5bf1137?ixlib=rb-1.2.1&auto=format&fit=crop&w=1800&q=80"
                            alt="Clean Beauty Products" class="w-full h-[300px] sm:h-[400px] md:h-[500px] object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-black/15 md:from-black/20 to-transparent flex items-center">
                            <div class="container mx-auto px-6 md:px-12 lg:px-16">
                                <div class="ml-[5%] md:ml-[10%] max-w-md lg:max-w-2xl text-white">
                                    <span
                                        class="bg-white/20 backdrop-blur-sm px-4 py-1 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-medium mb-4 md:mb-6 inline-block font-sans">
                                        CLEAN BEAUTY
                                    </span>
                                    <h2
                                        class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-bold mb-4 md:mb-6 font-serif italic leading-tight">
                                        Conscious<br>Beauty Choices
                                    </h2>
                                    <p
                                        class="text-sm sm:text-base md:text-xl lg:text-2xl mb-6 md:mb-8 font-light max-w-xs sm:max-w-md md:max-w-lg">
                                        Eco-friendly products that love you back
                                    </p>
                                    <a href="#"
                                        class="bg-white text-rose-600 px-6 py-2 md:px-8 md:py-3 rounded-full text-sm md:text-base font-medium hover:bg-rose-100 transition font-sans">
                                        DISCOVER →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carousel Navigation -->
                <button onclick="prevSlide()"
                    class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 md:p-3 rounded-full shadow-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button onclick="nextSlide()"
                    class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 md:p-3 rounded-full shadow-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Carousel Indicators -->
                <div class="absolute bottom-4 md:bottom-8 left-0 right-0 flex justify-center gap-2 md:gap-3">
                    <button onclick="goToSlide(0)"
                        class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-white/80 transition carousel-indicator"></button>
                    <button onclick="goToSlide(1)"
                        class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-white/30 hover:bg-white/50 transition carousel-indicator"></button>
                    <button onclick="goToSlide(2)"
                        class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-white/30 hover:bg-white/50 transition carousel-indicator"></button>
                </div>
            </div>
        </div>
    </section>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('#beauty-carousel > div');
        const indicators = document.querySelectorAll('.carousel-indicator');
        let autoSlideInterval;

        function updateCarousel() {
            document.getElementById('beauty-carousel').style.transform = `translateX(-${currentSlide * 100}%)`;

            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('bg-white/80', index === currentSlide);
                indicator.classList.toggle('bg-white/30', index !== currentSlide);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            updateCarousel();
            resetAutoSlide();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            updateCarousel();
            resetAutoSlide();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateCarousel();
            resetAutoSlide();
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(nextSlide, 5000);
        }

        // Initialize auto-rotation
        autoSlideInterval = setInterval(nextSlide, 5000);

        // Pause on hover
        const carousel = document.querySelector('.relative.overflow-hidden');
        carousel.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
        carousel.addEventListener('mouseleave', () => autoSlideInterval = setInterval(nextSlide, 5000));
    </script>


    <!-- Collections -->
    <section id="categories" class="py-12 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="heading-font text-3xl md:text-4xl font-bold mb-4">Top Categories</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 md:gap-6">
                <!-- Category 1 -->
                <a href="#"
                    class="category-card block p-6 text-center hover:shadow-md transition-all rounded-lg border border-gray-100">
                    <div class="bg-gray-100 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                        <!-- Icon or image would go here -->
                        <span class="text-3xl">🌸</span>
                    </div>
                    <h3 class="font-bold text-lg">FRAGRANCES</h3>
                    <span class="text-sm text-gray-500 mt-1 block">></span>
                </a>

                <!-- Category 2 -->
                <a href="#"
                    class="category-card block p-6 text-center hover:shadow-md transition-all rounded-lg border border-gray-100">
                    <div class="bg-gray-100 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                        <span class="text-3xl">💧</span>
                    </div>
                    <h3 class="font-bold text-lg">SERUM</h3>
                    <span class="text-sm text-gray-500 mt-1 block">></span>
                </a>

                <!-- Category 3 -->
                <a href="#"
                    class="category-card block p-6 text-center hover:shadow-md transition-all rounded-lg border border-gray-100">
                    <div class="bg-gray-100 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                        <span class="text-3xl">💄</span>
                    </div>
                    <h3 class="font-bold text-lg">MAKEUP</h3>
                    <span class="text-sm text-gray-500 mt-1 block">></span>
                </a>

                <!-- Category 4 -->
                <a href="#"
                    class="category-card block p-6 text-center hover:shadow-md transition-all rounded-lg border border-gray-100">
                    <div class="bg-gray-100 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                        <span class="text-3xl">☀️</span>
                    </div>
                    <h3 class="font-bold text-lg">SUNBLOCK</h3>
                    <span class="text-sm text-gray-500 mt-1 block">></span>
                </a>

                <!-- Category 5 -->
                <a href="#"
                    class="category-card block p-6 text-center hover:shadow-md transition-all rounded-lg border border-gray-100">
                    <div class="bg-gray-100 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                        <span class="text-3xl">🧴</span>
                    </div>
                    <h3 class="font-bold text-lg">HAIRCARE</h3>
                    <span class="text-sm text-gray-500 mt-1 block">></span>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured-products" class="py-20 bg-gray-50 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="heading-font text-3xl md:text-4xl font-bold mb-4">Best Sellers</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Discover our most loved beauty products this season
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($featuredProducts as $product): ?>
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition product-card">
                        <div class="relative">
                            <?php $image = getProductImage($product); ?>
                            <?php if ($image): ?>
                                <img src="<?= $image ?>" alt="<?= htmlspecialchars($product['name']) ?>"
                                    class="w-full h-64 object-cover">
                            <?php else: ?>
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No image available</span>
                                </div>
                            <?php endif; ?>
                            <div class="absolute top-4 right-4">
                                <button
                                    class="bg-white rounded-full p-2 shadow-md hover:bg-primary hover:text-white transition">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-medium mb-1 truncate"><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="text-primary font-bold">₱<?= number_format($product['price'], 2) ?></p>
                            <div class="flex justify-between items-center mt-4">
                                <a href="product_view.php?id=<?= $product['idproduct'] ?>"
                                    class="text-primary hover:text-primary-dark">
                                    <i class="fas fa-shopping-bag"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-12">
                <a href="pages/products.php" class="btn-primary text-white px-8 py-3 rounded-lg font-medium inline-block">
                    View All Products
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="heading-font text-3xl md:text-4xl font-bold mb-4">Beauty Reviews</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    See what our customers are saying about our products
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-xl testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="flex space-x-1 text-yellow-400 mr-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">
                        "The Glow Essence Serum transformed my skin in just two weeks! My complexion has never looked
                        more radiant."
                    </p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Sarah J."
                            class="w-12 h-12 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold">Sarah J.</h4>
                            <p class="text-sm text-gray-500">Beauty Influencer</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-xl testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="flex space-x-1 text-yellow-400 mr-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">
                        "I'm obsessed with the Velvet Lipstick Set. The colors are perfect and they last all day without
                        drying my lips."
                    </p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael T."
                            class="w-12 h-12 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold">Michael T.</h4>
                            <p class="text-sm text-gray-500">Makeup Artist</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-xl testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="flex space-x-1 text-yellow-400 mr-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">
                        "The Nourishing Hair Mask saved my damaged hair. After one use, my hair felt softer and looked
                        shinier!"
                    </p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Lisa M."
                            class="w-12 h-12 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold">Lisa M.</h4>
                            <p class="text-sm text-gray-500">Salon Owner</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Auto-rotate every 5 seconds
        setInterval(nextSlide, 5000);
        // Mobile menu toggle functionality would go here
        document.addEventListener('DOMContentLoaded', function () {
            // You would add JavaScript for mobile menu toggle here
        });
    </script>
</body>

<footer class="bg-white border-t border-gray-100 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 py-12">
            <!-- Logo and Description -->
            <div class="space-y-4">
                <div class="flex items-center">
                    <img src="assets/logo/logo.png" alt="Logo" class="h-12 w-12">
                    <span class="-ml-3 text-xl font-semibold font-[TREBUCHET MS] text-[#fe036a]">
                        OMMEE
                    </span>
                </div>
                <p class="text-gray-500 text-sm">
                    Making beautiful products to simplify your life and bring you joy.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-[#fc8eac] transition">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#fc8eac] transition">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#fc8eac] transition">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold text-gray-800 uppercase tracking-wider">Shop</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="text-gray-500 hover:text-[#fc8eac] text-sm transition">All Products</a>
                    </li>
                    <li><a href="#" class="text-gray-500 hover:text-[#fc8eac] text-sm transition">New Arrivals</a>
                    </li>
                    <li><a href="#" class="text-gray-500 hover:text-[#fc8eac] text-sm transition">Best Sellers</a>
                    </li>
                    <li><a href="#" class="text-gray-500 hover:text-[#fc8eac] text-sm transition">Special Offers</a>
                    </li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h3 class="text-sm font-semibold text-gray-800 uppercase tracking-wider">Support</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="text-gray-500 hover:text-[#fc8eac] text-sm transition">Contact Us</a>
                    </li>
                    <li><a href="#" class="text-gray-500 hover:text-[#fc8eac] text-sm transition">FAQs</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-[#fc8eac] text-sm transition">Shipping
                            Policy</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-[#fc8eac] text-sm transition">Returns &
                            Exchanges</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-sm font-semibold text-gray-800 uppercase tracking-wider">Newsletter</h3>
                <p class="mt-4 text-gray-500 text-sm">
                    Subscribe to get special offers, free giveaways, and once-in-a-lifetime deals.
                </p>
                <form class="mt-4 flex">
                    <input type="email" placeholder="Your email"
                        class="px-4 py-2 w-full border border-gray-300 rounded-l-lg focus:outline-none focus:ring-1 focus:ring-[#fc8eac] focus:border-[#fc8eac] text-sm">
                    <button type="submit"
                        class="bg-[#fc8eac] hover:bg-[#e47a98] text-white px-4 py-2 rounded-r-lg transition text-sm">
                        Join
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-100 py-6 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm">
                &copy;
                <script>document.write(new Date().getFullYear())</script> Jommee. All rights reserved.
            </p>
            <div class="mt-4 md:mt-0 flex space-x-6">
                <a href="#" class="text-gray-500 hover:text-[#fc8eac] text-sm transition">Privacy Policy</a>
                <a href="#" class="text-gray-500 hover:text-[#fc8eac] text-sm transition">Terms of Service</a>
                <a href="#" class="text-gray-500 hover:text-[#fc8eac] text-sm transition">Cookies</a>
            </div>
        </div>
    </div>
</footer>

</html>