// assets/js/main.js
// ── Navbar scroll effect ──────────────────────────────────
window.addEventListener('scroll', () => {
  const navbar = document.getElementById('navbar');
  if (window.scrollY > 80) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
});

// ── Mobile nav toggle ─────────────────────────────────────
function toggleNav() {
  const links = document.getElementById('navLinks');
  links.classList.toggle('open');
}

// ── Scroll to booking ─────────────────────────────────────
function scrollToBooking() {
  document.getElementById('booking').scrollIntoView({ behavior: 'smooth' });
}

// ── Set default dates for booking ─────────────────────────
window.addEventListener('DOMContentLoaded', () => {
  const today    = new Date();
  const checkIn  = new Date(today);
  const checkOut = new Date(today);
  checkIn.setDate(today.getDate() + 3);
  checkOut.setDate(today.getDate() + 7);

  const fmt = d => d.toISOString().split('T')[0];
  const ciEl = document.getElementById('checkin');
  const coEl = document.getElementById('checkout');
  if (ciEl) ciEl.value = fmt(checkIn);
  if (coEl) coEl.value = fmt(checkOut);

  // Close nav on link click
  document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
      document.getElementById('navLinks').classList.remove('open');
    });
  });

  // Wishlist toggle
  document.querySelectorAll('.wishlist-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      this.textContent = this.textContent === '♡' ? '❤️' : '♡';
    });
  });

  // Simple scroll reveal
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.resort-card, .exp-card, .testi-card, .why-card').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease, box-shadow 0.35s ease';
    observer.observe(el);
  });
});
