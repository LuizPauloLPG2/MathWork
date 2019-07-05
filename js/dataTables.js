$('.table-datatable').DataTable({
    "iDisplayLength": 4,
    "lengthMenu": [4, 10, 25],
    "pageLength": 4,
    "searching": true,
    "responsive": true,
    "language": {
        "decimal": ",",
        "thousands": ".",
        "info": "",
        "infoEmpty": "",
        "infoPostFix": "",
        "infoFiltered": "(FILTRADO DE UM TOTAL DE _MAX_ REGISTROS!)",
        "loadingRecords": "Carregando...",
        "lengthMenu": "_MENU_",
        "paginate": {
            "first": "PRIMEIRO",
            "last": "ÚLTIMO",
            "next": "SEGUINTE",
            "previous": "ANTERIOR"
        },
        "processing": "Procesando...",
        "search": "<strong>PESQUISAR</strong>",
        "searchPlaceholder": "",
        "zeroRecords": "Nenhum registro encontrado!",
        "emptyTable": "Nenhum registro encontrado!",
        "aria": {
            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "create": "Novo",
            "edit": "Cambiar",
            "remove": "Apagar",
            "copy": "COPIAR",
            "csv": "CSV",
            "excel": "tabla Excel",
            "pdf": "documento PDF",
            "print": "IMPRIMIR",
            "colvis": "Visibilidad columnas",
            "collection": "Colección",
            "upload": "Selecione fichero...."
        },
        "select": {
            "rows": {
                _: '%d filas seleccionadas',
                0: 'clic fila para seleccionar',
                1: 'uma linha selecionada'
            }
        },
    }
});