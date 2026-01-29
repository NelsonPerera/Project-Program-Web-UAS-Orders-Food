<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <base href="<?= base_url() ?>">
    <link rel="stylesheet" href="assets/searchPage/search.css?v=<?= time() ?>">
    <link rel="stylesheet" href="assets/homepage/index.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="assets/componentt/navbar1.css?v=<?= time() ?>">
    <link rel="stylesheet" href="assets/loginpage/login1.css?v=<?= time() ?>">
</head>

<body>

  <header class="text-gray-600 body-font" id="nav-body">
    <div class=" mx-auto flex flex-wrap pt-5 flex-col md:flex-row items-center px-5">
      <a class="flex title-font font-medium items-center text-gray-900 mb-1 md:mb-0" href="<?= base_url() ?>">
        <img src="<?= base_url('assets/logo.png') ?>" alt="" id="logo">

        <span class="ml-3 text-xl" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
          aria-controls="offcanvasWithBothOptions">
          <div id="nav-location">
            <span id="other">
              <span class="other">Other</span>
            </span>
            <span id="town">
              Jakarta, Indonesia
            </span>
            <span>
              <i id="nav-down" class="fa-solid fa-chevron-down"></i>
            </span>
          </div>
        </span>
      </a>
      <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
        <a class="mr-5 " href="<?= base_url() ?>">
          <span id="search-text" style="margin-left: 7px;">Home</span>
        </a>

        <a class="mr-5 " href="<?= base_url('search') ?>">
          <i class="fa-solid fa-magnifying-glass"></i>
          <span id="search-text" style="margin-left: 7px;">Search</span>
        </a>
        <div class="UserName dropdown" style="display: none;">
          <a class="mr-5 dropbtn">
            <i class="fa-solid fa-user-plus"></i>
            <span id="Profile" style="margin-left: 7px;">UserName</span>
          </a>
          <div class="dropdown-content">
            <a href="<?= base_url('profile') ?>">Profile</a>
            <a href="#">Order</a>
            <a href="#">Favourites</a>
            <a href="#" id="logout">Logout</a>
          </div>
        </div>

        <div>
          <a class="mr-5 signin-nav" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight">
            <i class="fa-solid fa-user-plus"></i>
            <span id="signin-text" style="margin-left: 7px;">Sign in</span>
          </a>
        </div>
        <a class="mr-5 " href="<?= base_url('cart') ?>">
          <i class="fa-solid fa-cart-shopping"></i>
          <span id="cart-text" style="margin-left: 7px;">Cart</span>
        </a>
      </nav>
    </div>
  </header>

  <div class="container1">
    <div class="newFlex">
      <div class="input-group rounded classFlex">
        <input type="text" onkeyup="searchBtn()" class="form-control rounded" id="searchText"
          placeholder="Search for restaurants" aria-label="Search" aria-describedby="search-addon" />
        <span class="input-group-text border-0" id="search-addon">
          <i class="fas fa-search" id="showSearch"></i>
          <i class="fas fa-close" id="showClose" style="display: none;"></i>
        </span>
      </div>
    </div>
    <div id="main">
        <div id="popular">
            <h3>Popular Restaurants</h3>
            <div id="displayRestaurants" class="row">
                <!-- Popular restaurants will load here -->
            </div>
        </div>
        <div id="restobar">
            <div><span id="rcount">0</span> Restaurants found</div>
        </div>
        <div id="showRestaurants">
            <!-- Search results will appear here -->
        </div>
    </div>
  </div>

  <footer>
    <div id="footer">
      <div id="f2">
        <div>
          <ul>
            <li class="lihead">WE DELIVER TO</li>
            <li>Jakarta</li>
            <li>Surabaya</li>
            <li>Bandung</li>
          </ul>
        </div>
      </div>
      <div id="f3">
        <div><img src="https://res.cloudinary.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_284/Logo_f5xzza" alt=""></div>
        <div>
          <p>© 2025 All Right Reserved</p>
        </div>
      </div>
    </div>
  </footer>

  <script>
    window.BASE_URL = '<?= base_url() ?>';
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/977289aa03.js" crossorigin="anonymous"></script>
  <script src="<?= base_url('assets/loginpage/login1.js') ?>"></script>
  <script src="<?= base_url('assets/searchPage/search.js') ?>"></script>
</body>
</html>
