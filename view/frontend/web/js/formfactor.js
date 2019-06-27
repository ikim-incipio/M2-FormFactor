require(['jquery','uiRegistry'], function($, registry){

    $(document).ready(function(){

        $('.form-factor-hero-button').on('click', function(e){
            e.preventDefault();

            $('html, body').animate({
                scrollTop: $('#form-factor-products-section').offset().top
            }, 500);
        });

        $('#choose-parent').on('change', function(){
            if ($(this).val()){
                $('#'+$(this).val()).show();
                $('#'+$(this).val()+'>option:eq(1)').prop('selected', true);
                $('#choose-parent').prop('disabled',true);
            }
        });

        $('[name="choose-device"]').on('change', function(){
            if ($(this).val()){
                if ($(this).val() == 'back'){
                    $('#choose-parent').prop('disabled',false);
                    $('#choose-parent>option:eq(0)').prop('selected', true);
                    $(this).hide();
                    return;
                }
                window.location = $(this).val();
            }
            return false;
        });
    });
});
