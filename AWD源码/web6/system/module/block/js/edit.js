$(document).ready(function()
{
    /* Set ajaxform for create and edit. */
    $.setAjaxForm('#blockForm', function(data)
    {   
        if(data.result == 'success')
        {
            $.reloadAjaxModal(1500);
        }
        else if(data.result == 'fail' && data.reason == 'captcha')
        {
            $('.captchaModal').click();
        }   
    });

    $.setAjaxForm('#editForm', function(response)
    {   
        if(response.result == 'fail' && response.reason == 'captcha')
        {
            $('.captchaModal').click();
        }   
    }); 

    $('.reloadModal').click(function(){$.reloadAjaxModal()});

    $('[name*=group]').change(function()
    {
       $('#title').val($(this).find("option:selected").text()); 
    });

    $(document).on('change', '[name*=imageType]', function()
    {
        if($(this).find('option:selected').val() == 'custom')
        {
            $('tr.custom-image').removeClass('hidden');
        }
        else
        {
            $('tr.custom-image').addClass('hidden');
        }
    });

    $('[name*=imageType]').change();
})
