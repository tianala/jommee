<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlowEssence - Premium Beauty & Skincare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="assets/logo/logo1.ico" type="image/x-icon">
    <link rel="icon" href="../assets/logo/logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/fontawesome.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .heading-font {
            font-family: 'Playfair Display', serif;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, rgba(252,142,172,0.1) 0%, rgba(255,255,255,1) 100%);
        }
        
        .btn-primary {
            background-color: #fc8eac;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #e75480;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(252,142,172,0.5);
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
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);
            transition: opacity 0.3s ease;
        }
        
        .testimonial-card {
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);
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
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<div class="w-full">
    <?php require_once '../includes/navbar.php' ?>
</div>
<body class="bg-white text-gray-800">
<?php
// Include product functions and get products
require_once '../includes/product_functions.php';
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
                    <div class="absolute inset-0 bg-gradient-to-r from-black/15 md:from-black/20 to-transparent flex items-center">
                        <div class="container mx-auto px-6 md:px-12 lg:px-16">
                            <div class="ml-[5%] md:ml-[10%] max-w-md lg:max-w-2xl text-white">
                                <span class="bg-white/20 backdrop-blur-sm px-4 py-1 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-medium mb-4 md:mb-6 inline-block font-sans">
                                    JAPANESE BEAUTY
                                </span>
                                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-bold mb-4 md:mb-6 font-serif italic leading-tight">
                                    Pure Rituals<br>From Japan
                                </h2>
                                <p class="text-sm sm:text-base md:text-xl lg:text-2xl mb-6 md:mb-8 font-light max-w-xs sm:max-w-md md:max-w-lg">
                                    Browse our wide selection of high-quality J-Beauty products at great prices
                                </p>
                                <a href="#" class="bg-[#fc8eac] text-white px-6 py-2 md:px-8 md:py-3 rounded-full text-sm md:text-base font-medium hover:bg-rose-100 transition font-sans">
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
                    <div class="absolute inset-0 bg-gradient-to-r from-black/15 md:from-black/20 to-transparent flex items-center">
                        <div class="container mx-auto px-6 md:px-12 lg:px-16">
                            <div class="ml-[5%] md:ml-[10%] max-w-md lg:max-w-2xl text-white">
                                <span class="bg-white/20 backdrop-blur-sm px-4 py-1 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-medium mb-4 md:mb-6 inline-block font-sans">
                                    KOREAN BEAUTY
                                </span>
                                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-bold mb-4 md:mb-6 font-serif italic leading-tight">
                                    Glass Skin<br>Essentials
                                </h2>
                                <p class="text-sm sm:text-base md:text-xl lg:text-2xl mb-6 md:mb-8 font-light max-w-xs sm:max-w-md md:max-w-lg">
                                    Discover the secrets behind Korea's famous skincare routines
                                </p>
                                <a href="#" class="bg-white text-[#fc8eac] px-6 py-2 md:px-8 md:py-3 rounded-full text-sm md:text-base font-medium hover:bg-rose-100 transition font-sans">
                                    SHOP NOW →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 - Clean Beauty -->
                <div class="w-full flex-shrink-0 relative">
                    <img src="https://images.unsplash.com/photo-1625772452859-1c03d5bf1137?ixlib=rb-1.2.1&auto=format&fit=crop&w=1800&q=80" 
                         alt="Clean Beauty Products" 
                         class="w-full h-[300px] sm:h-[400px] md:h-[500px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/15 md:from-black/20 to-transparent flex items-center">
                        <div class="container mx-auto px-6 md:px-12 lg:px-16">
                            <div class="ml-[5%] md:ml-[10%] max-w-md lg:max-w-2xl text-white">
                                <span class="bg-white/20 backdrop-blur-sm px-4 py-1 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-medium mb-4 md:mb-6 inline-block font-sans">
                                    CLEAN BEAUTY
                                </span>
                                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-bold mb-4 md:mb-6 font-serif italic leading-tight">
                                    Conscious<br>Beauty Choices
                                </h2>
                                <p class="text-sm sm:text-base md:text-xl lg:text-2xl mb-6 md:mb-8 font-light max-w-xs sm:max-w-md md:max-w-lg">
                                    Eco-friendly products that love you back
                                </p>
                                <a href="#" class="bg-white text-rose-600 px-6 py-2 md:px-8 md:py-3 rounded-full text-sm md:text-base font-medium hover:bg-rose-100 transition font-sans">
                                    DISCOVER →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Carousel Navigation -->
            <button onclick="prevSlide()" class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 md:p-3 rounded-full shadow-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button onclick="nextSlide()" class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 md:p-3 rounded-full shadow-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            
            <!-- Carousel Indicators -->
            <div class="absolute bottom-4 md:bottom-8 left-0 right-0 flex justify-center gap-2 md:gap-3">
                <button onclick="goToSlide(0)" class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-white/80 transition carousel-indicator"></button>
                <button onclick="goToSlide(1)" class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-white/30 hover:bg-white/50 transition carousel-indicator"></button>
                <button onclick="goToSlide(2)" class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-white/30 hover:bg-white/50 transition carousel-indicator"></button>
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
            <a href="#" class="category-card block p-6 text-center hover:shadow-md transition-all rounded-lg border border-gray-100">
                <div class="bg-gray-100 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                    <!-- Icon or image would go here -->
                    <span class="text-3xl">🌸</span>
                </div>
                <h3 class="font-bold text-lg">FRAGRANCES</h3>
                <span class="text-sm text-gray-500 mt-1 block">></span>
            </a>
            
            <!-- Category 2 -->
            <a href="#" class="category-card block p-6 text-center hover:shadow-md transition-all rounded-lg border border-gray-100">
                <div class="bg-gray-100 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                    <span class="text-3xl">💧</span>
                </div>
                <h3 class="font-bold text-lg">SERUM</h3>
                <span class="text-sm text-gray-500 mt-1 block">></span>
            </a>
            
            <!-- Category 3 -->
            <a href="#" class="category-card block p-6 text-center hover:shadow-md transition-all rounded-lg border border-gray-100">
                <div class="bg-gray-100 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                    <span class="text-3xl">💄</span>
                </div>
                <h3 class="font-bold text-lg">MAKEUP</h3>
                <span class="text-sm text-gray-500 mt-1 block">></span>
            </a>
            
            <!-- Category 4 -->
            <a href="#" class="category-card block p-6 text-center hover:shadow-md transition-all rounded-lg border border-gray-100">
                <div class="bg-gray-100 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                    <span class="text-3xl">☀️</span>
                </div>
                <h3 class="font-bold text-lg">SUNBLOCK</h3>
                <span class="text-sm text-gray-500 mt-1 block">></span>
            </a>
            
            <!-- Category 5 -->
            <a href="#" class="category-card block p-6 text-center hover:shadow-md transition-all rounded-lg border border-gray-100">
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
                            <img src="<?= $image ?>" 
                                 alt="<?= htmlspecialchars($product['name']) ?>" 
                                 class="w-full h-64 object-cover">
                        <?php else: ?>
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No image available</span>
                            </div>
                        <?php endif; ?>
                        <div class="absolute top-4 right-4">
                            <button class="bg-white rounded-full p-2 shadow-md hover:bg-primary hover:text-white transition">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium mb-1 truncate"><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="text-primary font-bold">₱<?= number_format($product['price'], 2) ?></p>
                        <div class="flex justify-between items-center mt-4">
                            <a href="product_view.php?id=<?= $product['idproduct'] ?>" class="text-primary hover:text-primary-dark">
                                <i class="fas fa-shopping-bag"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-12">
                <a href="products.php" class="btn-primary text-white px-8 py-3 rounded-lg font-medium inline-block">
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
                        "The Glow Essence Serum transformed my skin in just two weeks! My complexion has never looked more radiant."
                    </p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/43.jpg" 
                             alt="Sarah J." 
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
                        "I'm obsessed with the Velvet Lipstick Set. The colors are perfect and they last all day without drying my lips."
                    </p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                             alt="Michael T." 
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
                        "The Nourishing Hair Mask saved my damaged hair. After one use, my hair felt softer and looked shinier!"
                    </p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" 
                             alt="Lisa M." 
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
        document.addEventListener('DOMContentLoaded', function() {
            // You would add JavaScript for mobile menu toggle here
        });
    </script>
</body>
</html>
<?php include '../includes/footer.php' ?>