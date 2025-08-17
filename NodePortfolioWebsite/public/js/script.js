// Contact form handler (only needed if using JS fetch for form submission)
document.getElementById('contact-form')?.addEventListener('submit', async function (e) {
  e.preventDefault();
  const data = {
    name: this.name.value,
    email: this.email.value,
    message: this.message.value
  };

  try {
    const response = await fetch('/contact', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });

    const text = await response.text();
    alert(text);
    this.reset();
  } catch (err) {
    console.error(err);
    alert("Something went wrong!");
  }
});

// Typing effect (for multiple spans)
document.addEventListener("DOMContentLoaded", function () {
  const spans = document.querySelectorAll(".typing-word");

  spans.forEach((span, spanIndex) => {
    const text = span.getAttribute("data-text");
    let index = 0;

    function typeChar() {
      if (index < text.length) {
        span.textContent += text.charAt(index);
        index++;
        setTimeout(typeChar, 100);
      }
    }

    setTimeout(typeChar, spanIndex * 1500);
  });

  // Delayed card reveal (skills + projects)
  function revealWithDelay(selector, baseDelay = 1500, stepDelay = 1500) {
    const elements = document.querySelectorAll(selector);
    elements.forEach((el, index) => {
      setTimeout(() => {
        el.classList.add("show");
      }, baseDelay + index * stepDelay);
    });
  }

  revealWithDelay(".skill-card", 1500, 1500);
  revealWithDelay(".project-card", 1500, 1500);
});

// AOS init (combined properly)
AOS.init({
  once: true,
  duration: 1000,
  delay: 200
});

// Toggle menu
function toggleMenu() {
  const nav = document.getElementById("nav-links");
  nav.classList.toggle("show");
}
