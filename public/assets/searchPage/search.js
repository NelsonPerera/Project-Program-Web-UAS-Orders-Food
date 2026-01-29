async function searchBtn() {
    const searchText = document.getElementById('searchText').value.toLowerCase();
    const showRestaurants = document.getElementById('showRestaurants');
    const popularDiv = document.getElementById('popular');

    if (searchText.length < 2) {
        showRestaurants.innerHTML = '';
        popularDiv.style.display = 'block';
        return;
    }

    popularDiv.style.display = 'none';

    try {
        const response = await fetch(window.BASE_URL + 'api/restaurants');
        const restaurants = await response.json();

        const filtered = restaurants.filter(r =>
            r.name.toLowerCase().includes(searchText) ||
            r.cuisines.toLowerCase().includes(searchText)
        );

        renderResults(filtered);
    } catch (error) {
        console.error('Search error:', error);
    }
}

function renderResults(list) {
    const showRestaurants = document.getElementById('showRestaurants');
    const rcount = document.getElementById('rcount');

    rcount.textContent = list.length;

    if (list.length === 0) {
        showRestaurants.innerHTML = '<div style="text-align:center; width:100%; margin-top:50px;"><h3>No restaurants found</h3></div>';
        return;
    }

    showRestaurants.innerHTML = list.map(resto => `
        <div class="resto-card" onclick="window.location.href='${window.BASE_URL}menu/${resto.id}'">
            <img src="${resto.image}" class="resto-image" alt="${resto.name}">
            <div class="resto-info">
                <div class="resto-name">${resto.name}</div>
                <div class="resto-cuisines">${resto.cuisines}</div>
                <div class="resto-details">
                    <span class="resto-rating">
                        <i class="fa-solid fa-star"></i>
                        ${resto.rating}
                    </span>
                    <span class="resto-time">${resto.delivery_time} MINS</span>
                </div>
            </div>
        </div>
    `).join('');
}

// Initial load of popular restaurants
document.addEventListener('DOMContentLoaded', async () => {
    try {
        const response = await fetch(window.BASE_URL + 'api/restaurants');
        const restaurants = await response.json();
        const displayRestaurants = document.getElementById('displayRestaurants');

        if (displayRestaurants) {
            displayRestaurants.innerHTML = restaurants.slice(0, 6).map(resto => `
                <div class="col-md-4 mb-4">
                    <div class="card h-100 restaurant-card" onclick="window.location.href='${window.BASE_URL}menu/${resto.id}'">
                        <img src="${resto.image}" class="card-img-top" alt="${resto.name}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">${resto.name}</h5>
                            <p class="card-text text-muted">${resto.cuisines}</p>
                        </div>
                    </div>
                </div>
            `).join('');
        }
    } catch (error) {
        console.error('Load popular restaurants error:', error);
    }
});
