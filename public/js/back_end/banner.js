function add_dm_banner() {
    var popup = jQuery('#modal_banner_add');
    popup.modal('show');
}
function add_attr_banner(){
    var popup = jQuery('#modal_banner_add_attr');
    popup.modal('show');
}


function view_attr_banner(chi_id){
    event.preventDefault();
    $.ajax({
        url: gks.baseURL + '/admin/banners/attribute/update/' + chi_id,
        type: 'get',
        dataType: "json",
            success: function(record) {

             $('#body_banner_attr').html(`
              <div class="form-group"  >
                         <input type="hidden" value="${record.id}" name="parent_id">
                         <input type="hidden" value="${record.parent_id}" name="parent_id">
                        </div>
                        <div class="form-group" id="req-title">
                            <label class="text-label required">*Banner desktop</label>
                            <input required type="file" name="img_banner_mt" autocomplete="off" class="form-control"/>
                            <img  src= "${gks.baseURL + "/public/uploaded/banner/" +record.img_banner_mt}" width="100" alt="">
                        </div>
                        <div class="form-group" id="req-title">
                            <label class="text-label required">*Banner mobile</label>
                            <input required type="file" name="img_banner_dt" autocomplete="off" class="form-control"/>
                            <img  src= "${gks.baseURL + "/public/uploaded/banner/" +record.img_banner_dt}" width="100" alt="">
                        </div>
                        <div class="form-group" id="req-title">
                            <label class="text-label required">*Link</label>
                            <input required type="text" value="${record.link}" name="link" autocomplete="off" class="form-control"/>
                        </div>
<!-- trong quá trình thường được thực hiện bợi cáci nha   -->
             `)
            //    Thì mai chị Hằng muốn hẹn em để review lại quá trình thực tập của em neg
            $("#modal_banner_up_attr").modal("show");
        }
    });

}
