<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kpoint Savings Launch Countdown</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts for a classic feel -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --kpoint-main-purple: #7417b3; /* Your specified main purple color */
      --kpoint-dark-purple: #4a0f73; /* A darker shade for gradient */
      --text-light: #f8f9fa; /* Light text for contrast */
      --card-bg: #ffffff;
      --border-color: #dee2e6;
    }

    /* Keyframe for background gradient animation */
    @keyframes gradient-animation {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Keyframe for container entrance animation */
    @keyframes fadeInScale {
      0% { opacity: 0; transform: scale(0.9); }
      100% { opacity: 1; transform: scale(1); }
    }

    /* Keyframe for number pulse animation */
    @keyframes number-pulse {
      0% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.05); opacity: 0.8; }
      100% { transform: scale(1); opacity: 1; }
    }

    body, html {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      /* Gradient background with animation */
      background: linear-gradient(135deg, var(--kpoint-main-purple), var(--kpoint-dark-purple));
      background-size: 200% 200%; /* Make gradient larger for animation */
      animation: gradient-animation 15s ease infinite; /* Apply continuous animation */
      font-family: 'Roboto', sans-serif;
      color: var(--text-light);
      overflow: hidden; /* Prevent scrollbars from background animation */
    }
    .countdown-container {
      text-align: center;
      padding: 40px;
      border-radius: 15px;
      background-color: var(--card-bg);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
      max-width: 90%;
      width: 700px;
      /* Apply entrance animation */
      animation: fadeInScale 1s ease-out forwards;
      opacity: 0; /* Start invisible for animation */
    }
    .logo {
      max-width: 150px;
      height: auto;
      margin-bottom: 30px;
      transition: transform 0.3s ease-in-out; /* Smooth hover effect */
    }
    .logo:hover {
      transform: scale(1.05);
    }
    h1 {
      font-family: 'Playfair Display', serif;
      font-size: 3rem;
      margin-bottom: 25px;
      color: var(--kpoint-main-purple);
      font-weight: 700;
    }
    .countdown-timer {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-top: 40px;
      flex-wrap: wrap; /* Allow wrapping on smaller screens */
    }
    .time-unit {
      display: flex;
      flex-direction: column;
      align-items: center;
      font-size: 3.5rem;
      font-weight: 700;
      color: var(--kpoint-main-purple);
      background-color: #f0f0f0;
      padding: 15px 25px;
      border-radius: 10px;
      min-width: 120px;
      box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
      border: 1px solid var(--border-color);
      transition: transform 0.1s ease-out; /* For number pulse animation */
    }
    .time-unit div { /* Target the number div inside time-unit */
      display: inline-block; /* Needed for transform on numbers */
    }
    .time-unit div.animated {
      animation: number-pulse 0.3s ease-out; /* Apply pulse animation */
    }
    .time-unit span {
      font-family: 'Roboto', sans-serif;
      font-size: 1rem;
      font-weight: 400;
      color: #6c757d;
      margin-top: 10px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    #countdown-message {
      font-size: 1.3rem;
      margin-top: 30px;
      color: var(--kpoint-main-purple);
      font-weight: 500;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .logo {
        max-width: 120px;
      }
      h1 {
        font-size: 2.5rem;
      }
      .time-unit {
        font-size: 2.8rem;
        padding: 12px 20px;
        min-width: 100px;
      }
      .time-unit span {
        font-size: 0.9rem;
      }
      .countdown-timer {
        gap: 20px;
      }
    }
    @media (max-width: 576px) {
      .logo {
        max-width: 100px;
      }
      h1 {
        font-size: 2rem;
      }
      .countdown-container {
        padding: 25px;
      }
      .time-unit {
        font-size: 2.2rem;
        padding: 10px 15px;
        min-width: 80px;
        flex-basis: 45%; /* Two units per row */
        margin-bottom: 10px; /* Add some vertical spacing when wrapped */
      }
      .time-unit span {
        font-size: 0.8rem;
      }
      .countdown-timer {
        gap: 15px;
      }
    }
  </style>
</head>
<body>
  <div class="countdown-container">
    <img src="https://sjc.microlink.io/dAhC4GpB_F3XnIgllzgK0GoByFntjZjBx_ya_SwUpqyRu6eW1B-kSC0D6NjNrvlmZ9KHXBnlMEMhoP8r2FHA9w.jpeg" alt="Kpoint Savings Logo" class="logo">
    <h1>Launching Soon!</h1>
    <div class="countdown-timer" id="countdown-timer">
      <div class="time-unit">
        <div id="days">00</div>
        <span>Days</span>
      </div>
      <div class="time-unit">
        <div id="hours">00</div>
        <span>Hours</span>
      </div>
      <div class="time-unit">
        <div id="minutes">00</div>
        <span>Minutes</span>
      </div>
      <div class="time-unit">
        <div id="seconds">00</div>
        <span>Seconds</span>
      </div>
    </div>
    <p id="countdown-message" class="mt-4"></p>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function updateCountdown() {
      const targetDate = new Date("September 1, 2025 00:00:00").getTime();
      const now = new Date().getTime();
      const distance = targetDate - now;

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Get elements
      const daysEl = document.getElementById("days");
      const hoursEl = document.getElementById("hours");
      const minutesEl = document.getElementById("minutes");
      const secondsEl = document.getElementById("seconds");

      // Function to update element and apply animation if value changes
      function updateAndAnimate(element, newValue) {
        const oldValue = element.innerHTML;
        if (oldValue !== newValue) {
          element.classList.add('animated');
          // Remove the class after animation ends to allow re-triggering
          element.addEventListener('animationend', () => {
            element.classList.remove('animated');
          }, { once: true });
          element.innerHTML = newValue;
        }
      }

      updateAndAnimate(daysEl, String(days).padStart(2, '0'));
      updateAndAnimate(hoursEl, String(hours).padStart(2, '0'));
      updateAndAnimate(minutesEl, String(minutes).padStart(2, '0'));
      updateAndAnimate(secondsEl, String(seconds).padStart(2, '0'));

      if (distance < 0) {
        clearInterval(countdownInterval);
        document.getElementById("countdown-timer").innerHTML = "";
        document.getElementById("countdown-message").innerHTML = "We're Live! Welcome to Kpoint Savings!";
        document.getElementById("countdown-message").style.color = "var(--kpoint-main-purple)";
      }
    }

    // Update the countdown every 1 second
    const countdownInterval = setInterval(updateCountdown, 1000);

    // Initial call to display countdown immediately
    updateCountdown();
  </script>
</body>
</html>
