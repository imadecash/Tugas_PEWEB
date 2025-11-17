document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.getElementById("menu-toggle");
  const sidebar = document.getElementById("sidebar-wrapper");

  if (!toggleBtn || !sidebar) {
    console.log("ID tidak ditemukan!");
    return;
  }

  // --- FUNGSI TOGGLE SIDEBAR ---
  toggleBtn.addEventListener("click", function (e) {
    e.stopPropagation(); // cegah click bubbling
    if (window.innerWidth < 992) {
      sidebar.classList.toggle("active");
      console.log("TOGGLE OK -> sidebar:", sidebar.classList);
    }
  });

  // --- KLIK DI LUAR SIDEBAR = TUTUP ---
  document.addEventListener("click", function (e) {
    if (
      window.innerWidth < 992 &&
      sidebar.classList.contains("active") &&
      !sidebar.contains(e.target) &&
      e.target !== toggleBtn
    ) {
      sidebar.classList.remove("active");
      console.log("Sidebar ditutup dari klik luar");
    }
  });

  // --- KLIK LINK DI SIDEBAR = TUTUP (Mobile) ---
  sidebar.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      if (window.innerWidth < 992) {
        sidebar.classList.remove("active");
        console.log("Sidebar ditutup setelah klik menu");
      }
    });
  });

  // --- Resize layar = reset sidebar ---
  window.addEventListener("resize", function () {
    if (window.innerWidth >= 992) {
      sidebar.classList.remove("active");
    }
  });
});
