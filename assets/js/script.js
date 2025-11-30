document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.getElementById("public-menu-toggle");
  const sidebar = document.getElementById("public-sidebar");

  // Create overlay element
  const overlay = document.createElement("div");
  overlay.className = "sidebar-overlay";
  document.body.appendChild(overlay);

  if (toggleBtn && sidebar) {
    // Toggle Sidebar
    toggleBtn.addEventListener("click", function (e) {
      e.stopPropagation();
      sidebar.classList.toggle("active");
      overlay.classList.toggle("active");
    });

    // Close when clicking overlay
    overlay.addEventListener("click", function () {
      sidebar.classList.remove("active");
      overlay.classList.remove("active");
    });

    // Close when clicking a link
    const links = sidebar.querySelectorAll("a");
    links.forEach((link) => {
      link.addEventListener("click", function () {
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
      });
    });
  }
});

// Function to toggle password visibility
function togglePassword(inputId, iconId) {
  const input = document.getElementById(inputId);
  const icon = document.getElementById(iconId);

  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove("bi-eye");
    icon.classList.add("bi-eye-slash");
  } else {
    input.type = "password";
    icon.classList.remove("bi-eye-slash");
    icon.classList.add("bi-eye");
  }
}
