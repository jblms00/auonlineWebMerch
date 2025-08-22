$(document).ready(function () {
    $.ajax({
        url: "../../phpscripts/cards-fetch-items.php",
        method: "GET",
        dataType: "json",
        success: function (response) {
            var cardsContainer = $(".flash-sale-container .cards-container");
            if (response.status === "success") {
                response.products.forEach(function (product) {
                    var currentPrice = parseFloat(product.product_price);
                    var originalPrice = currentPrice / 0.8;

                    var cardHtml = `
                        <div class="card justify-content-between" style="height: 520px; width: 400px; padding: 2rem;" data-aos="zoom-out-up">
                            <div class="card-img">
                                <img src="../../assets/media/products/${
                                    product.product_image
                                }" class="card-img-top" alt="${
                        product.product_name
                    }">
                            </div>
                            <div class="card-description text-center mt-3">
                                <h5>${product.product_name}</h5>
                                <div class="d-flex gap-2 align-items-center justify-content-center">
                                    <h6 class="text-600 text-danger text-decoration-line-through">₱${originalPrice.toFixed(
                                        2
                                    )}</h6>
                                    <h6>₱${currentPrice.toFixed(2)}</h6>
                                </div>
                            </div>
                        </div>
                    `;
                    cardsContainer.append(cardHtml);
                });
            } else {
                console.log("Error: " + response.message);
            }
        },
        error: function () {
            console.log("Error loading products.");
        },
    });
});
