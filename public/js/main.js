$(document).ready(function () {
    $(document).ready(function(){
        $(".alert-success").delay(4000).slideUp(300);
    });
});
$(document).ready(function() {
    $(".mb-navTggler").click(function() {
        $(".overlay").css("display", "block");
        var menu = $("#mb_menu_holder");
        menu.animate({
            left: 0 + "px"
        });
        $("body").addClass("body-retract");
    });
    $(".overlay").click(function() {
        var menu = $("#mb_menu_holder");
        menu.animate({
            left: -275 + "px"
        });
        $(".overlay").css("display", "none");
        $("body").removeClass("body-retract");
    });
    
});


$(document).ready(function () {
    $('.remvFromCart').on('click', function () {
        var dataID = $(this).attr('data-id');
        var loader = $(this).attr('data-load');
        var dataToggle = $(this).attr('data-toggle');
        var initCount = Number($("#cart_count").html());
        var inittotal = $('#cart_total_val').html();
        var grandttl = Number(inittotal.replace(/,/g,""));
        var input = $('#cartVal_'+dataID).html();
        var initVal = Number(input.replace(/,/g,""));

        if (confirm('Are you sure you want to Delete this cart item?') == true) {
            $('#'+loader).addClass('loader');
         $.ajax({
            method: 'POST',
            datyType: 'json',
            url: ctIdel,
            data: {
                content: dataID,
                _token: token,
            },
            success: function (data) {
                var final = initCount -1;
                $('#'+dataToggle).html('');
                $('#cart_alert').html('<div id="cart_input1" class="alert show alert-success alert-dismissible fade"><button type="button" class="close my-success-close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="zmdi zmdi-close"></span></button>'+data.status+'</div>');
                $(".ttl-count").html(final);
                var thisTotl = grandttl - initVal;
                var thisGrandtl = thisTotl.toFixed(2);
                $('#cart_total_val').html(thisGrandtl.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            },
            error: function (data) {
                $('#cart_alert').html('<div id="cart_input2" class="alert show alert-danger alert-dismissible fade"><button type="button" class="close my-danger-close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="zmdi zmdi-close"></span></button>'+data.statusText+'</div>');
                $('#'+loader).removeClass('loader');
            }
        })

    } else {
        return false;
    }

    });

});

$(document).ready(function () {
    $('.add-to-cart').on( 'click', function () {
        var target = $(this).attr('data-target');
        var initCount = Number($("#cart_count").html());
        var load = $(this).attr('data-load');
        var id = $(this).attr('data-id');
        $('#'+load).addClass('loader');
        $('#cart_modal_content').html('');
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: postSess,
            data: {
                input: $('#'+target).val(),
                _token: token
            },
            success: function (data) {
                $('#modal-notification').modal();
                $('#cart_modal_content').html(data.title+' is added to your cart.');
                $('#'+load).removeClass('loader');
                $('.cart_added_'+id).addClass('block');
                $('.cart_added_'+id).html(data.msg);
                var final = initCount + Number(data.state);
                $("#cart_count").html(final);

            },
            error: function (data) {
                alert(data.statusText);
                $('#'+load).removeClass('loader');
            }
        })

    })

});
$(document).ready(function () {
    $('.add-to-wishlist').on( 'click', function () {
        var target = $(this).attr('data-target');
        var load = $(this).attr('data-load');
        $('#'+load).addClass('loader');
        $('#wish_list_mo_cont').html('');
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: postwish,
            data: {
                input: $('#'+target).val(),
                _token: token
            },
            success: function (data) {
                $('#'+load).removeClass('loader');
                $('#wish_list_modal').modal();
                $('#wish_list_mo_cont').html(data.msg);

            },
            error: function (data) {
                $('#'+load).removeClass('loader');
                $('#error_modal').modal();
                $('#error_modal_content').html('Please login to continue');
            }
        })

    })

});
$(document).ready(function(){
    $(".coupon-toggler").click(function(){
        var $toggle = $(this).attr('data-toggle');
        $('#'+$toggle).animate({
            height: 'toggle',
        });
    });
});
$(document).ready(function () {
    $('.remv-wish').on('click', function () {
        let target = $(this).attr('data-target');
        if (confirm('Are you sure you want to Remove this item?') == true) {
            $('#'+target).submit();
        }else {
            return false;
        }
    })
});
$(document).ready(function () {
    $('.cus-cancel-order').on('click', function () {
        let target = $(this).attr('data-target');
        if (confirm('Are you sure you want to Cancel this order?') == true) {
            $('#'+target).submit();
        }else {
            return false;
        }
    })
});
$(document).ready(function () {
    $('.order-del-btn').on('click', function () {
        let target = $(this).attr('data-target');
        let loader = $(this).attr('data-toggle');
        if (confirm('Are you sure you want to Delete this?') == true) {
            $('#'+loader).addClass('loader');
            $('#'+target).submit();
        }else {
            return false;
        }
    })
});

