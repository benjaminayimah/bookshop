/*
$(document).ready(function(){
    $(".category-list").hover(function(){
        var toggleme = $(this).attr('data-toggle');
        $('#'+toggleme).animate({
            visibility: 'toggle'
        });
     //   $('.list-inner-btn').css('display', 'none');

    });


});*/
$(document).ready(function () {
    $(document).ready(function(){
        $(".alert").delay(3000).slideUp(300);
    });
});
$(document).ready(function () {
    $('.toggle-holder').hover(function () {
        var toggleContent = $(this).attr('data-toggle');
        if($('#'+toggleContent).hasClass('toggled')){
            $('#'+toggleContent).animate({
                width: '0',
                padding: '0'
            }, 'fast');
            $('#'+toggleContent+ ' span').css('visibility', 'hidden');
            $('#'+toggleContent).removeClass('toggled');
        }else {
            $('#'+toggleContent).animate({
                width: '100%',
                padding: '15px'
            }, 'fast');
            $('#'+toggleContent+ ' span').css('visibility', 'visible');
            $('#'+toggleContent).addClass('toggled');
        }

    })

});

$(document).ready(function () {
    $('.category-edit').click(function () {
        $('#myEditModal').modal();
        var content = $(this).attr('data-content');
        $('#EditModalLabel').html('Edit '+content);
        var id = $(this).attr('data-id');
        $('#cat_input').html('<input type="text" data-id="'+id+'" class="form-control" value="'+content+'" id="categoryUpdate">');
    });
    $('.subcat-edit1').click(function () {
        $('#subcat1myEditModal').modal();
        var content = $(this).attr('data-content');
        var id = $(this).attr('data-id');
        $('#subcat1EditModalLabel').html('Edit '+content);
        $('#subcat1cat_input').html('<input type="text" data-id="'+id+'" class="form-control" value="'+content+'" id="categoryUpdate">');
    });


    $('.category-delete').click(function () {
        var thisurl = window.location.pathname;
        var content = $(this).attr('data-content');
        var id = $(this).attr('data-id');
        if (confirm('Are sure you want to delete '+content+'?') == true) {
            $.ajax({
                method: 'POST',
                dataType: 'json',
                url: delURL,
                data: {
                    catID: id,
                    catTitle: content,
                    _token: token
                },
                success: function (data) {
                    //console.log(data.msg)
                    window.location = thisurl;
                },
                error: function (data) {
                    console.log(data)
                }
            })

        } else {
            return false;
        }
    });
    $('#editCatBtn').click(function () {
        var thisurl = window.location.pathname;
        var content = $(this).attr('data-content');
        var id = $('#categoryUpdate').attr('data-id');
        $('#EditModalLabel').html('Edit '+content);
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: EditUrl,
            data: {
                input: $('#categoryUpdate').val(),
                catID: id,
                _token: token
            },
            success: function (data) {
                window.location = thisurl;
            },
            error: function (data) {
                console.log(data)
            }
        })
    });





    $('#category').blur(function () {
        $('#subcat').html('');
        $('#subcat2').html('');
        var value = $(this).val();
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: fetchOpt,
            data: {
                content: value,
                _token: token
            },
            success: function (data) {
                if(data.msg.length > 0){
                    $.each(data.msg, function (i, data) {
                       $('#subcat').append('<option value="'+data.id+'">'+data.sub_category1+'</option>');
                    });

                }else {
                    $('#subcat').append('<option value="">No sub-category available</option>');
                }

            },
            error: function (data) {
                console.log(data)
            }
        })
    });

    $('#subcat').blur(function () {
        $('#subcat2').html('');
        var categ = $('#category').val();
        var subCat = $(this).val();
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: fetchOpt2,
            data: {
                content: categ,
                content2: subCat,
                _token: token
            },
            success: function (data) {
                console.log(data.msg);
             if(data.msg.length > 0){
                    $.each(data.msg, function (i, data) {
                        $('#subcat2').append('<option value="'+data.id+'">'+data.sub_category2+'</option>');
                    });
                }else {
                 $('#subcat2').append('<option value="">No sub-category available</option>');
             }
            },
            error: function (data) {
                console.log(data)
            }
        });

    });



    $('#catego').blur(function () {
        $('#subCate').html('');
        var value = $(this).val();
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: fetchCate,
            data: {
                content: value,
                _token: token
            },
            success: function (data) {
                console.log(data.msg)
                if(data.msg.length > 0){
                    $.each(data.msg, function (i, data) {
                        $('#subCate').append('<option>'+data.sub_category1+'</option>');
                    });

                }

            },
            error: function (data) {
                console.log(data)
            }
        })
    });

    $('#triggerBtn').click(function (e) {
        e.preventDefault();
        $('#inputImg').click();
    });
    $('#inputImg').change(function (e) {
        e.preventDefault();

        var file_data = $(this).prop('files')[0];
        var image_name = file_data.name;
        var image_ext = image_name.split('.').pop().toLowerCase();
        if(jQuery.inArray(image_ext, ['gif', 'png', 'jpg', 'jpeg']) == -1){
            alert('File type not supported!')
        }else {
            var form_data = new FormData();
            form_data.append("file", file_data);

            $.ajax({
                type: 'POST',
                url: upLimg,
                contentType: false,
                processData: false,
                cache: false,
                data: {
                    fille: form_data,
                    _token: token
                },
                beforeSend:function(){
                    console.log('uploading....');
                },
                success: function (data) {
                    console.log(data)
                },
                error: function (data) {
                    console.log(data)
                }
            })
        }

    });

    $('.bookinp-del').click(function () {
        var thisurl = window.location.pathname;
        var content = $(this).attr('data-content');
        var id = $(this).attr('data-id');
        var imgname = $(this).attr('data-name');
        if (confirm('Are you sure you want to delete '+content+'?') == true) {
            $.ajax({
                method: 'POST',
                dataType: 'json',
                url: delbkURL,
                data: {
                    bookID: id,
                    image: imgname,
                    _token: token
                },
                success: function (data) {
                    window.location = thisurl;
                },
                error: function (data) {
                    console.log(data)
                }
            })

        } else {
            return false;
        }
    });

    $('.bk-preview').click(function () {
        var thisurl = window.location.pathname;
        var $id = $(this).attr('data-id');
        $('#prev_itm_stat').html('');
        $('#prev_itm_img').html('');
        $('#prev_totl_price').html('');
        $('#prev_dis_rate').html('');
        $('#prev_old_price').html('');
        $('#prev_itm_book_author').html('');
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: getPreview,
            data: {
                bkID: $id,
                _token: token
            },
            success: function (data) {
                $('#bk_preview_modal').modal();
                $('#prev_itm_title').html(data.msg.title);
                $('#prev_itm_desc').html(data.msg.description);
                if(data.msg.publisher){
                    $('#prev_itm_publ').html(data.msg.publisher);
                }
                $('#prev_itm_isbn').html(data.msg.isbn);
                if(data.msg.book_author){
                    $('#prev_itm_book_author').html(data.msg.book_author);
                }
                if (data.msg.new_arrivals == true){
                    $('#prev_itm_stat').append('<a href="javascript:void (0)" class="badge badge-success">NEW ARRIVAL</a>')
                }
                if (data.msg.best_seller == true){
                    $('#prev_itm_stat').append('<a href="javascript:void (0)" class="badge badge-warning">BEST SELLER</a>')
                }
                if (data.msg.featured_books == true){
                    $('#prev_itm_stat').append('<a href="javascript:void (0)" class="badge badge-warning">FEATURED BOOK</a>')
                }
                if (data.msg.discount > 0){
                    $('#prev_totl_price').html('GH₵ '+data.discounted);
                    var of = ' off';
                    var per = '%';
                    var gh = 'GH₵ ';
                    $('#prev_dis_rate').html('<span class="badge badge-info">'+data.msg.discount+''+per+''+of+'</span>');
                    $('#prev_old_price').html('<span style="text-decoration: line-through">'+gh+''+data.oldprice+'</span>');
                }else {
                    $('#prev_old_price').html('GH₵ '+data.oldprice);
                }
                $('#prev_itm_categ').html(data.msg.category);
                if (data.msg.sub_catid){
                    $('#prev_sub_categ1').html('<i class="zmdi zmdi-chevron-right"></i><a href="javascript:void (0)">'+data.msg.sub_category1+'</a>');
                }
                if (data.msg.sub_catid2){
                    $('#prev_sub_categ2').html('<i class="zmdi zmdi-chevron-right"></i><a href="javascript:void (0)">'+data.msg.sub_category2+'</a>');
                }
                $('#upload_by').html(data.msg.author);
                $('#upload_date').html(data.msg.created_at);
                $('#last_modified').html(data.msg.author2);
                $('#modified_date').html(data.msg.updated_at);

                $('#prev_itm_img').html('<img class="img-rounded" src="'+getimg+'/'+data.msg.image+'" alt="'+data.msg.title+'">')

            },
            error: function (data) {

            }
        })
    })
});


