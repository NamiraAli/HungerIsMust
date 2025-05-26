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
    fetchCart(); // Fetch cart contents when toggling
  });

  // Add to Cart AJAX
  document.querySelectorAll(".add-to-cart").forEach(button => {
    console.log('Button found:', button); 
    button.addEventListener("click", () => {
      const name = button.dataset.name;
      const price = parseFloat(button.dataset.price);
      const img = button.dataset.img;
      const qtyInput = button.previousElementSibling;
      const qty = parseInt(qtyInput.value) || 1;
      const itemId = button.dataset.id;

      console.log("Adding to cart:", name, price, img, qty, itemId);//debug

      $.ajax({
        url: 'cart.php',
        type: 'POST',
        data: {
          action: 'add',
          item_id: itemId,
          item_name: name,
          item_price: price,
          item_img: img,
          item_qty: qty
        },
        dataType: 'json',
        success: function (response) {
          if (response.cart) {
            updateCartUI(response.cart);
          }
        },
        error: function () {
          alert('Could not add item to cart.');
        }
      });
    });
  });

  // Delete Cart Item JS
  $(document).on("click", ".btn-delete", function (event) {
    event.preventDefault();
    const itemId = $(this).data('id');

    $.ajax({
      url: 'cart.php',
      type: 'POST',
      data: { action: 'remove', item_id: itemId },
      dataType: 'json',
      success: function (response) {
        if (response.cart) {
          updateCartUI(response.cart);
        }
      },
      error: function () {
        alert('Could not remove item from cart.');
      }
    });
  });

  // Back-To-Top Button JS
  $("#back-to-top").click(function (event) {
    event.preventDefault();
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      1000
    );
  });

  // Fetch Cart on Page Load
  function fetchCart() {
    $.ajax({
      url: 'cart.php',
      type: 'POST',
      data: { action: 'fetch' },
      dataType: 'json',
      success: function (response) {
        if (response.cart) {
          updateCartUI(response.cart);
        }
      },
      error: function () {
        alert('Could not fetch cart.');
      }
    });
  }

  // Update Cart UI
  function updateCartUI(cart) {
    const cartItemsContainer = $("#cart-items");
    const cartCount = $("#cart-count");
    const cartTotal = $("#cart-total");

    cartItemsContainer.empty();
    let total = 0;
    let count = 0;

    $.each(cart, function(id, item) {
      total += item.price * item.qty;
      count += item.qty;

      cartItemsContainer.append(`
        <tr>
          <td><img src="${item.img}" alt="Food" width="50" /></td>
          <td>${item.name}</td>
          <td>$${parseFloat(item.price).toFixed(2)}</td>
          <td>${item.qty}</td>
          <td>$${(item.price * item.qty).toFixed(2)}</td>
          <td><a href="#" class="btn-delete" data-id="${id}">&times;</a></td>
        </tr>
      `);
    });

    cartCount.text(count);
    cartTotal.text(`$${total.toFixed(2)}`);
  }

  // Initialize cart display on load
  fetchCart();
});
