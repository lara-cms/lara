<script>
    $( document).ready(function () {
            $('[data-x-model]').click(function () {

                var modelElement = $('#x-model');
                if (modelElement.length > 0) {
                    // Да, такой элемент существует.
                } else {
                    $("body").append('<div id="x-model" class="uk-modal">' +
                            '<div class="uk-modal-dialog">' +
                            '<a class="uk-modal-close uk-close"></a>' +
                            '<div class="x-inner"></div>' +
                            '</div>' +
                            '</div>');
                }
                var modal = UIkit.modal('#x-model');
                modal.show();
                var url = $(this).attr('data-x-model');
                $.ajax({
                    url: url,
                    success: function (data) {
                        $('#x-model .x-inner').html(data);
                    }
                });
                modal.on({
                    'hide.uk.modal': function () {
                        $('#x-model .x-inner').html('');
                    }
                });
            });
        });

</script>