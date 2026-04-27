/* ============================================================
   Lomar GCG — App (landscape-focused)
============================================================ */

const SERVICES = [
  {
    key: "garden-design", n: "01",
    en: { t: "Garden Design & Planting", d: "Custom planting plans with native Virginia perennials, evergreens and seasonal color. Designed for four-season interest and low-maintenance upkeep." },
    es: { t: "Diseño de Jardines y Plantaciones", d: "Planes personalizados con plantas nativas de Virginia, siempreverdes y color de temporada. Diseñados para interés en las 4 estaciones y bajo mantenimiento." },
    img: "https://images.unsplash.com/photo-1416879595882-3373a0480b5b?auto=format&fit=crop&w=1200&q=80",
    tag: "Design"
  },
  {
    key: "paver-patios", n: "02",
    en: { t: "Paver Patios & Walkways", d: "Interlocking concrete or natural-stone patios from 200 sqft courtyards to 3,000 sqft entertainment decks. Base-prep done right — no settling, no pooling." },
    es: { t: "Patios y Caminos de Pavers", d: "Patios de concreto entrelazado o piedra natural, desde 200 sqft hasta 3,000 sqft. Base preparada correctamente — sin hundimientos, sin charcos." },
    img: "https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?auto=format&fit=crop&w=1200&q=80",
    tag: "Hardscape"
  },
  {
    key: "outdoor-living", n: "03",
    en: { t: "Outdoor Living Rooms", d: "Full outdoor rooms — dining areas, kitchens, pergolas, lounge zones. Designed for year-round use with proper lighting, heating and shade." },
    es: { t: "Salas Exteriores", d: "Espacios exteriores completos — comedores, cocinas, pérgolas, áreas de descanso. Diseñados para uso durante todo el año." },
    img: "https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=80",
    tag: "Signature"
  },
  {
    key: "retaining-walls", n: "04",
    en: { t: "Retaining Walls & Terracing", d: "Segmental block, natural stone and boulder walls. Usable terraces on difficult slopes, engineered for drainage and 50-year durability." },
    es: { t: "Muros de Contención y Terrazas", d: "Muros modulares, piedra natural y rocas. Terrazas útiles en pendientes difíciles, con drenaje bien diseñado." },
    img: "https://images.unsplash.com/photo-1572120360610-d971b9d7767c?auto=format&fit=crop&w=1200&q=80",
    tag: "Structural"
  },
  {
    key: "lawn-care", n: "05",
    en: { t: "Lawn Care & Maintenance", d: "Seasonal mowing, aeration, overseeding, fertilization and weed control. Healthy, striped-cut turf kept up on weekly rotation." },
    es: { t: "Cuidado de Césped", d: "Corte por temporada, aireación, sobresiembra, fertilización y control de maleza. Césped saludable con mantenimiento semanal." },
    img: "https://images.unsplash.com/photo-1589923188900-85dae523342b?auto=format&fit=crop&w=1200&q=80",
    tag: "Maintenance"
  },
  {
    key: "fireplaces", n: "06",
    en: { t: "Fire Pits & Outdoor Fireplaces", d: "Wood-burning fireplaces, gas fire tables, sunken fire pits and built-in grill islands. Code-compliant flues — they actually draft properly." },
    es: { t: "Chimeneas y Firepits", d: "Chimeneas de leña, mesas de fuego a gas, firepits hundidos e islas de parrilla. Chimeneas bien diseñadas — no humean hacia adentro." },
    img: "https://images.unsplash.com/photo-1601987077677-5346c0c57d3f?auto=format&fit=crop&w=1200&q=80",
    tag: "Signature"
  },
  {
    key: "drainage", n: "07",
    en: { t: "Drainage & Grading", d: "French drains, dry creek beds, yard re-grading and downspout routing. We solve standing-water problems so lawns and foundations stay dry." },
    es: { t: "Drenaje y Nivelación", d: "Drenajes franceses, lechos secos, re-nivelación del terreno y redireccionamiento de canaletas. Resolvemos el agua estancada en tu jardín." },
    img: "https://images.unsplash.com/photo-1464082354059-27db6ce50048?auto=format&fit=crop&w=1200&q=80",
    tag: "Engineering"
  },
  {
    key: "lighting", n: "08",
    en: { t: "Landscape Lighting", d: "Low-voltage LED systems — path lights, tree up-lights, wall washes and step risers. Transformer sized for future expansion." },
    es: { t: "Iluminación de Paisaje", d: "Sistemas LED de bajo voltaje — luces de camino, up-lights para árboles, wall-wash y escalones. Transformador dimensionado para expansión." },
    img: "https://images.unsplash.com/photo-1558882224-dda166733046?auto=format&fit=crop&w=1200&q=80",
    tag: "Finishing"
  }
];

