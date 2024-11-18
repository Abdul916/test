<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Popup with Toggle Button and Beep Sound</title>
  <style>
    /* Popup styling */
    #popup {
      display: none; /* Initially hidden */
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 300px;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #333;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      text-align: center;
    }

    /* Overlay for the popup */
    #overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }

    /* Button styling */
    .toggle-btn {
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<!-- Button to open/close popup -->
<button id="toggleBtn" class="toggle-btn">Open Popup</button>

<!-- Popup content -->
<div id="overlay"></div>
<div id="popup">
  <h2>Popup Content</h2>
  <p>This is the popup content.</p>
</div>

<!-- Audio element for beep sound -->
<audio id="beepSound" src="beep.mp3" preload="auto"></audio>

<script>
  // Get elements
  const toggleBtn = document.getElementById('toggleBtn');
  const popup = document.getElementById('popup');
  const overlay = document.getElementById('overlay');
  const beepSound = document.getElementById('beepSound');

  // Toggle button click event
  toggleBtn.addEventListener('click', function() {
    // Check if popup is visible
    if (popup.style.display === 'none' || popup.style.display === '') {
      // Show popup and overlay
      popup.style.display = 'block';
      overlay.style.display = 'block';
      // Change button text
      toggleBtn.textContent = 'Close Popup';
      // Play beep sound
      beepSound.play();
    } else {
      // Hide popup and overlay
      popup.style.display = 'none';
      overlay.style.display = 'none';
      // Change button text
      toggleBtn.textContent = 'Open Popup';
    }
  });

  // Close popup if overlay is clicked
  overlay.addEventListener('click', function() {
    popup.style.display = 'none';
    overlay.style.display = 'none';
    toggleBtn.textContent = 'Open Popup';
  });
</script>

</body>
</html>