$(document).ready(function () {
    $('.catdropdown').on('mouseover', function () {
        $(this).addClass('cat-active');
    })
});
$(document).ready(function () {
    $('.catdropdown').on('mouseout', function () {
        $(this).removeClass('cat-active');
    })
});
$(document).ready(function () {
    $('.subcatdropdown').on('mouseover', function () {
        $(this).addClass('subcat-active');
    })
});
$(document).ready(function () {
    $('.subcatdropdown').on('mouseout', function () {
        $(this).removeClass('subcat-active');
    })
});
$(document).ready( function () {
    $('.my-srch-input, .my-srch-input2').on('input', function () {
        let key = $(this).val();
        let label = $(this).attr('data-label');
        let tbody = $(this).attr('data-target');
        $('.srch-loader').addClass('loader');
        $('#'+tbody).html('');
        $.ajax({
            method: 'get',
            dataType: 'json',
            url: postSearch,
            data: {
                search: key,
                _token: token
            },
            success: function (data) {
                $('.srch-loader').removeClass('loader');
                $('#'+label).html('<span>Search results for </span><i>"'+key+'"</i>');
                if (data.books){
                    if (data.books.length > 0){
                        $.each(data.books, function (i, result) {
                            $('#'+tbody).append('<tr><td><a href="'+getId+'/'+result.id+'"><div class="srch-img-hold"><img src="'+getimg+'/'+result.image+'" alt="'+result.title+'"></div><div class="srch-title">'+result.title+'</div></a></td></tr>');
                        });
                    }
                }if (data.categories) {
                    if (data.categories.length > 0){
                        $.each(data.categories, function (i, result) {
                            $('#'+tbody).append('<tr><td><a href="'+getCat+'/'+result.category+'/'+result.id+'"><div><i class="zmdi zmdi-view-dashboard" style="margin-right: 7px"></i>'+result.category+'</div></a></td></tr>');
                        });
                    }
                }if(data.books.length == 0 && data.categories.length == 0){
                    $('#'+tbody).html('<div style="padding: 15px"> Not found</div>')
                }
            },
            error: function (data) {
                $('.srch-loader').removeClass('loader');
            }
        })
    })
});

$(document).ready(function () {
    $('.my-srch-input, .my-srch-input2').on('focus', function (e) {
        $(this).parents('.search-main-form').toggleClass('form-focused', (e.type === 'focus' || this.value.length > 0));
    });
    $('.my-srch-input, .my-srch-input2').on('blur', function (e) {
        $(this).parents('.search-main-form').toggleClass('form-focused', (e.type === 'focus' || this.value.length > 0));
    })
    $('.srch-pane-close').on('click', function () {
        $('.search-main-form').removeClass('form-focused')
    })
});

$(document).ready(function () {
    $('.newsletter-btn').on('click', function () {
        $('#dynamic_i').addClass('loader2');
    })
})
$(document).ready(function () {
   $('.newsletter-sub').on('click', function () {
       let toggle = $(this).attr('data-toggle');
       $('#'+toggle).addClass('loader');
   })
})
$(document).ready(function () {
   $('.newsletter-alert-close').on('click', function () {
       $.ajax({
           method: 'post',
           dataType: 'json',
           url: postnewsLss,
           data: {
               _token: token,
           },
           success: function (data) {
               console.log(data)
           },
           error: function (data) {
               console.log(data)
           }
       })
   })
})

