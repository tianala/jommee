<?php
$pageTitle = "About Us";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="icon" href="../assets/logo/logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome/fontawesome.min.css">
    <style>
        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-scale:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 50%, #fce4ec 100%);
        }
    </style>
</head>
        <div class="w-full">
        <?php require_once '../includes/navbar.php' ?>
    </div>
<body class="bg-gray-50">
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-[fffff]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
            <div class="relative z-10 md:flex md:items-center md:justify-between">
                <div class="md:w-1/2">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        <span class="block">Our Story</span>
                        <span class="block text-[#fc8eac] mt-2">Crafted with Joy</span>
                    </h1>
                    <p class="mt-4 text-lg md:text-xl text-gray-600 max-w-lg">
                        From humble beginnings to creating products that bring joy to thousands of homes worldwide.
                    </p>
                    <div class="mt-8">
                        <a href="#our-mission" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#fc8eac] hover:bg-[#c2185b] transition">
                            Discover Our Mission
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
<div class="md:w-1/2 -mt-20">  <!-- Negative margin pulls it up -->
    <img class="w-full h-full object-cover" 
         src="../assets/logo/about.jpg" 
         alt="Our team working together">
</div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section id="our-mission" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <span class="text-sm font-semibold tracking-wider text-[#d81b60] uppercase">Our Philosophy</span>
                <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    More Than Just Products
                </h2>
                <div class="mt-6 max-w-2xl mx-auto text-lg text-gray-500">
                    <p>
                        We create experiences that enrich your daily life through thoughtful design and exceptional quality.
                    </p>
                </div>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-3">
                <div class="bg-gray-50 p-8 rounded-xl hover-scale">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-[#fce4ec] text-[#d81b60]">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Innovation First</h3>
                    <p class="mt-2 text-gray-500">
                        We challenge conventions to deliver fresh, creative solutions that make life better.
                    </p>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl hover-scale">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-[#fce4ec] text-[#d81b60]">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Quality Promise</h3>
                    <p class="mt-2 text-gray-500">
                        Every product undergoes rigorous testing to ensure it meets our high standards.
                    </p>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl hover-scale">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-[#fce4ec] text-[#d81b60]">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Sustainable Future</h3>
                    <p class="mt-2 text-gray-500">
                        We're committed to eco-friendly materials and responsible manufacturing processes.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Centered Heading Container -->
        <div class="flex flex-col items-center text-center mb-12">
            <span class="text-sm font-semibold tracking-wider text-[#fc8eac] uppercase">Our Family</span>
            <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Meet our Team
            </h2>
        </div>

        <!-- Centered Team Grid -->
 <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
<div class="bg-white rounded-xl shadow-md overflow-hidden hover-scale">
    <img class="w-full h-64 object-contain bg-white" 
                         src="https://upload.wikimedia.org/wikipedia/en/2/22/Pok%C3%A9mon_Jigglypuff_art.png" 
                         alt="Sarah Johnson">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900">Christian Ala</h3>
                        <p class="mt-3 text-gray-600">
                            “Jigglypuff… Jigglypuff!”
                        </p>
                    </div>
                </div>

<div class="bg-white rounded-xl shadow-md overflow-hidden hover-scale">
    <img class="w-full h-64 object-contain bg-white" 
                         src="https://cdn.hackernoon.com/images/AKsNRMQ5sghpqx7EhVDK3vl0AZJ2-ei3d351d.png" 
                         alt="Michael Chen">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900">Jamaica C. Magbanua</h3>
                        <p class="mt-3 text-gray-600">
                            “Skit-ty! Skit~ty!”
                        </p>
                    </div>
                </div>

<div class="bg-white rounded-xl shadow-md overflow-hidden hover-scale">
    <img class="w-full h-64 object-contain bg-white" 
         src="https://cdn.hackernoon.com/images/AKsNRMQ5sghpqx7EhVDK3vl0AZJ2-j21v35a5.png" 
         alt="Michael Chen">
    <div class="p-6">

                        <h3 class="text-xl font-bold text-gray-900">Juan Dela Cruz</h3>
                        <p class="mt-3 text-gray-600">
                            “Mew! Mew~!”
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-[#fcc7cf]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                Ready to experience the difference?
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-white">
                Join thousands of happy customers who trust our products every day.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <a href="contact.php" class="px-8 py-3 border border-[#fc8eac] text-base font-medium rounded-md text-[#fc8eac] bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10 transition">
                    Shop Our Collection
                </a>
            </div>
        </div>
    </section>

<?php include '../includes/footer.php'; ?>
</body>
</html>
