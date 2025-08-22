$(document).ready(function () {
    displayProducts();
    addToCart();
});

function displayProducts() {
    $.ajax({
        url: "../../phpscripts/fetch-items.php",
        method: "GET",
        dataType: "json",
        success: function (response) {
            var cardsContainer = $(".products-container .cards-container");
            if (response.status === "success") {
                response.products.forEach(function (product) {
                    var currentPrice = parseFloat(product.product_price);
                    var originalPrice = currentPrice / 0.8;

                    var cardHtml = `
                        <div class="card" style="height: 520px; width: 400px; padding: 2rem;" data-product-id="${
                            product.product_id
                        }">
                            <div class="card-img">
                                <img src="../../assets/media/products/${
                                    product.product_image
                                }" class="card-img-top" alt="img">
                            </div>
                            <div class="card-description text-center mt-3">
                                <h5>${product.product_name}</h5>
                                <div class="d-flex gap-2 align-items-center justify-content-center">
                                    <h6 class="text-600 text-danger text-decoration-line-through">₱${originalPrice.toFixed(
                                        2
                                    )}</h6>
                                    <h6>₱${currentPrice.toFixed(2)}</h6>
                                </div>
                                <button type="button" class="btn btn-warning btn-add-cart py-0 mt-4 w-50" data-bs-toggle="modal" data-bs-target="#quantityModal">Add to cart</button>
                            </div>
                        </div>
                    `;
                    cardsContainer.append(cardHtml);
                });
            } else {
                console.log("Error: " + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.log("AJAX Error:", status, error);
        },
    });
}

function addToCart() {
    $(document).on("click", ".btn-add-cart", function () {
        var productCard = $(this).closest(".card");
        var productId = productCard.data("product-id");
        $("#quantityModal").data("product-id", productId);
    });

    $(document).on("click", "#confirmAddToCart", function () {
        var productId = $("#quantityModal").data("product-id");
        var quantity = $("#quantityInput").val();

        $.ajax({
            method: "POST",
            url: "../../phpscripts/user-add-to-cart.php",
            data: { productId: productId, quantity: quantity },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    $("#liveToast .toast-body p")
                        .text(response.message)
                        .addClass("text-success")
                        .removeClass("text-danger");
                    $("#liveToast").toast("show");
                    $("#quantityModal").modal("hide");
                    displayUserCart();
                } else {
                    $("#liveToast .toast-body p")
                        .text(response.message)
                        .addClass("text-danger")
                        .removeClass("text-success");
                    $("#liveToast").toast("show");
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            },
        });
    });
}

function toTitleCase(str) {
    return str
        .toLowerCase()
        .split(" ")
        .map(function (word) {
            return word.charAt(0).toUpperCase() + word.slice(1);
        })
        .join(" ");
}