$(document).ready(function () {
    $('.category-list a').on('mousedown', function () {
        var thisData = $(this).attr('data-content');
        var id = $(this).attr('data-id');
        $('#'+id).html('Loading.......');
        $.ajax({
            method: 'POST',
            datyType: 'json',
            url: loadSubcat,
            data: {
                content: thisData,
                _token: token
            },
            success: function (data) {
                $('#'+id).html('');
                if(data.msg.length > 0){
                    $.each(data.msg, function (i, data) {
                        $('#'+id).append('<li class="sub-2"><a  href="javascript:void(0)" onclick="meloadsub2(\''+data.cat_id+'\',\''+data.id+'\')" class="sub-cat1">'+data.sub_category1+'<a href="javascript:void(0)" onclick="editSubcat1(\''+data.id+'\')" class="sub-cat-action">Edit</a><a href="javascript:void(0)" data-content="'+data.id+'" class="sub-cat-action2" onclick="delSubcat1(\''+data.id+'\')">Delete</a></a><ul id="subsub'+data.id+'"></ul></li>');
                    });
                    $('#'+id).append('<a href="javascript:void(0)"  onclick="addsubcat(\''+thisData+'\')"><i class="zmdi zmdi-plus"></i> Add new sub category</a>')
                }else {
                    $('#'+id).append('<a href="javascript:void(0)"  onclick="addsubcat(\''+thisData+'\')"><i class="zmdi zmdi-plus"></i> Add new sub category</a>')
                }

            },
            error: function (data) {
                console.log(data)
            }
        })

    });

});
function addsubcat(id) {
    $('#mysubModal1').modal();
    $('#sub_catHidden').html('<input name="catHidden" value="'+id+'">');
}
function meloadsub2(catID, subCatID) {

    $.ajax({
        method: 'POST',
        datyType: 'json',
        url: loadSubcate2,
        data: {
            catID: catID,
            subcatID: subCatID,
            _token: token
        },
        success: function (data) {
            $('#subsub'+subCatID).html('');
            if(data.msg.length > 0){
                $.each(data.msg, function (i, data) {
                    $('#subsub'+subCatID).append('<li><a href="javascript:void(0)" class="sub-cat2">'+data.sub_category2+'</a><a href="javascript:void(0)" class="sub-cat-action" onclick="editSubcat2(\''+data.id+'\')">Edit</a><a href="javascript:void(0)" class="sub-cat-action2" onclick="delSubcat2(\''+data.id+'\')"  data-content="'+data.id+'">Delete</a></li>')
                });
                $('#subsub'+subCatID).append('<a href="javascript:void(0)"  onclick="addsubcat2(\''+subCatID+'\',\''+catID+'\')"><i class="zmdi zmdi-plus"></i> Add new sub category</a>')
            }else {
                $('#subsub'+subCatID).append('<a href="javascript:void(0)"  onclick="addsubcat2(\''+subCatID+'\',\''+catID+'\')"><i class="zmdi zmdi-plus"></i> Add new sub category</a>')
            }
        },
        error: function (data) {
            console.log(data)
        }
    })

}
function addsubcat2(id, catID) {
    $('#mysubModal2').modal();
    $('#sub_cat2Hidden').html('<input name="SubcatHidden" value="'+id+'">');
    $('#at2Hidden').html('<input name="catHidden" value="'+catID+'">');

}
function editSubcat1(id) {
    $('#subcat1cat_input').html('');
    $.ajax({
        method: 'POST',
        dataType: 'json',
        url: editSub1Url,
        data: {
            id: id,
            _token: token
        },
        success: function (data) {
            $('#subcat1myEditModal').modal();
            $('#subcat1cat_input').html('<input type="text" class="form-control" name="SubCategory" value="'+data.msg.sub_category1+'">');
            $('#subcat1cat_input_hidden').html('<input type="hidden" name="hidden" value="'+data.msg.id+'">')

        },
        error: function (data) {
            console.log(data)
        }
    })

}

