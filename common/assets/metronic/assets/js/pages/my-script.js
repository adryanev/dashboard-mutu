/**
 * Override the default yii confirm dialog. This function is
 * called by yii when a confirmation is requested.
 *
 * @param message the message to display
 * @param okCallback triggered when confirmation is true
 * @param cancelCallback callback triggered when cancelled
 */

yii.confirm = function (message, okCallback, cancelCallback) {
    swal({
        title: message,
        type: 'warning',
        showCancelButton: true,
        allowOutsideClick: false,
    }).then((selection) => {

        if (selection.value) {
            okCallback.call();
        } else {
            cancelCallback.call();
        }
    });
};


$(function () {

    //get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
//we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
    $(document).on('click', '.showModalButton', function () {
        //check if the modal is open. if it's open just reload content not whole modal
        //also this allows you to nest buttons inside of modals to reload the content it is in
        //the if else are intentionally separated instead of put into a function to get the
        //button since it is using a class not an #id so there are many of them and we need
        //to ensure we get the right button and content.
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                .load($(this).attr('value'), function () {
                    $('#spinner-modal').css('display', 'none');
                });
            //dynamiclly set the header for the modal
            document.getElementById('modalHeaderTitle').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            //if modal isn't open; open it and load content
            $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'), function () {
                    $('#spinner-modal').css('display', 'none');
                });
            //dynamiclly set the header for the modal
            document.getElementById('modalHeaderTitle').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    });
});
// var form = document.getElementById('form-adryan')
// form.addEventListener('beforeSubmit', function(evt){
//     //console.log('before submit');
//
//     var submit = evt.find(':submit');
//     KTApp.block('.modal-content',{
//         overlayColor: '#000000',
//         type: 'v2',
//         state: 'primary',
//         message: 'Sedang Memproses...'
//     });
//     submit.html('<i class="flaticon2-refresh"></i> Sedang Memproses');
//     submit.prop('disabled', true);
//
//     KTApp.blockPage({
//         overlayColor: '#000000',
//         type: 'v2',
//         state: 'primary',
//         message: 'Sedang memproses...'
//     });
// });
$('form').on('beforeSubmit', function () {
    var form = $(this);
    //console.log('before submit');

    var submit = form.find(':submit');
    KTApp.block('.modal', {
        overlayColor: '#000000',
        type: 'v2',
        state: 'primary',
        message: 'Sedang Memproses...'
    });
    submit.html('<i class="flaticon2-refresh"></i> Sedang Memproses');
    submit.prop('disabled', true);

    // KTApp.blockPage({
    //     overlayColor: '#000000',
    //     type: 'v2',
    //     state: 'primary',
    //     message: 'Sedang memproses...'
    // });

});

function normalizeButton(id, normal = {icon: '', text: ''}) {
    var button = $('#' + id);
    console.log(id);
    console.log(normal.icon);
    button.prop('disabled', false);
    button.html(`<i class="${normal.icon}"></i> ${normal.text}`);

}