const TESTIMONIALS = [
  {
    en: "We got three quotes for our back garden. Lomar's design had native plantings and a bluestone path the others didn't even consider. Eighteen months in, the garden keeps getting better.",
    es: "Tuvimos tres cotizaciones para nuestro jardín. Lomar propuso plantas nativas y un camino de piedra que los otros ni consideraron. 18 meses después, el jardín sigue mejorando.",
    name: "J. Covington", where: "Ashburn, VA · Garden + Patio"
  },
  {
    en: "Roberto walked us through plant choices for two hours, explained sun exposure and winter hardiness. Felt like talking to a gardener, not a salesman. Our beds look incredible.",
    es: "Roberto nos explicó la selección de plantas por dos horas: exposición al sol, resistencia al invierno. Se sintió como hablar con un jardinero, no un vendedor. Los jardines se ven increíbles.",
    name: "M. Shah", where: "Vienna, VA · Full Landscape"
  },
  {
    en: "They rebuilt our slope with a stone retaining wall and stairway. Crew on site every day, cleaned up every evening, finished three days early. I'd hire them again in a heartbeat.",
    es: "Reconstruyeron nuestra pendiente con un muro de piedra y escaleras. El equipo estuvo todos los días, limpiaron cada tarde, terminaron tres días antes. Los contrataría otra vez sin dudar.",
    name: "A. Foster", where: "McLean, VA · Retaining Wall"
  }
];

const CITIES = [
  { name: "Fairfax", zips: ["22030","22031","22032","22033","22034","22035","22036","22037","22038","22039"] },
  { name: "Ashburn", zips: ["20146","20147","20148","20149"] },
  { name: "Leesburg", zips: ["20175","20176","20177","20178"] },
  { name: "Gainesville", zips: ["20155","20156"] },
  { name: "Vienna", zips: ["22180","22181","22182","22183","22184","22185"] },
  { name: "McLean", zips: ["22101","22102","22103","22106","22107","22108","22109"] },
  { name: "Arlington", zips: ["22201","22202","22203","22204","22205","22206","22207","22209","22213"] },
  { name: "Manassas", zips: ["20108","20109","20110","20111","20112","20113"] }
];
const COVERAGE_ZIPS = new Set(CITIES.flatMap(c => c.zips));

// Bump tweak version to reset stale persisted palettes
const TWEAK_VERSION = 2;
if (+localStorage.getItem("lomar_tweaks_v") !== TWEAK_VERSION) {
  localStorage.removeItem("lomar_tweaks");
  localStorage.setItem("lomar_tweaks_v", TWEAK_VERSION);
}

let LANG = localStorage.getItem("lomar_lang") || "en";
function applyLang() {
  document.documentElement.lang = LANG;
  document.querySelectorAll("[data-t-en]").forEach(el => {
    const v = el.dataset["t" + (LANG === "es" ? "Es" : "En")];
    if (v != null) el.innerHTML = v;
  });
  document.querySelectorAll(".lang-toggle button").forEach(b => {
    b.classList.toggle("on", b.dataset.lang === LANG);
  });
}
document.querySelectorAll(".lang-toggle button").forEach(b => {
  b.addEventListener("click", () => { LANG = b.dataset.lang; localStorage.setItem("lomar_lang", LANG); applyLang(); renderAll(); });
});

const imgFallback = (alt) => `onerror="this.parentNode.innerHTML='<div class=ph style=height:100%;width:100%>'+(this.alt||'IMAGE')+'</div>'"`;

