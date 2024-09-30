require([
    'jquery'
], function ($) {
    $(document).ready(function () {
        $('.contenedor').on('click', function () {
            $(this).toggleClass('activa');
        });
    });
});
