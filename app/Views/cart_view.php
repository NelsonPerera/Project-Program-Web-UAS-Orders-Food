<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart</title>
  <base href="<?= base_url() ?>">
  <link rel="stylesheet" href="assets/cartpage/cart.css?v=<?= time() ?>">
  <link rel="stylesheet" href="assets/componentt/navbar1.css?v=<?= time() ?>">
  <link rel="stylesheet" href="assets/loginpage/login1.css?v=<?= time() ?>">
  <link rel="stylesheet" href="assets/homepage/index.css?v=<?= time() ?>">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script>
    window.BASE_URL = '<?= base_url() ?>';
  </script>
</head>
<body class="bg-gray-50">
  <header class="text-gray-600 body-font bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto flex flex-wrap p-4 flex-col md:flex-row items-center">
      <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" href="<?= base_url() ?>">
        <img src="assets/logo.png" alt="logo" id="logo" style="width: 50px;">
        <span class="ml-3 text-xl">Jakarta, Indonesia</span>
      </a>
      <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
        <a class="mr-5 hover:text-orange-500" href="<?= base_url() ?>">Home</a>
        <a class="mr-5 hover:text-orange-500" href="<?= base_url('search') ?>">Search</a>
      </nav>
    </div>
  </header>

  <div class="container mx-auto mt-10 px-4 min-h-screen">
    <div class="flex flex-col lg:flex-row gap-8">
      <!-- Left side: Auth and Address -->
      <div class="lg:w-2/3 space-y-6">
        <!-- Auth Section -->
        <div class="bg-white p-6 rounded-lg shadow-sm border">
          <div class="flex items-center gap-4 mb-4">
            <div class="bg-gray-800 text-white w-8 h-8 flex items-center justify-center rounded-full font-bold">1</div>
            <h2 class="text-xl font-bold text-gray-800">Account</h2>
          </div>
          <div id="auth-section">
            <p class="text-gray-600">Logged in as <span id="cart-UserName" class="font-bold">...</span> | <span id="number">...</span></p>
          </div>
        </div>

        <!-- Address Section -->
        <div class="bg-white p-6 rounded-lg shadow-sm border">
          <div class="flex items-center gap-4 mb-4">
            <div class="bg-gray-800 text-white w-8 h-8 flex items-center justify-center rounded-full font-bold">2</div>
            <h2 class="text-xl font-bold text-gray-800">Delivery Address</h2>
          </div>
          
          <div id="address-enter" class="space-y-4">
            <form id="address-submit" class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <input type="text" id="flat-no" placeholder="Flat No" class="border p-2 rounded">
              <input type="text" id="door-no" placeholder="Door/House No" class="border p-2 rounded">
              <input type="text" id="address" placeholder="Street Address" class="border p-2 rounded col-span-2">
              <select id="type" class="border p-2 rounded">
                <option value="home">Home</option>
                <option value="work">Work</option>
                <option value="other">Other</option>
              </select>
              <button type="submit" class="bg-orange-600 text-white py-2 rounded font-bold hover:bg-orange-700 col-span-2">SAVE ADDRESS</button>
            </form>
          </div>

          <div id="final-address" class="hidden space-y-2">
             <div class="p-4 border border-green-200 bg-green-50 rounded">
                <p><strong><span id="typ"></span></strong></p>
                <p><span id="f-n"></span>, <span id="d-n"></span></p>
                <p id="ad"></p>
                <button onclick="document.getElementById('address-enter').classList.remove('hidden'); document.getElementById('final-address').classList.add('hidden')" class="text-orange-600 text-sm mt-2 font-bold uppercase">Change</button>
             </div>
          </div>
        </div>

        <!-- Payment Section -->
        <div class="bg-white p-6 rounded-lg shadow-sm border">
          <div class="flex items-center gap-4 mb-4">
            <div class="bg-gray-800 text-white w-8 h-8 flex items-center justify-center rounded-full font-bold">3</div>
            <h2 class="text-xl font-bold text-gray-800">Payment</h2>
          </div>
          <div id="payment-section" class="hidden space-y-4">
            <select id="payment-method" class="border p-2 rounded w-full">
                <option value="cod">Cash on Delivery</option>
                <option value="card">Credit Card</option>
            </select>
            <div id="card-details" class="hidden space-y-2">
                <input type="text" placeholder="Card Number" class="border p-2 rounded w-full">
            </div>
            <button id="place-order" class="w-full bg-green-600 text-white py-3 rounded-lg font-bold text-lg hover:bg-green-700">PLACE ORDER</button>
          </div>
          <div id="payment-placeholder" class="text-gray-400 italic">Complete address to proceed with payment</div>
        </div>
      </div>

      <!-- Right side: Cart Items -->
      <div class="lg:w-1/3">
        <div class="bg-white p-6 rounded-lg shadow-sm border sticky top-24">
          <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-4">Order Summary</h2>
          <div id="cart-items-list" class="space-y-4 max-h-[400px] overflow-y-auto mb-6">
            <!-- Items rendered by JS -->
          </div>
          <div class="border-t pt-4 space-y-2">
             <div class="flex justify-between text-gray-600">
                <span>Item Total</span>
                <span>Rp <span id="item-total">0</span></span>
             </div>
             <div class="flex justify-between text-gray-600">
                <span>Delivery Fee</span>
                <span>Rp 15.000</span>
             </div>
             <div class="flex justify-between font-bold text-xl text-gray-800 pt-2 border-t mt-2">
                <span>TO PAY</span>
                <span>Rp <span id="final-total">0</span></span>
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/loginpage/login1.js"></script>
  <script src="assets/cartpage/cart.js?v=<?= time() ?>"></script>
</body>
</html>
