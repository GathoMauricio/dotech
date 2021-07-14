import { ajax } from "jquery";

class TableLoads {
    loadTaskTable() {
        if(document.getElementById('tbl_tasks'))
        {
            const route = $("#txt_tasks_route").val();
            $("#tbl_tasks").dataTable({
                deferRender: true,
                ajax: route,
                bJQueryUI: true,
                bScrollInfinite: true,
                bScrollCollapse: true,
                bPaginate: true,
                bFilter: true,
                bSort: true,
                aaSorting: [[5, "desc"]],
                pageLength: 10,
                bDestroy: true,
                columns: [
                    { data: "context" },
                    { data: "visibility" },
                    { data: "project" },
                    { data: "title" },
                    { data: "user" },
                    { data: "deadline" },
                    { data: "comments" },
                    { data: "status" },
                    { data: "options" }
                ],
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [8]
                    },
                ],
                oLanguage: {
                    sLengthMenu: "_MENU_ ",
                    sInfo:
                        "<b>Se muestran de _START_ a _END_ elementos de _TOTAL_ registros en total</b>",
                    sInfoEmpty: "No hay registros para mostrar",
                    sSearch: "",
                    oPaginate: {
                        sFirst: "Primer página",
                        sLast: "Última página",
                        sPrevious: "<b>Anterior</b>",
                        sNext: "<b>Siguiente</b>"
                    }
                }
            });
            this.setTableStyle(); 
        }
    }
    loadTaskArchivedTable() {
        if(document.getElementById('tbl_tasks_archived'))
        {
            const route = $("#txt_tasks_archived_route").val();
            $("#tbl_tasks_archived").dataTable({
                deferRender: true,
                ajax: route,
                bJQueryUI: true,
                bScrollInfinite: true,
                bScrollCollapse: true,
                bPaginate: true,
                bFilter: true,
                bSort: true,
                aaSorting: [[5, "desc"]],
                pageLength: 10,
                bDestroy: true,
                columns: [
                    { data: "context" },
                    { data: "visibility" },
                    { data: "project" },
                    { data: "title" },
                    { data: "user" },
                    { data: "deadline" },
                    { data: "comments" },
                    { data: "status" },
                    { data: "options" }
                ],
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [8]
                    },
                ],
                oLanguage: {
                    sLengthMenu: "_MENU_ ",
                    sInfo:
                        "<b>Se muestran de _START_ a _END_ elementos de _TOTAL_ registros en total</b>",
                    sInfoEmpty: "No hay registros para mostrar",
                    sSearch: "",
                    oPaginate: {
                        sFirst: "Primer página",
                        sLast: "Última página",
                        sPrevious: "<b>Anterior</b>",
                        sNext: "<b>Siguiente</b>"
                    }
                }
            });
            this.setTableStyle(); 
        }
    }
    loadCompanyTable() {
        if(document.getElementById('company_table_sort'))
        {
            const route = $("#txt_index_company_route").val();
            $("#company_table_sort").dataTable({
                deferRender: true,
                ajax: {url:route,dataSrc:""},
                bJQueryUI: true,
                bScrollInfinite: true,
                bScrollCollapse: true,
                bPaginate: true,
                bFilter: true,
                bSort: true,
                aaSorting: [[0, "asc"]],
                pageLength: 10,
                bDestroy: true,
                columns: [
                    { data: "name" },
                    { data: "responsable" },
                    { data: "email" },
                    { data: "phone" },
                    //{ data: "address" },
                    { data: "options" }
                ],
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [4]
                    },
                ],
                oLanguage: {
                    sLengthMenu: "_MENU_ ",
                    sInfo:
                        "<b>Se muestran de _START_ a _END_ elementos de _TOTAL_ registros en total</b>",
                    sInfoEmpty: "No hay registros para mostrar",
                    sSearch: "",
                    oPaginate: {
                        sFirst: "Primer página",
                        sLast: "Última página",
                        sPrevious: "<b>Anterior</b>",
                        sNext: "<b>Siguiente</b>"
                    }
                }
            });
            this.setTableStyle(); 
        }
    }
    setTableStyle() {
        setTimeout(function() {
            $("select[name='DataTables_Table_0_length']").prop(
                "class",
                "custom-select"
            );
            $(".dataTables_length").prepend("<b>Mostrar</b> ");
            $("select[name='table_asistencias_length']").prop(
                "class",
                "custom-select"
            );
            $("select[name='DataTables_Table_0_length']").prop(
                "class",
                "form-control"
            );
            $(".dataTables_length").append(" <b>elementos por página</b>");
    
            $("input[type='search']").prop("class", "form-control");
            $("input[type='search']").prop("placeholder", "Ingrese un filtro...");
        }, 300);
    }
}

export default TableLoads;
