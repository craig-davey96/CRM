$(document).ready(function () {

    var table = $('.dataTab').DataTable({
        "bProcessing" : true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        keys: true
    });

    table.on( 'draw', function () {
        $('.dataTables_filter input').removeClass('form-control-sm');
    } );


    /*
        MENU DROPDOWN TOGGLE
     */

    $('body').on('click' , 'ul.menu_ul li a.dropdown' , function(e){

        e.preventDefault();

        var ele = $(this);
        var this_dropdown = ele.next();

        var all_dropdowns = ele.siblings();
        var all_dropdown_toggles = ele.siblings().next();

        all_dropdown_toggles.removeClass('active');
        all_dropdowns.stop().slideUp();

        if(ele.hasClass('active')){
            ele.removeClass('active');
            this_dropdown.stop().slideUp();
        }else{
            ele.addClass('active');
            this_dropdown.stop().slideDown();
        }

    });

    /*
       LOADER
     */

    setTimeout(function () {
        $('body .loader').fadeOut();
    } , 1000);

});

$(function () {

    $('[data-toggle="tooltip"]').tooltip();

    $('.dataTable').on( 'draw', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

});


if($('#needs-validation').length > 0) {
    (function () {
        'use strict';

        window.addEventListener('load', function () {
            var form = document.getElementById('needs-validation');
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }, false);
    })();
}

$(function() {

    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('lastTab', $(this).attr('href'));
    });

    // go to the latest tab, if it exists:
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
        $('[href="' + lastTab + '"]').tab('show');
    }

});