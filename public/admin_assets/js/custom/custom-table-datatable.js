/*
---------------------------------------
    : Custom - Table Datatable js :
---------------------------------------
*/
"use strict";
$(document).ready(function() {
    /* -- Table - Datatable -- */

    $('#datatabledb').DataTable({
        responsive: true,
        searching: false, 
        paging: false,
        "pageLength": 10,
        "bInfo" : false
    });
     $('#datatabledb1').DataTable({
        responsive: true,
        searching: false, 
        paging: false,
        "pageLength": 5,
        "bInfo" : false
    });
      $('#datatabledb2').DataTable({
        responsive: true,
        searching: false, 
        paging: false,
        "pageLength": 5,
        "bInfo" : false
    });

    $('#datatable').DataTable({
        responsive: true
    });
    $('#default-datatable').DataTable( {
        "order": [[ 1, "desc" ]],
        responsive: true
        //  search: {
        // "regex": true
        // }
    } ); 
    $('#default-datatable2').DataTable( {
        "order": [[ 1, "desc" ]],
        responsive: true
    } );
    $('#default-datatable3').DataTable( {
        "order": [[ 1, "desc" ]],
        responsive: true
    } );
    $('#default-datatable4').DataTable( {
        "order": [[ 1, "desc" ]],
        responsive: true
    } );   
    var table1 = $('#datatable-buttons').DataTable({
        "order": [[ 6, "desc" ]],
        responsive: true,
        buttons: ['excel','print']
    });
    table1.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    /*var table = $('#datatable-buttons').DataTable({
        responsive: true,
        buttons: ['excel','print']
    });
    table.buttons().container().appendTo('#datatable-buttons');*/
    
    var table1 = $('#datatable-buttons1').DataTable({
        responsive: true,
        buttons: ['excel','print']
    });
    table1.buttons().container().appendTo('#datatable-buttons1');
    
    var table2 = $('#datatable-buttons2').DataTable({
        responsive: true,
        buttons: ['excel','print']
    });
    table2.buttons().container().appendTo('#datatable-buttons2');
    
    var table3 = $('#datatable-buttons3').DataTable({
        responsive: true,
        buttons: ['excel','print']  
    });
    table3.buttons().container().appendTo('#datatable-buttons_wrapper3 .col-md-6:eq(0)');
});