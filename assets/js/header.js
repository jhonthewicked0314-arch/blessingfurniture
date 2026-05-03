window.addEventListener("scroll", function () {
  const header = document.querySelector(".bootm-headers");
  const stickyPoint = header.offsetTop;

  if (window.pageYOffset > stickyPoint) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
});


/* Menu toggle */
$(".memnu-clos-open").click(function (event) {
  event.preventDefault();
  $("nav").toggleClass("shows");
});

const MENU_DATA = [
  {
    slug:"hinges",category:"Worksmart",
    products:[
      {name:"Monitor Arms",url:"#"},
      {name:"Key Board Trays",url:"#"},
    //   {name:"Door Closer",url:"#"},
      {name:"EB Boxes",url:"#"},
      {name:"CPU Stands",url:"#"},
      {name:"Cable Organizer",url:"#"}
    ]
  },
  
 {
  slug:"drawer",
  category:"Ebco",
  products:[
    {
      name:"Drawer Slides & Hinges",
      url:"#",
      children:[
        { name:"Drawer Slides", url:"#"},
        { name:"Hinges", url:"#"}
      ]
    },

    {
      name:"Window, Door & Glass Hardware",
      url:"#",
      children:[   // ✅ ADD THIS
        { name:"Sliding Doors", url:"#"},
        { name:"Mortise Door Handles", url:"#"},
        { name:"Door Closer", url:"#"},
        { name:"Floor Springs", url:"#"},
        { name:"Patch Fittings", url:"#"}
      ]
    },

  {
  name:"General Hardware",
  url:"#",
  children:[
    {name:"Plinth Fittings",url:"#"},
    {name:"Cabinet Shelf Supports",url:"#"},
    {name:"Cabinet Supports",url:"#"},
    {name:"Pro Lifts",url:"#"},
    {name:"Cabinet Stay",url:"#"},
    {name:"Table Brackets",url:"#"},
    {name:"Wall Mounting Folding Drying Rack",url:"#"},
    {name:"Turn Table Mechanism",url:"#"},
    {name:"Pole Shelving System",url:"#"},
    {name:"Cube Shelving System",url:"#"}
  ]
},
    {name:"Joinery Fittings & Screws",url:"#"},
   {
  name:"Furniture Locks",
  url:"#",
  children:[
    { name:"Locks (Drawer & CupBoard)", url:"#"}
  ]
},
    {name:"Retail Display Systems",url:"#"},
    {name:"Digital Locks",url:"#"}
  ]
},
 {
  slug:"sliding",
  category:"Livsmart",
  products:[

    {
      name:"Kitchen Systems and Accessories",
      url:"#",
      children:[
        {name:"PMDS",url:"#"},
        {name:"Drawer Partitions",url:"#"},
        {name:"Plate Racks & Organiser",url:"#"},
        {name:"Plastic Wicker Baskets",url:"#"},
        {name:"R.A Baskets",url:"#"},
        {name:"Anti Skit Mats",url:"#"},
        {name:"Pull Out Grain Drawer",url:"#"},
        {name:"Corner Solutions",url:"#"},
        {name:"Kitchen Pantry Units",url:"#"},
        {name:"Roll Tops",url:"#"},
        {name:"CupBoard Pullouts",url:"#"},
        {name:"Base & Bottle Pullouts",url:"#"},
        {name:"Overhead Systems",url:"#"},
        {name:"Tray (Plate, Glass, Drip)",url:"#"},
        {name:"Midway System (MS)",url:"#"},
        {name:"Midway System (SS)",url:"#"},
        {name:"Waste Bins",url:"#"},
        {name:"Shutter Grills",url:"#"},
        {name:"Skirtings & Plinth Fittings",url:"#"}
      ]
    },

    {
      name:"Aluminium Profiles and Handles",
      url:"#",
      children:[
        {name:"Profiles HAP",url:"#"},
        {name:"Profiles EGSP",url:"#"},
        {name:"Decorative Profiles",url:"#"},
        {name:"Gola Profiles / Handles",url:"#"},
        {name:"Edge Profiles / Handles",url:"#"},
        {name:"Shutter Handles",url:"#"},
        {name:"Zen Handles",url:"#"},
        {name:"Aluminium Handles",url:"#"},
        {name:"Zinc Handles",url:"#"},
        {name:"Knobs",url:"#"},
        {name:"Plastic Handles",url:"#"}
      ]
    },

    {
      name:"Bed & Wardrobe Fittings and Accessories",
      url:"#",
      children:[
        {name:"Wardrobe Lifts",url:"#"},
        {name:"Wardrobe Pullouts",url:"#"},
        {name:"Safe Drawer",url:"#"},
        {name:"Wardrobe Drawer Organizer",url:"#"},
        {name:"Wardrobe Rail Fittings",url:"#"},
        {name:"Pro Lift Bed Fittings",url:"#"},
        {name:"Wall Bed Fittings",url:"#"},
        {name:"Sofa Fittings",url:"#"}
      ]
    },

    {
      name:"Furniture Lights - LED",
      url:"#",
      children:[
        {name:"Spot Lights",url:"#"},
        {name:"Linear Lights",url:"#"},
        {name:"Luminor Lights",url:"#"}
      ]
    }

  ]
},
//   {
//     slug:"handles",category:"Handles, Knobs & Profiles",
//     products:[
//       {name:"Mortise Door Handles",url:"#"},
//       {name:"Aluminium Handles",url:"#"},
//       {name:"Zinc Handles",url:"#"},
//       {name:"Shutter Handles",url:"#"},
//       {name:"Zen Handles",url:"#"},
//       {name:"Knobs & Plastic Handles",url:"#"},
//       {name:"Gola Profiles / Handles",url:"#"},
//       {name:"Edge Profiles / Handles",url:"#"},
//       {name:"Profiles HAP & EGSP",url:"#"},
//       {name:"Decorative Profiles",url:"#"}
//     ]
//   },
//   {
//     slug:"kitchen",category:"Cabinet Interiors & Kitchen Storage",
//     products:[
//       {name:"Kitchen Pantry Units",url:"#"},
//       {name:"Pull-out Grain Drawer",url:"#"},
//       {name:"Corner Solutions",url:"#"},
//       {name:"Cupboard Pullouts",url:"#"},
//       {name:"Base & Bottle Pullouts",url:"#"},
//       {name:"Plate Racks & Organisers",url:"#"},
//       {name:"Plastic Wicker & RA Baskets",url:"#"},
//       {name:"Anti-skid Mats",url:"#"},
//       {name:"Tray (Plate, Glass, Drip)",url:"#"},
//       {name:"Roll Tops",url:"#"},
//       {name:"Overhead Systems",url:"#"},
//       {name:"Midway System (MS & SS)",url:"#"},
//       {name:"Turntable Mechanism",url:"#"},
//       {name:"Waste Bins",url:"#"}
//     ]
//   },
//   {
//     slug:"shelving",category:"Shelving Systems",
//     products:[
//       {name:"Cabinet Shelf & Cabinet Supports",url:"#"},
//       {name:"Pole & Cube Shelving System",url:"#"}
//     ]
//   },
//   {
//     slug:"wardrobe",category:"Wardrobe & Storage Solutions",
//     products:[
//       {name:"Wardrobe Lifts",url:"#"},
//       {name:"Wardrobe Pullouts",url:"#"},
//       {name:"Safe Drawer & Wardrobe Drawer Organizer",url:"#"},
//       {name:"Wardrobe Rail Fittings",url:"#"}
//     ]
//   },
//   {
//     slug:"furniture",category:"Furniture Fittings (Bed & Sofa)",
//     products:[
//       {name:"Pro Lifts & Pro Lift Bed Fittings",url:"#"},
//       {name:"Wall Bed Fittings",url:"#"},
//       {name:"Sofa Fittings",url:"#"}
//     ]
//   },
//   {
//     slug:"office",category:"Office Accessories",
//     products:[
//       {name:"Monitor Arms",url:"#"},
//       {name:"Keyboard Trays",url:"#"},
//       {name:"CPU Stands",url:"#"},
//       {name:"Cable Organizer & EB Boxes",url:"#"},
//       {name:"Table Brackets & Folding Drying Rack",url:"#"}
//     ]
//   },
//   {
//     slug:"plinth",category:"Plinth & Base Systems",
//     products:[
//       {name:"Skirtings & Plinth Fittings",url:"#"},
//       {name:"PMDS & Shutter Grills",url:"#"}
//     ]
//   },
//   {
//     slug:"lighting",category:"Furniture Lighting",
//     products:[
//       {name:"Spot Lights",url:"#"},
//       {name:"Linear Lights",url:"#"},
//       {name:"Luminor Lights",url:"#"}
//     ]
//   }
];

