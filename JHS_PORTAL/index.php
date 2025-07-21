<?php
include 'db_connect.php';
// echo "Connected successfully!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JHS Portal - Landing Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .hero-bg {
      background-image: url('https://images.unsplash.com/photo-1501504905252-473c47e087f8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2074&q=80');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-900">
  <!-- Header/Navbar -->
  <header class="bg-white shadow sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto flex items-center justify-between px-4 py-5">
      <div class="flex items-center gap-2">
        <img src="logo.jpg" alt="SHS Logo" class="h-20 w-20 object-contain -mt-6 -mb-6">
      </div>
      <ul class="hidden md:flex gap-10 items-center font-semibold text-lg">
        <li><a href="#" class="hover:text-blue-700 transition">Home</a></li>
        <li><a href="#about" class="hover:text-blue-700 transition">About us</a></li>
        <li><a href="#grades" class="hover:text-blue-700 transition">Grades</a></li>
        <li><a href="#contacts" class="hover:text-blue-700 transition">Contacts</a></li>
      </ul>
      <a href="LOGIN.php" class="ml-4 px-6 py-3 bg-blue-100 text-blue-700 rounded-xl font-bold hover:bg-blue-200 transition text-base">Sign in</a>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="hero-bg relative min-h-screen flex items-center justify-center">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative z-10 max-w-3xl text-center text-white py-40 px-4">
      <h1 class="text-4xl md:text-5xl font-extrabold mb-6 drop-shadow">Welcome to the Junior High School Grading Portal</h1>
      <p class="mb-8 text-2xl font-medium drop-shadow">Easily track your grades, manage academic records, and ensure transparency in the grading process. Our system simplifies grading for students, teachers, and administrators making academic management seamless and efficient.</p>
      <a href="LOGIN.php" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-xl shadow transition text-lg">Get Started</a>
    </div>
  </section>

  <!-- About Us Section -->
  <section id="about" class="bg-gradient-to-br from-blue-800 to-blue-600 py-32 px-4">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-8">About Us</h2>
      <p class="text-white text-2xl font-medium">Welcome to the Junior High School Grading Portal, your all-in-one platform for managing student grades with ease and confidence. Designed for students, teachers, and school administrators, our system streamlines the grading process while ensuring accuracy, transparency, and secure access to academic records. With an organized and user-friendly interface, keeping track of academic performance has never been more efficient.</p>
    </div>
  </section>

  <!-- Grades Table Section -->
  <section id="grades" class="bg-[#f9f6f2] py-28 px-4">
    <div class="max-w-4xl mx-auto">
      <h2 class="text-3xl md:text-4xl font-extrabold text-center text-blue-800 mb-4">Understanding Junior High School Grading</h2>
      <p class="text-center text-gray-700 mb-10 max-w-2xl mx-auto text-lg">Junior High School grading usually follows a numerical or letter-based scale, where each grade corresponds to a range of percentages. Students' performance is evaluated based on their academic work, quizzes, projects, exams, and overall participation.</p>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow text-lg">
          <thead>
            <tr class="border-b">
              <th class="py-4 px-6 text-left font-bold text-blue-800">Grade</th>
              <th class="py-4 px-6 text-left font-bold text-blue-800">Grade Percentage Equivalent</th>
              <th class="py-4 px-6 text-left font-bold text-blue-800">Description</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            <tr><td class="py-3 px-6">1</td><td class="py-3 px-6">98-100</td><td class="py-3 px-6">Outstanding</td></tr>
            <tr><td class="py-3 px-6">1.25</td><td class="py-3 px-6">95-97</td><td class="py-3 px-6">Very Good</td></tr>
            <tr><td class="py-3 px-6">1.50</td><td class="py-3 px-6">92-94</td><td class="py-3 px-6">Good</td></tr>
            <tr><td class="py-3 px-6">1.75</td><td class="py-3 px-6">89-91</td><td class="py-3 px-6">Above Average</td></tr>
            <tr><td class="py-3 px-6">2.00</td><td class="py-3 px-6">86-88</td><td class="py-3 px-6">Satisfactory</td></tr>
            <tr><td class="py-3 px-6">2.25</td><td class="py-3 px-6">83-85</td><td class="py-3 px-6">Fair</td></tr>
            <tr><td class="py-3 px-6">2.50</td><td class="py-3 px-6">80-82</td><td class="py-3 px-6">Passing</td></tr>
            <tr><td class="py-3 px-6">2.75</td><td class="py-3 px-6">77-79</td><td class="py-3 px-6">Below Average</td></tr>
            <tr><td class="py-3 px-6">3.00</td><td class="py-3 px-6">75-76</td><td class="py-3 px-6">Barely Passing</td></tr>
            <tr><td class="py-3 px-6">5.00</td><td class="py-3 px-6">Below 75</td><td class="py-3 px-6">Failing</td></tr>
            <tr><td class="py-3 px-6">INC</td><td class="py-3 px-6">Incomplete</td><td class="py-3 px-6">Incomplete</td></tr>
            <tr><td class="py-3 px-6">OD</td><td class="py-3 px-6">Officially Dropped</td><td class="py-3 px-6">Officially Dropped</td></tr>
            <tr><td class="py-3 px-6">UD</td><td class="py-3 px-6">Unofficially Dropped</td><td class="py-3 px-6">Unofficially Dropped</td></tr>
            <tr><td class="py-3 px-6">W</td><td class="py-3 px-6">Withdrawn</td><td class="py-3 px-6">Withdrawn</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer id="contacts" class="bg-gradient-to-br from-blue-800 to-blue-600 text-white pt-20 pb-10 px-4 mt-16">
    <div class="max-w-7xl mx-auto grid md:grid-cols-5 gap-12">
      <div class="md:col-span-1 flex flex-col gap-4 items-start">
        <h4 class="font-bold mb-1 text-lg">About</h4>
        <p class="text-base">JHS Grading Portal provides students, teachers, and administrators with a secure and efficient platform to manage, view, and analyze academic grades and records.</p>
        <div class="flex gap-4 mt-2 text-2xl">
          <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
          <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a>
        </div>
      </div>
      <div>
        <h4 class="font-bold mb-3 text-lg">Portal</h4>
        <ul class="space-y-2 text-base">
          <li><a href="#" class="hover:underline">Dashboard</a></li>
          <li><a href="#" class="hover:underline">Student Records</a></li>
          <li><a href="#" class="hover:underline">Teachers</a></li>
          <li><a href="#about" class="hover:underline">About Us</a></li>
          <li><a href="#contacts" class="hover:underline">Contacts</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold mb-3 text-lg">Help</h4>
        <ul class="space-y-2 text-base">
          <li><a href="#" class="hover:underline">Help/FAQ</a></li>
          <li><a href="#" class="hover:underline">How to Use</a></li>
          <li><a href="#" class="hover:underline">Contact Support</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold mb-3 text-lg">More</h4>
        <ul class="space-y-2 text-base">
          <li><a href="#" class="hover:underline">Academic Calendar</a></li>
          <li><a href="#" class="hover:underline">School Announcements</a></li>
          <li><a href="#" class="hover:underline">Parent Access</a></li>
          <li><a href="#" class="hover:underline">Resources</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold mb-3 text-lg">Terms</h4>
        <ul class="space-y-2 text-base">
          <li><a href="#" class="hover:underline">Privacy Policy</a></li>
          <li><a href="#" class="hover:underline">Terms of Use</a></li>
          <li><a href="#" class="hover:underline">Accessibility</a></li>
        </ul>
      </div>
    </div>
    <div class="text-center text-base text-white mt-10 opacity-80">
      © 2025 JHS GRADING PORTAL . All rights reserved.
    </div>
  </footer>
  <!-- Back to Top Button -->
  <button id="backToTopBtn" title="Back to top" class="hidden fixed bottom-8 right-8 z-50 bg-blue-700 text-white p-4 rounded-full shadow-lg hover:bg-blue-800 transition-all focus:outline-none">
    <i class="fas fa-arrow-up"></i>
  </button>
  <script>
    // Show/hide button on scroll
    const backToTopBtn = document.getElementById('backToTopBtn');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 300) {
        backToTopBtn.classList.remove('hidden');
      } else {
        backToTopBtn.classList.add('hidden');
      }
    });
    // Smooth scroll to top
    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  </script>
</body>
</html> 