function renderServicesList() {
  const root = document.getElementById("services-list");
  if (!root) return;
  root.innerHTML = SERVICES.map(s => `
    <div class="service-row" data-nav="services">
      <div class="num">${s.n}</div>
      <div>
        <h3>${s[LANG].t}</h3>
        <div style="font-family:var(--font-mono);font-size:var(--fs-xs);letter-spacing:.1em;color:var(--ink-3);text-transform:uppercase;margin-top:6px">${s.tag}</div>
      </div>
      <p>${s[LANG].d}</p>
      <div class="thumb-wrap"><img class="service-thumb" src="${s.img}" alt="${s[LANG].t}" ${imgFallback()}></div>
    </div>`).join("");
}
function renderServicesGrid() {
  const root = document.getElementById("services-grid");
  if (!root) return;
  root.innerHTML = SERVICES.map(s => `
    <a class="service-card" href="#contact" data-nav="contact">
      <div class="media"><img src="${s.img}" alt="${s[LANG].t}" ${imgFallback()}></div>
      <div class="body">
        <div style="font-family:var(--font-mono);font-size:var(--fs-xs);letter-spacing:.1em;color:var(--ink-3);text-transform:uppercase">${s.n} · ${s.tag}</div>
        <h3>${s[LANG].t}</h3>
        <p>${s[LANG].d}</p>
      </div>
      <div class="foot">
        <span>${LANG==='es'?'Solicitar cotización':'Request a quote'}</span>
        <span class="go">→</span>
      </div>
    </a>`).join("");
}
function renderTestimonials() {
  const root = document.getElementById("testimonials");
  if (!root) return;
  root.innerHTML = TESTIMONIALS.map(t => `
    <div class="testimonial">
      <div class="stars">★★★★★</div>
      <div class="q">“${t[LANG]}”</div>
      <div class="who">
        <div class="av">${t.name.split(" ").pop()[0]}</div>
        <div>
          <div class="n">${t.name}</div>
          <div class="w">${t.where}</div>
        </div>
      </div>
    </div>`).join("");
}
function renderCities() {
  const root = document.getElementById("cities-grid");
  if (!root) return;
  root.innerHTML = CITIES.map(c => `
    <div class="city">
      <div class="name">${c.name}, VA</div>
      <div class="zips">${c.zips.slice(0,3).join(" · ")}${c.zips.length>3?" +":""}</div>
    </div>`).join("");
}
function renderAll() { applyLang(); renderServicesList(); renderServicesGrid(); renderTestimonials(); renderCities(); }

function showPage(name) {
  document.querySelectorAll(".page").forEach(p => p.classList.remove("on"));
  const el = document.getElementById("page-" + name);
  if (el) el.classList.add("on");
  document.querySelectorAll(".nav-links a").forEach(a => {
    a.classList.toggle("active", a.dataset.nav === name);
  });
  if (location.hash !== "#" + name) history.replaceState(null, "", "#" + name);
  window.scrollTo({ top: 0, behavior: "instant" });
  renderServicesList(); renderServicesGrid();
  setTimeout(() => { if (window.__map) window.__map.invalidateSize(); }, 60);
}
document.addEventListener("click", (e) => {
  const a = e.target.closest("[data-nav]");
  if (a) { e.preventDefault(); showPage(a.dataset.nav); }
});

function checkZip(e) {
  e.preventDefault();
  const val = document.getElementById("zip-input").value.trim();
  const res = document.getElementById("zip-result");
  if (!/^\d{5}$/.test(val)) {
    res.className = "zip-result no";
    res.textContent = LANG==='es' ? "Ingresa un código postal válido (5 dígitos)." : "Please enter a valid 5-digit ZIP.";
    return false;
  }
  if (COVERAGE_ZIPS.has(val)) {
    const city = CITIES.find(c => c.zips.includes(val));
    res.className = "zip-result ok";
    res.innerHTML = (LANG==='es'
      ? `✓ Sí, servimos ${city.name}, VA. <a href="#contact" data-nav="contact" style="color:inherit;text-decoration:underline">Agenda una visita →</a>`
      : `✓ Yes — we build in ${city.name}, VA. <a href="#contact" data-nav="contact" style="color:inherit;text-decoration:underline">Book a visit →</a>`);
  } else {
    res.className = "zip-result no";
    res.innerHTML = (LANG==='es'
      ? `Este código no está en nuestra ruta regular. <a href="#contact" data-nav="contact" style="color:inherit;text-decoration:underline">Llámanos igual →</a>`
      : `Not on our regular route — but we take on larger projects. <a href="#contact" data-nav="contact" style="color:inherit;text-decoration:underline">Call us anyway →</a>`);
  }
  return false;
}
window.checkZip = checkZip;