const RF_PRODUCTS = MENU_DATA.flatMap(cat =>
  cat.products.map(p => ({name:p.name,category:cat.category,url:p.url}))
);

/* ── Desktop mega menu ── */
function buildMegaMenu(){
  const cEl = document.getElementById('megaCats');
  const pEl = document.getElementById('megaPanels');
  
  let cH='',pH='';
  MENU_DATA.forEach((cat,i)=>{
    cH+=`<li><button class="mega-cat ${i===0?'active':''}" data-cat="${cat.slug}">
      <span>${cat.category}</span>
      <svg viewBox="0 0 8 12"><path d="M1 1l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
    </button></li>`;
   pH += `
<div class="mega-panel ${i===0?'active':''}" data-cat="${cat.slug}">
  
  <div class="mega-3col">

    <!-- COLUMN 1: PRODUCTS -->
    <div class="mega-col mega-col-products">
 
      <ul class="mega-items">
        ${cat.products.map((p,pi)=>`
          <li class="mega-prod ${pi===0?'active':''}" data-prod="${pi}">
            <span>${p.name}</span>
            ${p.children ? '<span class="arrow">›</span>' : ''}
          </li>
        `).join('')}
      </ul>
    </div>

    <!-- COLUMN 2: SUB PRODUCTS -->
    <div class="mega-col mega-col-children">
      ${cat.products.map((p,pi)=>`
        <div class="mega-child-panel ${pi===0?'active':''}" data-prod="${pi}">
        ${p.children ? `
  <ul>
    ${p.children.map(c=>`<li><a href="${c.url}">${c.name}</a></li>`).join('')}
  </ul>
` : ``}
        </div>
      `).join('')}
    </div>

  </div>

</div>
`;
  });
  cEl.innerHTML=cH; pEl.innerHTML=pH;
  // ✅ ADD THIS HERE
pEl.querySelectorAll('.mega-panel').forEach(panel => {

  const items = panel.querySelectorAll('.mega-prod');
  const childPanels = panel.querySelectorAll('.mega-child-panel');

  items.forEach(item => {
    item.addEventListener('mouseenter', () => {

      // remove active
      items.forEach(i => i.classList.remove('active'));
      childPanels.forEach(p => p.classList.remove('active'));

      // add active
      item.classList.add('active');

      const index = item.dataset.prod;
      const target = panel.querySelector(`.mega-child-panel[data-prod="${index}"]`);

      if (target) target.classList.add('active');

    });
  });

});
  cEl.querySelectorAll('.mega-cat').forEach(btn=>{
    btn.addEventListener('mouseenter',()=>{
      document.querySelectorAll('.mega-cat').forEach(b=>b.classList.remove('active'));
      document.querySelectorAll('.mega-panel').forEach(p=>p.classList.remove('active'));
      btn.classList.add('active');
      const p=pEl.querySelector(`[data-cat="${btn.dataset.cat}"]`);
      if(p)p.classList.add('active');
    });
  });
}



