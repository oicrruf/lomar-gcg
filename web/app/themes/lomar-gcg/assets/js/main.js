/** @type {module} LoMar GCG — main.js */

// ── Nav scroll behavior ────────────────────────────────────────────────
const initNavScroll = () => {
  const nav = document.getElementById('site-nav');
  if (!nav) return;

  const onScroll = () => {
    nav.classList.toggle('scrolled', window.scrollY > 60);
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll(); // run once on load
};

// ── Mobile menu ────────────────────────────────────────────────────────
const initMobileMenu = () => {
  const toggle = document.querySelector('.mobile-toggle');
  const menu   = document.getElementById('mobile-menu');
  const close  = document.querySelector('.mobile-close');

  if (!toggle || !menu) return;

  const open = () => {
    menu.classList.add('open');
    toggle.setAttribute('aria-expanded', 'true');
    menu.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  };

  const closeMenu = () => {
    menu.classList.remove('open');
    toggle.setAttribute('aria-expanded', 'false');
    menu.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  };

  toggle.addEventListener('click', open);
  close?.addEventListener('click', closeMenu);

  // Close on ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && menu.classList.contains('open')) closeMenu();
  });
};

// ── GLightbox ─────────────────────────────────────────────────────────
const initLightbox = () => {
  if (typeof GLightbox === 'undefined') return;

  GLightbox({
    selector: '.glightbox',
    touchNavigation: true,
    loop: true,
    autoplayVideos: false,
  });
};

// ── Leaflet service area map ───────────────────────────────────────────
const initMap = () => {
  const mapEl = document.getElementById('service-map');
  if (!mapEl || typeof L === 'undefined') return;

  const map = L.map('service-map', {
    center: [38.9, -77.3],
    zoom: 9,
    scrollWheelZoom: false,
    zoomControl: true,
  });

  // CartoDB Positron tiles — minimal, matches Studio Green palette
  L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions">CARTO</a>',
    subdomains: 'abcd',
    maxZoom: 19,
  }).addTo(map);

  // Northern Virginia service area polygon
  // Approximate boundary: Loudoun · Fairfax · Prince William · Arlington · Alexandria
  L.polygon(
    [
      [39.32, -77.73], // NW Loudoun
      [39.32, -77.10], // NE
      [38.95, -77.07], // Arlington/Alexandria
      [38.58, -77.16], // SE Prince William
      [38.55, -77.68], // SW
      [39.02, -77.88], // W Loudoun
    ],
    {
      color: 'oklch(0.52 0.20 132)',
      fillColor: 'oklch(0.52 0.20 132)',
      fillOpacity: 0.12,
      weight: 2,
      opacity: 0.7,
    }
  ).addTo(map);

  // Custom marker for company location
  const icon = L.divIcon({
    html: `<div style="
      width:36px;height:36px;
      background:oklch(0.52 0.20 132);
      border-radius:50% 50% 50% 0;
      transform:rotate(-45deg);
      border:3px solid white;
      box-shadow:0 2px 8px rgba(0,0,0,.25);
    "></div>`,
    iconSize: [36, 36],
    iconAnchor: [18, 36],
    className: '',
  });

  L.marker([38.87, -77.37], { icon })
    .addTo(map)
    .bindPopup('<strong>LoMar GCG</strong><br>Northern Virginia')
    .openPopup();
};

// ── Portfolio filter ───────────────────────────────────────────────────
const initPortfolioFilter = () => {
  const filters  = document.querySelectorAll('.pf-filter');
  const grid     = document.querySelector('.portfolio-grid--full');
  const countEl  = document.getElementById('pf-visible-count');

  if (!filters.length || !grid) return;

  const items = Array.from(grid.querySelectorAll('.pf-item'));

  const updateCount = () => {
    const visible = items.filter(el => !el.classList.contains('pf-hidden')).length;
    if (countEl) countEl.textContent = visible;
  };

  // Set initial count
  updateCount();

  const applyFilter = (active) => {
    items.forEach(item => {
      const service = item.dataset.service || '';
      const match   = active === 'all' || service === active;

      if (!match) {
        item.classList.add('pf-hiding');
        setTimeout(() => {
          item.classList.add('pf-hidden');
          item.classList.remove('pf-hiding');
          updateCount();
        }, 230);
      } else {
        item.classList.remove('pf-hidden');
        // Force reflow so transition plays
        void item.offsetWidth;
        item.classList.remove('pf-hiding');
        updateCount();
      }
    });
  };

  filters.forEach(btn => {
    btn.addEventListener('click', () => {
      filters.forEach(b => {
        b.classList.remove('on');
        b.setAttribute('aria-selected', 'false');
      });
      btn.classList.add('on');
      btn.setAttribute('aria-selected', 'true');
      applyFilter(btn.dataset.filter);
    });
  });
};

// ── Hero stat counters ─────────────────────────────────────────────────
const initStatCounters = () => {
  const nodes = document.querySelectorAll('.hero-meta > div .n');
  if (!nodes.length) return;

  const countUp = (el, target, duration = 900) => {
    const suffix = el.querySelector('em')?.textContent ?? '';
    const start = performance.now();
    const tick = (now) => {
      const progress = Math.min((now - start) / duration, 1);
      const ease = 1 - Math.pow(1 - progress, 3);
      el.firstChild.textContent = Math.round(ease * target);
      if (progress < 1) requestAnimationFrame(tick);
      else el.firstChild.textContent = target;
    };
    el.innerHTML = `0<em>${suffix}</em>`;
    requestAnimationFrame(tick);
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      observer.unobserve(entry.target);
      const el = entry.target;
      const raw = el.textContent.replace(/\D/g, '');
      countUp(el, parseInt(raw, 10));
    });
  }, { threshold: 0.5 });

  nodes.forEach(n => observer.observe(n));
};

// ── Init all ──────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  initNavScroll();
  initMobileMenu();
  initPortfolioFilter();
  initStatCounters();
});

// Lightbox and map depend on deferred CDN scripts (glightbox, leaflet).
// window.load fires after all deferred scripts have executed.
window.addEventListener('load', () => {
  initLightbox();
  // Map renders on homepage and contact page (both include #service-map).
  if (document.getElementById('service-map')) initMap();
});
