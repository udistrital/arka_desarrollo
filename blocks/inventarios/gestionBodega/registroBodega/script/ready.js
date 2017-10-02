$("#tablaTitulos").dataTable().fnDestroy();


$(document).ready(function () {
    $('#tablaTitulos').DataTable({
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sRowSelect": "os",
            "aButtons": ["select_all", "select_none"]
        },
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sSearch": "Buscar:",
            "sLoadingRecords": "Cargando...",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ãšltimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
        "columnDefs": [
            {
                "targets": [0, 1],
                "visible": false,
                "searchable": false
            }
        ],
        processing: true,
        searching: true,
        "deferLoading": 10,
        "scrollY": "400px",
        "scrollCollapse": false,
        "bLengthChange": false,
        "bPaginate": false,
        "aoColumns": [
            {sWidth: "1%", sClass: "center"},
            {sWidth: "1%", sClass: "center"},
            {sWidth: "10%", sClass: "center"},
            {sWidth: "9%", sClass: "center"},
            {sWidth: "20%", sClass: "center"},
            {sWidth: "9%", sClass: "center"},
            {sWidth: "20%", sClass: "center"},
            {sWidth: "10%", sClass: "center"},
            {sWidth: "20%", sClass: "center"}
        ]


    });

   
});

