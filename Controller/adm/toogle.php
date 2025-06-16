<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .icon-toggle-btn {
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      font-size: 24px;
      color: #ccc;
      transition: all 0.3s ease;
    }

    .icon-toggle-btn[aria-pressed="true"] {
      color: #29b5a8;
    }

    .icon-toggle-btn[aria-pressed="true"] .fa-toggle-off {
      display: none;
    }

    .icon-toggle-btn[aria-pressed="false"] .fa-toggle-on {
      display: none;
    }

    .icon-toggle-btn .fa-toggle-on,
    .icon-toggle-btn .fa-toggle-off {
      vertical-align: middle;
    }
  </style>
</head>
<body>
  <button type="button" class="icon-toggle-btn" aria-pressed="false">
    <i class="fa-solid fa-toggle-off"></i>
    <i class="fa-solid fa-toggle-on"></i>
  </button>

  <script>
    document.querySelectorAll('.icon-toggle-btn').forEach(button => {
      button.addEventListener('click', function() {
        const isPressed = this.getAttribute('aria-pressed') === 'true';
        this.setAttribute('aria-pressed', !isPressed);
      });
    });
  </script>
</body>
</html>