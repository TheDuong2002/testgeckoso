
function addItem(){
    var popup = jQuery('#modal_user_cate_add');
    popup.modal('show');
}
// popup model add Item


function user_cate_delete(id){
    var popup = jQuery('#model_user_cate_delete');
    popup.find('input[name=item_id]').val(id);
    popup.modal('show');
}
// // popup model delete Item


function handleDeleteItem() {
    var popup = jQuery('#model_user_cate_delete');
    jQuery.ajax({
        url: gks.baseURL + '/admin/user/category/delete',
        type: 'post',
        data: {
            item_id: popup.find('input[name=item_id]').val(),
            _token: gks.tempTK,
        },
        success: function (response) {
            reloadPage();
        },
    });
}
//handel delete item


function add_sub_user_cate(id){
    var popup = jQuery('#model_user_cate_add_sub');
    popup.find('input[name=id_item]').val(id);
    popup.modal('show');
}
//pobup model add sub cate user

function user_cate_add_sub(){
    var popup = jQuery('#model_user_cate_add_sub');
    jQuery.ajax({
        url: gks.baseURL + '/admin/user/category/add/sub',
        type: 'post',
        data: {
            id_item: popup.find('input[name=id_item]').val(),
            title: popup.find('input[name=title]').val(),
            _token: gks.tempTK,
        },
        success: function (response) {
            reloadPage();
        },
    });
}


$('.update-user-cate').click(function (){
    var title = $(this).attr('data-title')
    var id = $(this).attr('data-id')
    var popup = jQuery('#model_user_cate_update');
    popup.modal('show');
    $('#edit_user_cate_title').val(title)
    $('.id_item').val(id)
})
// popup update usser cate

function  user_cate_update(){
    var popup = jQuery('#model_user_cate_update');
    jQuery.ajax({
        url: gks.baseURL + '/admin/user/category/update',
        type: 'post',
        data: {
            id_item: popup.find('input[name=id_item]').val(),
            title: popup.find('input[name=title]').val(),
            _token: gks.tempTK,
        },
        success: function (response) {
            reloadPage();
        },
    });
}
//handel update user cate

function delete_sub_item(id){
    var popup = jQuery('#model_user_cate_sub_delete');
    popup.find('input[name=id_item]').val(id);
    popup.modal('show');
}

function  handle_delete_sub_item(){
    var popup = jQuery('#model_user_cate_sub_delete');
    jQuery.ajax({
        url: gks.baseURL + '/admin/user/category/sub/delete',
        type: 'post',
        data: {
            id_item: popup.find('input[name=id_item]').val(),
            title: popup.find('input[name=title]').val(),
            _token: gks.tempTK,
        },
        success: function (response) {
            reloadPage();
        },
    });
}

$('.update-sub-user-cate').click(function (){
    var id = $(this).attr('data-id')
    var title = $(this).attr('data-title')
    var popup = jQuery('#model_sub_user_cate_update');
    popup.modal('show');
    $('#edit_sub_user_cate_title').val(title);
    $('.id_item').val(id);
})

function sub_user_cate_update(){
 var popup = jQuery('#model_sub_user_cate_update')
    jQuery.ajax({
        url: gks.baseURL + '/admin/user/category/sub/update',
        type: 'post',
        data: {
            id_item: popup.find('input[name=id_item]').val(),
            title: popup.find('input[name=title]').val(),
            _token: gks.tempTK,
        },
        success: function (response) {
            reloadPage();
        },
    });

}


function toggleItem(id, sub) {
    if (!sub) {
        if (jQuery('.sub-' + id + '').hasClass('hidden')) {
            jQuery('.sub-' + id + '').removeClass('hidden');
        } else {
            jQuery('.sub-' + id + '').addClass('hidden');
        }
    } else {
        if (jQuery('.sub-' + id + '.child-' + sub + '').hasClass('hidden')) {
            jQuery('.sub-' + id + '.child-' + sub + '').removeClass('hidden');
        } else {
            jQuery('.sub-' + id + '.child-' + sub + '').addClass('hidden');
        }
    }
}
