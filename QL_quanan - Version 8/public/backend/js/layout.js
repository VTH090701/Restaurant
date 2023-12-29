function myFunction() {
    if (!confirm("Bạn chắc chắn muốn xóa"))
        event.preventDefault();
}

function addTocart(event) {
    event.preventDefault();
    let urlCart = $(this).data('url');
    $.ajax({
        type: "GET",
        url: urlCart,
        dataType: 'json',
        success: function(data) {
            if (data.code == 200) {
                $('#table-responsive').html(data.cart_components);
            }
        },
        error: function() {}
    });
}




function addTocartagain(event) {
    event.preventDefault();
    let urlCart = $(this).data('url');
    $.ajax({
        type: "GET",
        url: urlCart,
        dataType: 'json',
        success: function(data) {
            if (data.code == 200) {
                $('#table-responsive1').html(data.cart_components1);
            }
        },
        error: function() {

        }

    });
}

function cartDelete(event) {
    event.preventDefault();
    let urlDelete = $('.cart').data('url');
    let id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: urlDelete,
        data: {
            id: id
        },
        success: function(data) {
            if (data.code == 200) {
                $('#table-responsive').html(data.cart_components);

            }
        },
        error: function() {

        }
    });
}

//Test
function addTocartPlus(event) {
    event.preventDefault();
    let urlCart = $(this).data('url');
    $.ajax({
        type: "GET",
        url: urlCart,
        dataType: 'json',
        success: function(data) {
            if (data.code == 200) {
                $('#table-responsive').html(data.cart_components);
            }
        },
        error: function() {

        }

    });
}

function addTocartagainPlus(event) {
    event.preventDefault();
    let urlCart = $(this).data('url');
    $.ajax({
        type: "GET",
        url: urlCart,
        dataType: 'json',
        success: function(data) {
            if (data.code == 200) {
                $('#table-responsive1').html(data.cart_components1);
            }
        },
        error: function() {

        }

    });
}

function addTocartagainMinus(event) {
    event.preventDefault();
    let urlCart = $(this).data('url');
    $.ajax({
        type: "GET",
        url: urlCart,
        dataType: 'json',
        success: function(data) {
            if (data.code == 200) {
                $('#table-responsive1').html(data.cart_components1);
            }
        },
        error: function() {

        }

    });
}


function addTocartMinus(event) {
    event.preventDefault();
    let urlCart = $(this).data('url');
    $.ajax({
        type: "GET",
        url: urlCart,
        dataType: 'json',
        success: function(data) {
            if (data.code == 200) {
                $('#table-responsive').html(data.cart_components);
            }
        },
        error: function() {

        }

    });
}


function cartDeleteagain(event) {
    event.preventDefault();
    let urlDelete = $('.cart_again').data('url-again');
    let id = $(this).data('id-again');
    $.ajax({
        type: "GET",
        url: urlDelete,
        data: {
            id: id
        },
        success: function(data) {
            if (data.code == 200) {
                $('#table-responsive1').html(data.cart_components1);

            }
        },
        error: function() {

        }
    });
}

function loadCate(event) {
    event.preventDefault();
    let urlCate = $(this).data('url1');
    $.ajax({
        type: "GET",
        url: urlCate,
        dataType: 'json',
        success: function(data) {
            if (data.code == 200) {
                // $('.product-list').attr(null);
                $('.product-list').html(data.product_components);
            }
        },
        error: function() {}

    });
}

function loadCate1(event) {
    event.preventDefault();
    let urlCate = $(this).data('url1');
    $.ajax({
        type: "GET",
        url: urlCate,
        dataType: 'json',
        success: function(data) {
            if (data.code == 200) {
                // $('.product-list').attr(null);
                $('.product-list').html(data.product_components1);
            }
        },
        error: function() {}

    });
}

