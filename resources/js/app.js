require('./bootstrap');
window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const app = new Vue({
    el: '#app',
});
require('./data_table');
jQuery(()=>{
    loadTaskTable();
});

let loadTaskTable = () => {
    const route = $("#txt_tasks_route").val();
    $.ajax({
        'url' : route,
        success: data => { console.log(data); },
        error: error => { console.error(error); }
    });
    
    $("#tbl_tasks").dataTable({
        ajax: route,
        bJQueryUI: true,
        bScrollInfinite: true,
        bScrollCollapse: true,
        bPaginate: true,
        bFilter: true,
        bSort: true,
        aaSorting: [[1, "desc"]],
        pageLength: 10,
        columns: [
            { "data": "context" },
            { "data": "project" },
            { "data": "title" },
            { "data": "user" },
            { "data": "deadline" },
            { "data": "comments" },
            { "data": "status" },
            { "data": "options" }
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