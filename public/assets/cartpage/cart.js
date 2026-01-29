
document.addEventListener('DOMContentLoaded', () => {
    let cartItems = JSON.parse(localStorage.getItem("CartItems")) || [];
    let userData = JSON.parse(localStorage.getItem("loginUser"));

    // Auth display
    const userNameDisplay = document.getElementById("cart-UserName");
    const userPhoneDisplay = document.getElementById("number");

    if (userData) {
        userNameDisplay.textContent = userData.name || userData.username || 'User';
        userPhoneDisplay.textContent = userData.mobile || userData.phone || '081...';
    } else {
        userNameDisplay.textContent = "Please Sign In";
        userPhoneDisplay.textContent = "to proceed with order";
    }

    renderCartItems();

    // Address handling
    const addressForm = document.getElementById("address-submit");
    const addressEnter = document.getElementById("address-enter");
    const finalAddress = document.getElementById("final-address");
    const paymentSection = document.getElementById("payment-section");
    const paymentPlaceholder = document.getElementById("payment-placeholder");

    if (addressForm) {
        addressForm.onsubmit = (e) => {
            e.preventDefault();
            const flat = document.getElementById("flat-no").value;
            const door = document.getElementById("door-no").value;
            const address = document.getElementById("address").value;
            const type = document.getElementById("type").value;

            if (address.trim() === "") {
                alert("Please enter a delivery address");
                return;
            }

            document.getElementById("f-n").innerText = flat;
            document.getElementById("d-n").innerText = door;
            document.getElementById("ad").innerText = address.toUpperCase();
            document.getElementById("typ").innerText = type.toUpperCase();

            addressEnter.classList.add("hidden");
            finalAddress.classList.remove("hidden");
            paymentSection.classList.remove("hidden");
            paymentPlaceholder.classList.add("hidden");
        };
    }

    // Payment handling
    const paymentMethod = document.getElementById("payment-method");
    const cardDetails = document.getElementById("card-details");

    if (paymentMethod) {
        paymentMethod.onchange = () => {
            if (paymentMethod.value === "card") {
                cardDetails.classList.remove("hidden");
            } else {
                cardDetails.classList.add("hidden");
            }
        };
    }

    const placeOrderBtn = document.getElementById("place-order");
    if (placeOrderBtn) {
        placeOrderBtn.onclick = async () => {
            if (!userData) {
                alert("Please sign in to place an order");
                return;
            }
            if (cartItems.length === 0) {
                alert("Your cart is empty");
                return;
            }

            // Get address
            const address = document.getElementById("ad").innerText;
            if (!address) {
                alert("Please submit your delivery address first");
                return;
            }

            // Calculate total
            const itemTotal = cartItems.reduce((sum, item) => sum + (item.price * item.qty), 0);
            const deliveryFee = 15000;
            const totalAmount = itemTotal + deliveryFee;

            const orderData = {
                user_id: userData.id,
                items: cartItems.map(item => ({
                    id: item.id,
                    name: item.name,
                    price: item.price,
                    qty: item.qty,
                    restaurant_id: item.restaurant_id || 1 // Fallback if missing
                })),
                total_amount: totalAmount,
                address: address,
                payment_method: document.getElementById("payment-method").value,
                customer_name: userData.name,
                customer_phone: userData.mobile
            };

            try {
                placeOrderBtn.innerText = "Processing...";
                placeOrderBtn.disabled = true;

                const response = await fetch(window.BASE_URL + 'api/orders', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(orderData)
                });

                const result = await response.json();

                if (response.ok) {
                    // Clear cart on success
                    localStorage.removeItem("CartItems");
                    window.location.href = window.BASE_URL + 'order-success';
                } else {
                    alert("Order failed: " + (result.message || response.statusText));
                    placeOrderBtn.innerText = "PLACE ORDER";
                    placeOrderBtn.disabled = false;
                }
            } catch (error) {
                console.error("Order error:", error);
                alert("An error occurred while placing the order.");
                placeOrderBtn.innerText = "PLACE ORDER";
                placeOrderBtn.disabled = false;
            }
        };
    }
});

function renderCartItems() {
    let cartItems = JSON.parse(localStorage.getItem("CartItems")) || [];
    const container = document.getElementById("cart-items-list");
    const itemTotalDisplay = document.getElementById("item-total");
    const finalTotalDisplay = document.getElementById("final-total");

    if (!container) return;
    container.innerHTML = "";

    if (cartItems.length === 0) {
        container.innerHTML = '<div class="text-center py-8 text-gray-500">Your cart is empty. <br><a href="' + window.BASE_URL + '" class="text-orange-600 font-bold">Go back to restaurants</a></div>';
        itemTotalDisplay.textContent = "0";
        finalTotalDisplay.textContent = "0";
        return;
    }

    let itemTotal = 0;
    const deliveryFee = 15000;

    cartItems.forEach((item, index) => {
        const itemSubtotal = item.price * item.qty;
        itemTotal += itemSubtotal;

        const div = document.createElement("div");
        div.className = "flex justify-between items-start gap-4 p-2 border-b last:border-0";
        div.innerHTML = `
            <div class="flex-grow">
                <div class="flex items-center gap-2">
                    <img src="${item.is_veg ? 'https://www.pngkey.com/png/detail/261-2619381_chitr-veg-symbol-svg-veg-and-non-veg.png' : 'https://www.pikpng.com/pngl/m/210-2108039_non-veg-logo-png-non-veg-symbol-clipart.png'}" class="w-3 h-3">
                    <span class="font-semibold text-gray-700">${item.name}</span>
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <div class="flex items-center border rounded">
                        <button onclick="updateQty(${index}, -1)" class="px-2 py-0.5 text-orange-600 font-bold">-</button>
                        <span class="px-2 text-sm">${item.qty}</span>
                        <button onclick="updateQty(${index}, 1)" class="px-2 py-0.5 text-orange-600 font-bold">+</button>
                    </div>
                    <span class="text-xs text-gray-400">x Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</span>
                </div>
            </div>
            <div class="text-right">
                <div class="font-semibold text-gray-700">Rp ${new Intl.NumberFormat('id-ID').format(itemSubtotal)}</div>
                <button onclick="updateQty(${index}, -${item.qty})" class="text-[10px] text-red-500 uppercase mt-1">Remove</button>
            </div>
        `;
        container.appendChild(div);
    });

    itemTotalDisplay.textContent = new Intl.NumberFormat('id-ID').format(itemTotal);
    finalTotalDisplay.textContent = new Intl.NumberFormat('id-ID').format(itemTotal + deliveryFee);
}

window.updateQty = (index, delta) => {
    let cartItems = JSON.parse(localStorage.getItem("CartItems")) || [];
    cartItems[index].qty += delta;

    if (cartItems[index].qty <= 0) {
        cartItems.splice(index, 1);
    }

    localStorage.setItem("CartItems", JSON.stringify(cartItems));
    renderCartItems();
};
