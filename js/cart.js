$(function () {
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })

    cartUpdate();
    listStoreProducts();

    function listStoreProducts() {
        $.ajax({
            url: "admin?api=v1&action=products",
            success: function (result) {
                $.each(result, function (index, product) {
                    $('.list-products').append(' <div class="col">\n' +
                        '    <div class="card h-100">\n' +
                        '      <div style="text-align: center;"><img src="' + product.image + '" class="img-fluid" height="150" alt="' + product.name + '"></div>\n' +
                        '      <div class="card-body">\n' +
                        '        <h5 class="card-title">' + product.name + '</h5>\n' +
                        '        <small>654654654</small>\n' +
                        '        <p class="card-text">' + product.description + '.</p>\n' +
                        '        <div style="text-align: center;"><a href="#" class="card-link btn btn-primary text-white btn-add-to-cart" data-id="' + product.id + '"><i class="bi bi-cart-plus"></i> Adicionar ao carrinho</a></div>\n' +
                        '      </div>\n' +
                        '      <div style="text-align: center;" class="card-footer">\n' +
                        '        <small class="text-muted">Quantidade em estoque: ' + Math.round(product.stock_quantity).toFixed(2) + '</small>\n' +
                        '      </div>\n' +
                        '    </div>\n' +
                        '  </div>');
                })
                $('.btn-add-to-cart').on('click', function () {
                    let productId = $(this).data().id;
                    addToCart(productId);
                });
            }
        });
    }

    function addToCart(productId) {
        $.ajax({
            url: "admin?api=v1&action=cart&add-id=" + productId,
            success: function (result) {
                cartUpdate();
            },
            error: function (err) {
                // console.log(err);
            }
        });
    }

    function removeFromCart(productId) {
        $.ajax({
            url: "admin?api=v1&action=cart&remove-id=" + productId,
            success: function (result) {
                cartUpdate();
            },
            error: function (err) {
                // console.log(err);
            }
        });
    }

    function cartUpdate() {
        $.ajax({
            url: "admin?api=v1&action=cart",
            success: function (result) {
                let lojinhaCartElement = $('.lojinha-cart');
                lojinhaCartElement.attr('data-bs-content', result.html);
                $('.lojinha-cart-total').text(result.total);
                $('.btn-remove-from-cart').off('click');
                lojinhaCartElement.off('show.bs.popover');
                lojinhaCartElement.popover("hide");
                lojinhaCartElement.on('show.bs.popover', function () {
                    setTimeout(function () {

                        $('.btn-remove-from-cart').on('click', function () {
                            let productId = $(this).attr('id');
                            removeFromCart(productId);
                        });
                    }, 500)

                })
            },
            error: function (err) {
                // console.log(err);
            },
        });
    }
});