$(document).ready(function(){
   $('.avatar-box img').click(function () {
       $('.avatar-modal').css('display', 'block');
   });
    $('.photo_on_page_block').on('click', function(event){
        var id = $(this).find('.id-photo').text();
        var photo = $(this).find('.photo_on_page').attr("src");
        var avatar = $(document).find('.avatar').attr("src");
        var login = $(document).find('.head_page_item_login').text();

        console.log(id);
        $('#modal-photo-container').find('.id-photo-modal').val(id);
        $('#modal-photo-container').find('.modal-photo-container-photo').attr("src", photo);
        $('#modal-photo-container').find('.modal-content_photo-comments_and_edit-name_user-photo').attr("src", avatar);
        $('#modal-photo-container').find('.modal-content_photo-comments_and_edit-name_user-login').text(login);

        $('#modal-photo-container').modal('show');
    });

})

