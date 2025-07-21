<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("Location: LOGIN.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard - JHS Grading Portal</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">
  <nav class="bg-blue-700 p-4 text-white flex justify-between items-center">
    <div class="font-bold text-xl">JHS Portal Student</div>
    <div>
        <span class="mr-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <a href="logout.php" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</a>
    </div>
</nav>
  <main class="max-w-3xl mx-auto mt-20 text-center">
    <h1 class="text-4xl font-extrabold mb-6">Welcome, Student!</h1>
    <p class="text-lg mb-10">This is your dashboard. Here you can view your grades, academic records, and important announcements.</p>
    <div class="flex justify-center gap-6 mb-8">
      <button id="viewGradesBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl transition">View Grades</button>
      <button id="viewAnnouncementsBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-xl transition">View Announcements</button>
    </div>
    <div id="gradesSection" class="bg-white rounded-xl shadow p-8 mb-6 hidden">
      <h2 class="text-2xl font-bold mb-4">Your Grades</h2>
      <table class="min-w-full text-left text-base">
        <thead><tr><th class="py-2 px-4">Subject</th><th class="py-2 px-4">Grade</th></tr></thead>
        <tbody>
          <tr><td class="py-2 px-4">Math</td><td class="py-2 px-4">92</td></tr>
          <tr><td class="py-2 px-4">Science</td><td class="py-2 px-4">89</td></tr>
          <tr><td class="py-2 px-4">English</td><td class="py-2 px-4">95</td></tr>
        </tbody>
      </table>
    </div>
    <div id="announcementsSection" class="bg-white rounded-xl shadow p-8 hidden">
      <h2 class="text-2xl font-bold mb-4">Announcements</h2>
      <ul class="text-left list-disc ml-6">
        <li>Quarterly exams start next week.</li>
        <li>School program on Friday, 2pm at the gym.</li>
      </ul>
    </div>
  </main>
  <script>
    const gradesBtn = document.getElementById('viewGradesBtn');
    const announcementsBtn = document.getElementById('viewAnnouncementsBtn');
    const gradesSection = document.getElementById('gradesSection');
    const announcementsSection = document.getElementById('announcementsSection');
    gradesBtn.addEventListener('click', () => {
      gradesSection.classList.toggle('hidden');
      announcementsSection.classList.add('hidden');
    });
    announcementsBtn.addEventListener('click', () => {
      announcementsSection.classList.toggle('hidden');
      gradesSection.classList.add('hidden');
    });
  </script>
</body>
</html> 