function submitContact(e) {
  e.preventDefault();
  document.getElementById("contact-result").style.display = "block";
  e.target.reset();
  return false;
}
window.submitContact = submitContact;

function buildMap() {
  if (typeof L === "undefined") return;
  const el = document.getElementById("service-map");
  if (!el) return;
  const map = L.map(el, { zoomControl: true, scrollWheelZoom: false, attributionControl: true }).setView([38.88, -77.42], 10);
  L.tileLayer("https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png", {
    maxZoom: 18, attribution: '© OSM © CARTO'
  }).addTo(map);
  const points = [
    { name: "Fairfax, VA", lat: 38.8462, lng: -77.3064 },
    { name: "Ashburn, VA", lat: 39.0438, lng: -77.4874 },
    { name: "Leesburg, VA", lat: 39.1157, lng: -77.5636 },
    { name: "Gainesville, VA", lat: 38.7954, lng: -77.6147 },
    { name: "Vienna, VA", lat: 38.9012, lng: -77.2653 },
    { name: "McLean, VA", lat: 38.9339, lng: -77.1772 },
    { name: "Arlington, VA", lat: 38.8799, lng: -77.1067 },
    { name: "Manassas, VA (HQ)", lat: 38.7509, lng: -77.4753, hq: true }
  ];
  L.circle([38.88, -77.42], {
    radius: 30000, color: "#3a6b3a", fillColor: "#3a6b3a", fillOpacity: 0.08,
    weight: 1.5, dashArray: "4 6"
  }).addTo(map);
  points.forEach(p => {
    const icon = L.divIcon({
      className: "",
      html: `<div style="width:${p.hq?20:14}px;height:${p.hq?20:14}px;border-radius:50%;background:${p.hq?'#3a6b3a':'#fff'};border:${p.hq?'3px solid #fff':'3px solid #3a6b3a'};box-shadow:0 2px 10px rgba(0,0,0,.25);"></div>`,
      iconSize: [p.hq?26:20, p.hq?26:20],
      iconAnchor: [p.hq?13:10, p.hq?13:10]
    });
    const m = L.marker([p.lat, p.lng], { icon }).addTo(map);
    m.bindTooltip(p.name, { direction: "top", offset: [0, -10] });
  });
  window.__map = map;
}

(function setupTweaks() {
  window.addEventListener("message", (e) => {
    const d = e.data || {};
    if (d.type === "__activate_edit_mode") document.getElementById("tweaks").classList.add("show");
    if (d.type === "__deactivate_edit_mode") document.getElementById("tweaks").classList.remove("show");
  });
  try { window.parent.postMessage({ type: "__edit_mode_available" }, "*"); } catch(_) {}
  const saved = JSON.parse(localStorage.getItem("lomar_tweaks") || "null");
  if (saved) {
    if (saved.palette) document.documentElement.dataset.palette = saved.palette;
    if (saved.type) document.documentElement.dataset.type = saved.type;
  }
  function updateUI() {
    document.querySelectorAll("#tw-palette .sw").forEach(b => b.classList.toggle("on", b.dataset.v === document.documentElement.dataset.palette));
    document.querySelectorAll("#tw-type .opt").forEach(b => b.classList.toggle("on", b.dataset.v === document.documentElement.dataset.type));
  }
  updateUI();
  function persist() {
    const v = { palette: document.documentElement.dataset.palette, type: document.documentElement.dataset.type };
    localStorage.setItem("lomar_tweaks", JSON.stringify(v));
    try { window.parent.postMessage({ type: "__edit_mode_set_keys", edits: v }, "*"); } catch(_) {}
  }
  document.querySelectorAll("#tw-palette .sw").forEach(b => b.addEventListener("click", () => { document.documentElement.dataset.palette = b.dataset.v; updateUI(); persist(); }));
  document.querySelectorAll("#tw-type .opt").forEach(b => b.addEventListener("click", () => { document.documentElement.dataset.type = b.dataset.v; updateUI(); persist(); }));
})();

const initHash = (location.hash || "#home").replace("#", "");
renderAll();
if (["home","services","portfolio","about","contact"].includes(initHash)) showPage(initHash);
buildMap();
