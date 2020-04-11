$(function () {
    'use strict';
      
    function hideOrShow(){
    var value = $('#itemselector').val();
    //var value = this.value;
    if (value == "1") {
        $("#item").show('slow');
    } else {
        $("#item").hide('slow'); 
    }
    }
    
    $("#itemselector").change(hideOrShow);
    
    hideOrShow();
   
    $('.toggle-info').click(function () {
        $(this).parent().next('.card-body').toggleClass('hide');
        if($(this).parent().next('.card-body').hasClass('hide')){
            $(this).html('<i class="fas fa-minus"></i>');
        }else{
            $(this).html('<i class="fas fa-plus"></i>');
        }
    });
    var pas1 = document.getElementById("psw"),
        pas2 = document.getElementById("psw2"),
        mes  = document.getElementById("message");
    if(pas1 !== pas2){
        mes.innerHTML = "not match password dplecate";
    }
    $("select").selectBoxIt({
        autoWidth: false
    });
    $('[placeholder]').focus(function () {
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('data-text'));
    });
    $('.confirm').click(function (){
        return confirm('هل تريد بالفعل حذف الشكوي');
    });
    $('.cat h3').click(function(){
        $(this).next('.full-viwe').fadeToggle(200);
    });
    $('.option span').click(function(){
        $(this).addClass('active').siblings('span').removeClass('active');
        if($(this).data ('viwe') == 'full'){
            $('.cat .full-viwe').fadeIn();
        }else{
            $('.cat .full-viwe').fadeOut();
        }
    });
    new NiceCountryInput($("#testinput")).init();
    
    $('#complain_info').printThis();
        $.ajax({ //create an ajax request to load_page.php
            type: "POST",
            url: "php/complain.php",             
            success: function(response) {
                var data = $.parseJSON(response);
                console.log(data);
            }
        });
        $('#dt-material-checkbox').dataTable({

            columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
            }],
            select: {
            style: 'os',
            selector: 'td:first-child'
            }
            });
});



