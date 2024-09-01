document.addEventListener("DOMContentLoaded", function() {
  const menuToggle = document.querySelector('.menu-toggle');
  const sideMenu = document.querySelector('.side-menu');
  const navLinks = document.querySelectorAll('nav ul li a');
  const sideMenuLinks = document.querySelectorAll('.side-menu a');

  // Toggle side menu
  menuToggle.addEventListener('click', () => {
    sideMenu.classList.toggle('show');
  });

  // Smooth scrolling for nav links
  navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      const href = link.getAttribute('href');
      if (href && href.startsWith('#')) {
        e.preventDefault();
        const targetId = href.substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 70, // Adjust for header height
            behavior: 'smooth'
          });
        }
      }
    });
  });

  // Smooth scrolling for side menu links
  sideMenuLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      const href = link.getAttribute('href');
      if (href && href.startsWith('#')) {
        e.preventDefault();
        const targetId = href.substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 70, // Adjust for header height
            behavior: 'smooth'
          });
          sideMenu.classList.remove('show'); // Close side menu on link click
        }
      }
    });
  });

  // Highlight active section
  const sections = document.querySelectorAll('section');
  const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.5
  };

  const observerCallback = (entries) => {
    entries.forEach(entry => {
      const id = entry.target.id;
      const menuLink = document.querySelector(`.side-menu a[href="#${id}"]`);
      const navLink = document.querySelector(`nav ul li a[href="#${id}"]`);

      if (entry.isIntersecting) {
        if (menuLink) menuLink.classList.add('active');
        if (navLink) navLink.classList.add('active');
      } else {
        if (menuLink) menuLink.classList.remove('active');
        if (navLink) navLink.classList.remove('active');
      }
    });
  };

  const observer = new IntersectionObserver(observerCallback, observerOptions);
  sections.forEach(section => observer.observe(section));

  // Add CSS for active class
  const style = document.createElement('style');
  style.innerHTML = `
    .side-menu.show {
      display: block;
    }
    .side-menu a.active,
    nav ul li a.active {
      color: #ff7f50;
    }
  `;
  document.head.appendChild(style);
});
