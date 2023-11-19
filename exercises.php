<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercises</title>
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/exercises.css">
</head>
<body>
    <header>
        <h1>Exercises</h1>
    </header>

    <nav>
        <ul>
            <li><a href="#">Exercise 1</a></li>
            <li><a href="#">Exercise 2</a></li>
            <li><a href="#">Exercise 3</a></li>
            <!-- Add more exercise links as needed -->
        </ul>
    </nav>

    <main>
        <section id="exercise-1">
            <h2>Exercise 1: Title</h2>
            <p>Instructions for Exercise 1 go here.</p>
            <!-- Add exercise content and questions here -->
        </section>

        <section id="exercise-2">
            <h2>Exercise 2: Title</h2>
            <p>Instructions for Exercise 2 go here.</p>
            <!-- Add exercise content and questions here -->
        </section>

        <section id="exercise-3">
            <h2>Exercise 3: Title</h2>
            <p>Instructions for Exercise 3 go here.</p>
            <!-- Add exercise content and questions here -->
        </section>
        
        <!-- Add more exercise sections as needed -->
    </main>
    <script>
                document.addEventListener("DOMContentLoaded", function() {
            // Get all exercise sections
            const exerciseSections = document.querySelectorAll("main section");

            // Hide all exercise sections by default
            exerciseSections.forEach(function(section) {
                section.style.display = "none";
            });

            // Add click event listeners to exercise links in the navigation
            const exerciseLinks = document.querySelectorAll("nav a");
            exerciseLinks.forEach(function(link, index) {
                link.addEventListener("click", function(event) {
                    event.preventDefault();

                    // Hide all exercise sections
                    exerciseSections.forEach(function(section) {
                        section.style.display = "none";
                    });

                    // Show the clicked exercise section
                    exerciseSections[index].style.display = "block";
                });
            });
        });
    </script>    
    <footer>
        <p>&copy; 2023 aauflcdistancelearning. Designed by Eminent All rights reserved.</p>
    </footer>
</body>
</html>