// document.querySelectorAll('.mega-prod').forEach(item=>{
//   item.addEventListener('mouseenter',()=>{
    
//     const parent = item.closest('.mega-3col');

//     parent.querySelectorAll('.mega-prod').forEach(i=>i.classList.remove('active'));
//     parent.querySelectorAll('.mega-child-panel').forEach(p=>p.classList.remove('active'));

//     item.classList.add('active');

//     const index = item.dataset.prod;
//     parent.querySelector(`.mega-child-panel[data-prod="${index}"]`).classList.add('active');
//   });
// });
/* ── Search category dropdown ── */
function buildSearchCategories(){
  const sel=document.getElementById('soCategory');
  MENU_DATA.forEach(cat=>{
    const o=document.createElement('option');
    o.value=cat.category;o.textContent=cat.category;sel.appendChild(o);
  });
}

/* ── Mobile drawer products ── */
function buildDrawerProducts(){
  const el=document.getElementById('drawerProductsList');
  el.innerHTML=MENU_DATA.map(cat=>`
    <div class="sub-cat-block">
      <div class="sub-cat-head">
        <span>${cat.category}</span>
        <svg class="sc-arr" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="sub-cat-products">
        ${cat.products.map(p=>`<a class="sub-prod-link" href="${p.url}">${p.name}</a>`).join('')}
      </div>
    </div>`).join('');
  el.querySelectorAll('.sub-cat-head').forEach(h=>{
    h.addEventListener('click',()=>h.parentElement.classList.toggle('open'));
  });
}

