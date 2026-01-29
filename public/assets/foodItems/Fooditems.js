
// Get restaurant ID from global window variable set by PHP
const restaurantId = window.RESTAURANT_ID;
let FoodList = [];

// Fetch menu from API
async function fetchMenu() {
  if (!restaurantId) {
    console.error('No restaurant ID found');
    return;
  }
  try {
    const response = await fetch(`${window.BASE_URL}api/restaurants/${restaurantId}/menu`);
    FoodList = await response.json();
    renderMenu(FoodList);
    initCartState();
  } catch (error) {
    console.error('Error fetching menu:', error);
  }
}

function renderMenu(items) {
  const container = document.getElementById('mainItemContainer');
  if (!container) return;

  container.innerHTML = '';

  items.forEach((item, index) => {
    const card = document.createElement('div');
    card.className = 'ItemContainer border p-4 rounded-lg flex justify-between bg-white shadow-sm hover:shadow-md transition-shadow';

    // Check if item is veg/non-veg
    const typeIcon = item.is_veg
      ? 'https://www.pngkey.com/png/detail/261-2619381_chitr-veg-symbol-svg-veg-and-non-veg.png'
      : 'https://www.pikpng.com/pngl/m/210-2108039_non-veg-logo-png-non-veg-symbol-clipart.png';

    card.innerHTML = `
            <div class="item-detailDiv flex-grow pr-4">
                <img src="${typeIcon}" alt="tag" class="vegIcon w-4 h-4 mb-2">
                <h2 class="text-xl font-bold text-gray-800 cursor-pointer hover:text-orange-600" onclick="showMoreInfo(${index})">${item.name}</h2>
                <h3 class="text-gray-700 font-semibold mb-2">Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</h3>
                <p class="text-gray-500 text-sm line-clamp-2 cursor-pointer" onclick="showMoreInfo(${index})" title="Click for more info">${item.description}</p>
            </div>
            <div class="flex flex-col items-center relative min-w-[120px]">
                <img src="${item.image}" alt="${item.name}" class="itemImg w-24 h-24 object-cover rounded-lg mb-2">
                
                <div class="item-actions w-full">
                    <button class="xyz-btn bg-white text-green-600 border border-gray-300 px-4 py-1 rounded shadow-sm font-bold w-full hover:bg-gray-50" 
                            data-index="${index}" id="add-btn-${index}">ADD</button>
                    
                    <div class="count-controller hidden flex items-center justify-between bg-white border border-gray-300 rounded shadow-sm w-full" id="ctrl-${index}">
                        <button class="neg-btn px-3 py-1 text-green-600 font-bold" data-index="${index}">-</button>
                        <span class="count-digit font-bold" id="digit-${index}">0</span>
                        <button class="pos-btn px-3 py-1 text-green-600 font-bold" data-index="${index}">+</button>
                    </div>
                </div>
            </div>
        `;

    container.appendChild(card);
  });

  // Add event listeners
  document.querySelectorAll('.xyz-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const index = e.target.dataset.index;
      addToCart(index);
    });
  });

  document.querySelectorAll('.neg-btn').forEach(btn => {
    btn.addEventListener('click', (e) => decrement(e.target.dataset.index));
  });

  document.querySelectorAll('.pos-btn').forEach(btn => {
    btn.addEventListener('click', (e) => increment(e.target.dataset.index));
  });
}

// Cart Logic
function getCart() {
  return JSON.parse(localStorage.getItem('CartItems')) || [];
}

function saveCart(cart) {
  localStorage.setItem('CartItems', JSON.stringify(cart));
  updateCartUI();
}

function initCartState() {
  const cart = getCart();
  FoodList.forEach((item, index) => {
    const cartItem = cart.find(c => c.id === item.id);
    if (cartItem) {
      updateItemUI(index, cartItem.qty);
    }
  });
  updateCartUI();
}

function addToCart(index) {
  const item = FoodList[index];
  const cart = getCart();
  const existing = cart.find(c => c.id === item.id);

  if (existing) {
    existing.qty++;
  } else {
    cart.push({ ...item, qty: 1 });
  }

  updateItemUI(index, existing ? existing.qty : 1);
  saveCart(cart);
}

function increment(index) {
  addToCart(index);
}

function decrement(index) {
  const item = FoodList[index];
  const cart = getCart();
  const cartIndex = cart.findIndex(c => c.id === item.id);

  if (cartIndex > -1) {
    cart[cartIndex].qty--;
    const newQty = cart[cartIndex].qty;

    if (newQty <= 0) {
      cart.splice(cartIndex, 1);
    }

    updateItemUI(index, newQty);
    saveCart(cart);
  }
}

function updateItemUI(index, qty) {
  const addBtn = document.getElementById(`add-btn-${index}`);
  const ctrl = document.getElementById(`ctrl-${index}`);
  const digit = document.getElementById(`digit-${index}`);

  if (!addBtn || !ctrl || !digit) return;

  if (qty > 0) {
    addBtn.classList.add('hidden');
    ctrl.classList.remove('hidden');
    digit.textContent = qty;
  } else {
    addBtn.classList.remove('hidden');
    ctrl.classList.add('hidden');
    digit.textContent = 0;
  }
}

function updateCartUI() {
  const cart = getCart();
  const popup = document.getElementById('cartPopup');
  const noOfItems = document.getElementById('noOfItems');
  const total = document.getElementById('Total');

  if (!popup || !noOfItems || !total) return;

  const totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
  const totalPrice = cart.reduce((sum, item) => sum + (item.qty * item.price), 0);

  if (totalQty > 0) {
    popup.classList.remove('hidden');
    noOfItems.textContent = `${totalQty} Items`;
    total.textContent = new Intl.NumberFormat('id-ID').format(totalPrice);
  } else {
    popup.classList.add('hidden');
  }
}

window.showMoreInfo = (index) => {
  const item = FoodList[index];
  if (!item) return;

  alert(`${item.name}\n\n${item.description}\n\nCategory: ${item.category}\nPrice: Rp ${new Intl.NumberFormat('id-ID').format(item.price)}`);
};

document.addEventListener('DOMContentLoaded', fetchMenu);
