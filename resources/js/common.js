$(function () {

    $('.js-imagePicker--fileInput').on('change', function (input) {
        var $parent = $(input.target).parents('.js-imagePicker');

        if (input.target.files && input.target.files[0]) {
            $('.js-imagePicker--previewWrapper', $parent).show();

            var reader = new FileReader();
            reader.onload = function (e) {
                $('.js-imagePicker--preview', $parent).attr('src', e.target.result);
            };

            reader.readAsDataURL(input.target.files[0]);
        }
    });

});
