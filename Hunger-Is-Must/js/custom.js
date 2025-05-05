$(function () {
  // Main Menu JS
  $(window).scroll(function () {
    if ($(this).scrollTop() < 50) {
      $("nav").removeClass("site-top-nav");
      $("#back-to-top").fadeOut();
    } else {
      $("nav").addClass("site-top-nav");
      $("#back-to-top").fadeIn();
    }
  });

  // Shopping Cart Toggle JS
  $("#shopping-cart").on("click", function () {
    $("#cart-content").toggle("blind", "", 500);
  });

  // Back-To-Top Button JS
  $("#back-to-top").click(function (event) {
    event.preventDefault();
    $("html, body").animate({
      scrollTop: 0,
    }, 1000);
  });

  // Delete Cart Item JS
  $(document).on("click", ".btn-delete", function (event) {
    event.preventDefault();
    const itemIndex = $(this).data("index");

    // Send delete request to PHP
    $.ajax({
      url: 'remove_item.php',  // PHP script to handle removing items
      type: 'POST',
      data: { index: itemIndex },
      success: function (response) {
        updateCartDisplay();
      }
    });
  });

  // Initialize the cart
  let cartItems = [];

  // Update Total Price
  function updateTotal() {
    let total = 0;
    $("#cart-content tr").each(function () {
      const rowTotal = parseFloat($(this).find("td:nth-child(5)").text().replace("$", ""));
      if (!isNaN(rowTotal)) {
        total += rowTotal;
      }
    });
    $("#cart-content th:nth-child(5)").text("$" + total.toFixed(2));
    $(".tbl-full th:nth-child(6)").text("$" + total.toFixed(2));
  }

  // Update cart display dynamically
  function updateCartDisplay() {
    const cartTable = $("#cart-content .cart-table");
    const cartCount = $("#cart-count");
    const cartTotal = $("#cart-total");
    let total = 0;

    cartTable.empty(); // Clear existing table

    // Fetch cart items from session via AJAX
    $.ajax({
      url: 'get_cart_items.php', // PHP script to get cart items from session
      type: 'GET',
      success: function (response) {
        cartItems = JSON.parse(response);  // Parse the cart items from the response
        cartItems.forEach((item, index) => {
          total += item.price * item.qty;
          cartTable.append(`
            <tr>
              <td><img src="${item.img}" alt="Food" width="50"></td>
              <td>${item.name}</td>
              <td>$${item.price.toFixed(2)}</td>
              <td>${item.qty}</td>
              <td>$${(item.price * item.qty).toFixed(2)}</td>
              <td><a href="#" class="btn-delete" data-index="${index}">&times;</a></td>
            </tr>
          `);
        });

        cartCount.text(cartItems.length);
        cartTotal.text("$" + total.toFixed(2));
      }
    });
  }

  // Add item to cart
  $(".add-to-cart").on("click", function () {
    const name = $(this).data("name");
    const price = parseFloat($(this).data("price"));
    const img = $(this).data("img");
    const qtyInput = $(this).prev();
    const qty = parseInt(qtyInput.val()) || 1;

    // Send cart item to PHP to add to session
    $.ajax({
      url: 'add_to_cart.php',  // PHP script to add items to the session
      type: 'POST',
      data: {
        cartItem: JSON.stringify({ name, price, img, qty })
      },
      success: function (response) {
        updateCartDisplay(); // Update cart display after adding item
      }
    });
  });

  // Initialize cart display on page load
  updateCartDisplay();
});