/* ── Search ── */
function openSearchOverlay(){
  document.getElementById('searchOverlay').classList.add('open');
  document.getElementById('soBg').classList.add('open');
  showPopular();
  setTimeout(()=>document.getElementById('soInput').focus(),150);
}
function closeSearchOverlay(){
  document.getElementById('searchOverlay').classList.remove('open');
  document.getElementById('soBg').classList.remove('open');
}
function hl(text,q){
  if(!q)return text;
  return text.replace(new RegExp('('+q.replace(/[.*+?^${}()|[\]\\]/g,'\\$&')+')','gi'),'<mark>$1</mark>');
}
function showPopular(){
  const seen={};
  renderResults(RF_PRODUCTS.filter(p=>{
    if(!seen[p.category]){seen[p.category]=true;return true;}return false;
  }),'','Browse by Category');
}
function runSearch(){
  const q=document.getElementById('soInput').value.trim().toLowerCase();
  const cat=document.getElementById('soCategory').value;
  if(!q&&!cat){showPopular();return;}
  const res=RF_PRODUCTS.filter(p=>{
    return(!cat||p.category===cat)&&(!q||p.name.toLowerCase().includes(q)||p.category.toLowerCase().includes(q));
  });
  renderResults(res,q,cat&&!q?cat:res.length?`${res.length} result${res.length>1?'s':''}` : '');
}
function renderResults(items,q,label){
  const el=document.getElementById('soResults');
  if(!items.length){el.innerHTML='<p class="so-no-results">No products found.</p>';return;}
  el.innerHTML=(label?`<p class="so-results-label">${label}</p>`:'')+
    '<ul class="so-list">'+
    items.map(p=>`<li><a href="${p.url}" class="so-item">
      <span class="so-item-name">${hl(p.name,q)}</span>
      <span class="so-item-cat">${p.category}</span>
    </a></li>`).join('')+
    '</ul>';
}

/* ── Drawer ── */
function openDrawer(){
  document.getElementById('mobileDrawer').classList.add('open');
  document.getElementById('mobileOverlay').classList.add('open');
  document.getElementById('menuToggle').classList.add('open');
  document.body.style.overflow='hidden';
}
function closeDrawer(){
  document.getElementById('mobileDrawer').classList.remove('open');
  document.getElementById('mobileOverlay').classList.remove('open');
  document.getElementById('menuToggle').classList.remove('open');
  document.body.style.overflow='';
  showMainScreen();
}
function showMainScreen(){
  document.getElementById('drawerMain').classList.remove('slide-out');
  const dp=document.getElementById('drawerProducts');
  dp.classList.remove('slide-in');dp.classList.add('off-right');
}
function showProductsScreen(){
  document.getElementById('drawerMain').classList.add('slide-out');
  const dp=document.getElementById('drawerProducts');
  dp.classList.remove('off-right');dp.classList.add('slide-in');
}

/* ── Marquee ── */
(function(){
  const t=document.getElementById('marquee');if(!t)return;
  let pos=window.innerWidth;
  (function tick(){pos-=.55;if(pos<-t.offsetWidth)pos=window.innerWidth;
    t.style.transform=`translateX(${pos}px)`;requestAnimationFrame(tick);})();
})();

/* ── Init ── */
buildMegaMenu();
buildSearchCategories();
buildDrawerProducts();
showPopular();

document.getElementById('menuToggle').addEventListener('click',()=>{
  document.getElementById('mobileDrawer').classList.contains('open')?closeDrawer():openDrawer();
});
document.getElementById('drawerClose').addEventListener('click',closeDrawer);
document.getElementById('mobileOverlay').addEventListener('click',closeDrawer);
document.getElementById('openProductsBtn').addEventListener('click',e=>{e.preventDefault();showProductsScreen();});
document.getElementById('backBtn').addEventListener('click',showMainScreen);
document.addEventListener('keydown',e=>{if(e.key==='Escape'){closeSearchOverlay();closeDrawer();}});