<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $restaurant['name'] ?> - Menu</title>
  <base href="<?= base_url() ?>">
  <link rel="stylesheet" href="assets/foodItems/Fooditems.css?v=<?= time() ?>">
  <link rel="stylesheet" href="assets/componentt/navbar1.css?v=<?= time() ?>">
  <link rel="stylesheet" href="assets/loginpage/login1.css?v=<?= time() ?>">
  <link rel="stylesheet" href="assets/homepage/index.css?v=<?= time() ?>">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script>
    window.BASE_URL = '<?= base_url() ?>';
    window.RESTAURANT_ID = '<?= $restaurant['id'] ?>';
  </script>
</head>
<body>
  <header class="text-gray-600 body-font bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto flex flex-wrap p-4 flex-col md:flex-row items-center">
      <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" href="<?= base_url() ?>">
        <img src="assets/logo.png" alt="logo" id="logo" style="width: 50px;">
        <span class="ml-3 text-xl">Jakarta, Indonesia</span>
      </a>
      <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
        <a class="mr-5 hover:text-orange-500" href="<?= base_url() ?>">Home</a>
        <a class="mr-5 hover:text-orange-500" href="<?= base_url('search') ?>">Search</a>
        <a class="mr-5 hover:text-orange-500" href="<?= base_url('cart') ?>">Cart</a>
      </nav>
    </div>
  </header>

  <div class="container mx-auto mt-10 px-4">
    <div id="ratingDiv" class="flex justify-between items-center border-b pb-6">
      <div id="detailsDiv">
        <h1 class="text-3xl font-bold text-gray-800"><?= $restaurant['name'] ?></h1>
        <p class="text-gray-600"><?= $restaurant['cuisines'] ?></p>
        <p class="text-gray-500"><?= $restaurant['delivery_time'] ?> MINS away</p>
      </div>
      <div class="bg-green-600 text-white p-3 rounded-lg text-center">
        <div class="font-bold text-xl">★ <?= $restaurant['rating'] ?></div>
        <div class="text-xs uppercase border-t mt-1 pt-1">1K+ Ratings</div>
      </div>
    </div>

    <div class="my-8 flex gap-4 overflow-x-auto pb-4">
        <!-- Offers placeholders -->
        <div class="min-w-[200px] border p-4 rounded-lg bg-orange-50">
            <div class="text-orange-600 font-bold italic">50% OFF UPTO 50K</div>
            <div class="text-xs text-gray-500">USE ID50 | ABOVE 100K</div>
        </div>
        <div class="min-w-[200px] border p-4 rounded-lg bg-blue-50">
            <div class="text-blue-600 font-bold italic">FREE DRINK</div>
            <div class="text-xs text-gray-500">ABOVE 150K</div>
        </div>
    </div>

    <div id="mainItemContainer" class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
        <!-- Menu items will be rendered here by JS -->
    </div>
  </div>

  <div id="cartPopup" class="fixed bottom-0 left-0 right-0 bg-green-600 text-white p-4 hidden flex justify-between items-center cursor-pointer" onclick="window.location.href='cart'">
    <div class="flex items-center gap-4">
        <span id="noOfItems">0 Items</span>
        <span class="border-l pl-4 font-bold">Rp <span id="Total">0</span></span>
    </div>
    <div class="font-bold">VIEW CART <i class="fas fa-shopping-bag"></i></div>
  </div>

  <script src="assets/loginpage/login1.js"></script>
  <script src="assets/foodItems/Fooditems.js?v=<?= time() ?>"></script>
</body>
</html>