function editSubcat2(id) {
    $.ajax({
        method: 'POST',
        dataType: 'json',
        url: editSub1Url2,
        data: {
            id: id,
            _token: token
        },
        success: function (data) {
            $('#subcat2myEditModal').modal();
            $('#subcat2cat_input').html('<input type="text" class="form-control" name="SubCategory" value="'+data.msg.sub_category2+'">');
            $('#subcat2cat_input_hidden').html('<input type="hidden" name="hidden" value="'+data.msg.id+'">')

        },
        error: function (data) {
            console.log(data)
        }
    })

}
function delSubcat1(id) {
    var thisurl = window.location.pathname;
    if (confirm('Are sure you want to Delete this Sub catagory?') == true) {
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: delsub1URL,
            data: {
                id: id,
                _token: token
            },
            success: function (data) {
                window.location = thisurl;
            },
            error: function (data) {
                console.log(data)
            }
        })

    } else {
        return false;
    }
}
function delSubcat2(id) {
    var thisurl = window.location.pathname;
    if (confirm('Are sure you want to Delete this Sub catagory?') == true) {
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: delsub2URL,
            data: {
                id: id,
                _token: token
            },
            success: function (data) {
                window.location = thisurl;
            },
            error: function (data) {
                console.log(data)
            }
        })

    } else {
        return false;
    }
}
