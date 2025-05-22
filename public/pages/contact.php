<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="../assets/logo/logo1.ico" type="image/x-icon">
  <style>
    @media (max-width: 640px) {
      .contact-section {
        padding: 2rem 1rem;
      }
      .contact-card {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Main Container -->
  <div class="max-w-7xl mx-auto contact-section px-4 py-12 md:py-20 flex flex-col md:flex-row items-start gap-8 md:gap-12">

    <!-- Contact Info - Left Column -->
    <div class="w-full md:w-1/2 space-y-6 md:space-y-8">
      <div class="space-y-4">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Get In Touch With Us</h2>
        <p class="text-gray-600 text-base md:text-lg">
          Have questions or feedback? We'd love to hear from you! Reach out through our contact form or directly via the information below.
        </p>
      </div>

      <!-- Contact Details Cards -->
      <div class="space-y-4 md:space-y-6">
        <!-- Location Card -->
        <div class="flex items-start gap-4 p-4 bg-white rounded-lg shadow-xs hover:shadow-md transition-shadow duration-300">
          <div class="bg-[#ffe6ee] text-[#fc8eac] p-3 rounded-lg flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          <div>
            <p class="font-bold text-lg text-gray-800">Our Location</p>
            <p class="text-gray-600">99 S.t Jomblo Park Pekanbaru<br>28292. Indonesia</p>
          </div>
        </div>

        <!-- Phone Card -->
        <div class="flex items-start gap-4 p-4 bg-white rounded-lg shadow-xs hover:shadow-md transition-shadow duration-300">
          <div class="bg-[#ffe6ee] text-[#fc8eac] p-3 rounded-lg flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
          </div>
          <div>
            <p class="font-bold text-lg text-gray-800">Phone Number</p>
            <p class="text-gray-600">(+62)81 414 257 9980</p>
          </div>
        </div>

        <!-- Email Card -->
        <div class="flex items-start gap-4 p-4 bg-white rounded-lg shadow-xs hover:shadow-md transition-shadow duration-300">
          <div class="bg-[#ffe6ee] text-[#fc8eac] p-3 rounded-lg flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <div>
            <p class="font-bold text-lg text-gray-800">Email Address</p>
            <p class="text-gray-600">info@yourdomain.com</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Form - Right Column -->
    <div class="w-full md:w-1/2 bg-white border rounded-xl contact-card p-6 md:p-8 shadow-lg">
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          echo "<div class='mb-6 p-4 bg-[#fce4ec] text-[#d81b60] rounded-lg border border-[#f8bbd0]'>";
          echo "<h3 class='font-bold text-lg mb-2 text-[#d81b60]'>✓ Message Sent Successfully!</h3>";
          echo "<div class='space-y-1 text-sm'>";
          echo "<p><span class='font-medium'>Name:</span> " . htmlspecialchars($_POST["name"]) . "</p>";
          echo "<p><span class='font-medium'>Email:</span> " . htmlspecialchars($_POST["email"]) . "</p>";
          echo "<p><span class='font-medium'>Phone:</span> " . htmlspecialchars($_POST["phone"]) . "</p>";
          echo "<p class='pt-2'><span class='font-medium'>Message:</span><br>" . nl2br(htmlspecialchars($_POST["message"])) . "</p>";
          echo "</div></div>";
        }
      ?>

      <form method="POST" class="space-y-4 md:space-y-6">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
          <input id="name" name="name" type="text" placeholder="John Doe" required 
                 class="w-full px-4 py-3 border  rounded-lg focus:outline-none focus:ring-2 focus:ring-[#fc8eac] focus:border-transparent transition">
        </div>
        
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Your Email</label>
          <input id="email" name="email" type="email" placeholder="john@example.com" required 
                 class="w-full px-4 py-3 border  rounded-lg focus:outline-none focus:ring-2 focus:ring-[#fc8eac] focus:border-transparent transition">
        </div>
        
        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Your Phone</label>
          <input id="phone" name="phone" type="tel" placeholder="(+62) 123 456 789" required 
                 class="w-full px-4 py-3 border  rounded-lg focus:outline-none focus:ring-2 focus:ring-[#fc8eac] focus:border-transparent transition">
        </div>
        
        <div>
          <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Message</label>
          <textarea id="message" name="message" rows="4" placeholder="How can we help you?" required 
                    class="w-full px-4 py-3 border  rounded-lg focus:outline-none focus:ring-2 focus:ring-[#fc8eac] focus:border-transparent transition"></textarea>
        </div>
        
        <button type="submit" 
                class="w-full bg-[#fc8eac] hover:bg-[#e47a98] text-white font-medium py-3 px-6 rounded-lg transition duration-300 transform hover:scale-[1.02] active:scale-[0.98]">
          Send Message
        </button>
      </form>
    </div>
  </div>
</body>
</html>