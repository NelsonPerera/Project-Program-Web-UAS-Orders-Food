// Render restaurants
function renderRestaurants(data) {
    const restosContainer = document.getElementById('restos');
    const rcount = document.getElementById('rcount');

    if (!restosContainer) return;

    rcount.textContent = data.length;
    restosContainer.innerHTML = ''; // Clear existing content

    data.forEach(resto => {
        const card = document.createElement('div');
        card.innerHTML = `
            <div class="resto-card" data-id="${resto.id}" style="cursor: pointer;">
                <img src="${resto.image}" alt="${resto.name}" class="resto-image">
                <div class="resto-info">
                    <div class="resto-name">${resto.name}</div>
                    <div class="resto-cuisines">${resto.cuisines}</div>
                    <div class="resto-details">
                        <span class="resto-rating">
                            <i class="fa-solid fa-star"></i>
                            ${resto.rating}
                        </span>
                        <span class="resto-time">${resto.time}</span>
                        <span class="resto-price">${resto.price}</span>
                    </div>
                    <div class="resto-offer">
                        <i class="fa-solid fa-tag"></i>
                        ${resto.offer}
                    </div>
                </div>
            </div>
        `;

        card.querySelector('.resto-card').addEventListener('click', () => {
            localStorage.setItem("selected-resto", JSON.stringify({
                id: resto.id,
                name: resto.name,
                type: resto.cuisines,
                time: resto.time.replace(' MINS', '')
            }));
            window.location.href = window.BASE_URL + '/search';
        });

        restosContainer.appendChild(card);
    });
}

// Fetch restaurants from API
async function fetchRestaurants() {
    try {
        const response = await fetch(window.BASE_URL + 'api/restaurants');
        if (!response.ok) throw new Error('Network response was not ok');
        const data = await response.json();
        console.log('Fetched restaurants:', data);
        if (data.length === 0) {
            document.getElementById('restos').innerHTML = '<p style="text-align:center; padding: 20px;">No restaurants found (API returned empty list).</p>';
            document.getElementById('rcount').textContent = '0';
        } else {
            renderRestaurants(data);
        }
    } catch (error) {
        console.error('Error fetching restaurants:', error);
        document.getElementById('restos').innerHTML = `<p style="text-align:center; padding: 20px; color: red;">Error loading restaurants: ${error.message}</p>`;
    }
}

// Carousel functionality
function initCarousel() {
    const container = document.querySelector('.carousel-container');
    const leftBtn = document.querySelector('.carousel-button-left');
    const rightBtn = document.querySelector('.carousel-button-right');

    if (!container || !leftBtn || !rightBtn) return;

    let scrollAmount = 0;
    const scrollStep = 300;

    rightBtn.addEventListener('click', () => {
        scrollAmount += scrollStep;
        container.style.transform = `translateX(-${scrollAmount}px)`;
    });

    leftBtn.addEventListener('click', () => {
        scrollAmount = Math.max(0, scrollAmount - scrollStep);
        container.style.transform = `translateX(-${scrollAmount}px)`;
    });
}

// Filter panel
function initFilterPanel() {
    const openBtn = document.getElementById('open-panel');
    const closeBtn = document.getElementById('close-panel');
    const panel = document.getElementById('ccpanel');

    if (!openBtn || !closeBtn || !panel) return;

    openBtn.addEventListener('click', () => {
        panel.classList.add('active');
    });

    closeBtn.addEventListener('click', () => {
        panel.classList.remove('active');
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    fetchRestaurants();
    initCarousel();
    initFilterPanel();
});
