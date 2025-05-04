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
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      1000
    );
  });

  // Delete Cart Item JS
  $(document).on("click", ".btn-delete", function (event) {
    event.preventDefault();
    $(this).closest("tr").remove();
    updateTotal();
  });

  // Update Total Price JS
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
});

// shopping cart dynamic behaviour

const cartItems = [];
const cartTable = document.querySelector("#cart-content .cart-table");

document.querySelectorAll(".add-to-cart").forEach(button => {
    button.addEventListener("click", () => {
        const name = button.dataset.name;
        const price = parseFloat(button.dataset.price);
        const img = button.dataset.img;
        const qtyInput = button.previousElementSibling;
        const qty = parseInt(qtyInput.value) || 1;

        const existingItem = cartItems.find(item => item.name === name);
        if (existingItem) {
            existingItem.qty += qty;
            existingItem.total = existingItem.qty * existingItem.price;
        } else {
            cartItems.push({ name, price, img, qty, total: price * qty });
        }

        updateCartDisplay();
    });
});

function updateCartDisplay() {
    cartTable.innerHTML = `
        <tr>
            <th>Food</th>
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    `;

    let grandTotal = 0;
    cartItems.forEach((item, index) => {
        grandTotal += item.total;
        cartTable.innerHTML += `
            <tr>
                <td><img src="${item.img}" width="50"></td>
                <td>${item.name}</td>
                <td>$${item.price.toFixed(2)}</td>
                <td>${item.qty}</td>
                <td>$${item.total.toFixed(2)}</td>
                <td><a href="#" class="btn-delete" onclick="removeItem(${index})">&times;</a></td>
            </tr>
        `;
    });

    cartTable.innerHTML += `
        <tr>
            <th colspan="4">Total</th>
            <th>$${grandTotal.toFixed(2)}</th>
            <th></th>
        </tr>
    `;

    document.querySelector(".badge").textContent = cartItems.reduce((sum, i) => sum + i.qty, 0);
}

function removeItem(index) {
    cartItems.splice(index, 1);
    updateCartDisplay();
}

let cart = [];

function updateCartUI() {
    const cartItemsContainer = document.getElementById('cart-items');
    const cartCount = document.getElementById('cart-count');
    const cartTotal = document.getElementById('cart-total');

    cartItemsContainer.innerHTML = ''; // Clear cart
    let total = 0;

    cart.forEach((item, index) => {
        total += item.price * item.qty;
        const row = `
            <tr>
                <td><img src="${item.img}" alt="Food" width="50"></td>
                <td>${item.name}</td>
                <td>$${item.price.toFixed(2)}</td>
                <td>${item.qty}</td>
                <td>$${(item.price * item.qty).toFixed(2)}</td>
                <td><a href="#" class="btn-delete" onclick="removeItem(${index})">&times;</a></td>
            </tr>
        `;
        cartItemsContainer.innerHTML += row;
    });

    cartCount.textContent = cart.length;
    cartTotal.textContent = `$${total.toFixed(2)}`;
}

function addToCart(name, price, img) {
    const existing = cart.find(item => item.name === name);
    if (existing) {
        existing.qty += 1;
    } else {
        cart.push({ name, price, qty: 1, img });
    }
    updateCartUI();
}

function removeItem(index) {
    cart.splice(index, 1);
    updateCartUI();
}

// OPTIONAL: For testing, you can call these in your HTML buttons like:
// <button onclick="addToCart('Pizza', 8.00, 'img/food/p1.jpg')">Add Pizza</button>

