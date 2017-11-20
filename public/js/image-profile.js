var $avatarInput, $avatarImage, $avatarForm, $textToEdit;
var avatarUrl;
$(function () {
    $avatarInput = $('#avatarInput');
    $avatarImage = $('#avatarImage');
    $avatarForm = $('#avatarForm');
    $textToEdit = $('#textToEdit')

    $avatarImage.on('click', function () {
       $avatarInput.click();
    });
    $textToEdit.on('click', function () {
        $avatarInput.click();
    });

    avatarUrl = $avatarForm.attr('action');

    $avatarInput.on('change', function () {
        //AJAX
        var formData = new FormData();
        formData.append('image', $avatarInput[0].files[0]);

        $.ajax({
            url: avatarUrl+'?'+$avatarForm.serialize(),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
        .done(function (data) {
            if (data.success)
                $avatarImage.attr('src', '/images/users/'+data.file_name+'?'+ new Date().getTime());
        })
            .fail(function () {
                alert('La imagen subida no tiene el formato correcto')
            });
    })
});