$(function() {
    $('.add_to_cart').on('click', addTocart);
    $('.add_to_cart_again').on('click', addTocartagain);

    $('.load_cate_pro').on('click', loadCate);
    $('.load_cate_pro1').on('click', loadCate1);


    $(document).on('click', '.add_to_cart_plus', addTocartPlus);
    $(document).on('click', '.add_to_cart_minus', addTocartMinus);

    $(document).on('click', '.add_to_cart_again_plus', addTocartagainPlus);
    $(document).on('click', '.add_to_cart_again_minus', addTocartagainMinus);



    $(document).on('click', '.cart_delete', cartDelete);
    $(document).on('click', '.cart_delete_again', cartDeleteagain);

});

$('.add_more').on('click', function() {
    var ncc = $('.ncc_id').html();
    var nl = $('.nl_id').html();

    var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
    var tr = '<tr><td class"no"">' + numberofrow + '</td>' +
        '<td><select class="form-control nl_id" name="nl_id[]" id="nl_id" > ' + nl + '</select></td>' +
        '<td><select class="form-control ncc_id" name="ncc_id[]" id="ncc_id" > ' + ncc + '</select></td>' +
        '<td><input type="text" name="unit[]" id="unit" class="form-control unit"></td>' +
        '<td> <input type="number" name="quantity[]" id="quantity" class="form-control quantity"></td>' +
        '<td><input type="numer" name="price[]" id="price" class="form-control price"></td>' +
        '<td><input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount"></td>' +
        '<td> <a href="#" class="btn btn-sm btn-danger delete"><i class="fa fa-times" aria-hidden="true"></i></a></td>';

    $('.addMoreProduct').append(tr);

});
//Delete
$('.addMoreProduct').delegate('.delete', 'click', function() {
    $(this).parent().parent().remove();
});

$('.addMoreProduct').delegate('.nl_id', 'change', function() {
    var tr = $(this).parent().parent();
    var nl_dvt = tr.find('.nl_id option:selected').attr('data-nl_dvt');
    tr.find('.unit').val(nl_dvt);

    var qty = tr.find('.quantity').val() - 0;
    var price = tr.find('.price').val() - 0;
    var total_amount = (qty * price);
    tr.find('.total_amount').val(total_amount);
});

function TotalAmount() {
    var total = 0;
    $('.total_amount').each(function(i, e) {
        var amount = $(this).val() - 0;
        total += amount;
    });

    const VND = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });
    var total1 = VND.format(total);
    //alert(total1);
    $('#total').html(total1);
}
$('.addMoreProduct').delegate('.quantity', 'keyup', function() {
    var tr = $(this).parent().parent();
    var qty = tr.find('.quantity').val() - 0;
    var price = tr.find('.price').val() - 0;
    var total_amount = (qty * price);
    tr.find('.total_amount').val(total_amount);
    TotalAmount();
});

$('.check_ingredient').delegate('.sltt', 'keyup', function() {
    var tr = $(this).parent().parent();
    var qty = tr.find('.slcl').val() - 0;
    var price = tr.find('.sltt').val() - 0;
    var total_amount = (qty - price);
    var total1 = total_amount.toFixed(2);
    tr.find('.slchl').val(total1);

});


$('.add_more1').on('click', function() {
    var nl = $('.nl_id').html();
    var numberofrow = ($('.addMoreProduct1 tr').length - 0) + 1;
    var tr = '<tr><td class"no"">' + numberofrow + '</td>' +
        '<td><select class="form-control nl_id" name="nl_id[]" id="nl_id" > ' + nl + '</select></td>' +
        '<td><input type="text" name="unit[]" id="unit" class="form-control unit"></td>' +
        '<td> <input type="text" name="quantity[]" id="quantity" class="form-control quantity"></td>' +
        '<td> <a href="#" class="btn btn-sm btn-danger delete"><i class="fa fa-times" aria-hidden="true"></i></a></td>';

    $('.addMoreProduct1').append(tr);

});
//Delete
$('.addMoreProduct1').delegate('.delete', 'click', function() {
    $(this).parent().parent().remove();
});

$('.addMoreProduct1').delegate('.nl_id', 'change', function() {
    var tr = $(this).parent().parent();
    var nl_dvt = tr.find('.nl_id option:selected').attr('data-nl_dvt');
    tr.find('.unit').val(nl_dvt);
    var qty = tr.find('.quantity').val() - 0;


});
