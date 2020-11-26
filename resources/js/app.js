/*++ Start LibImports ++*/
require('./bootstrap');
require('./data_table');
import Swal from 'sweetalert2/dist/sweetalert2.js';
//require('./sweetalert');
/*++ End LibImports ++*/

/*++ Start ReactComponents ++*/
require('./components/tables/TaskTable');
require('./components/modals/CreateProjectModal');
/*++ End ReactComponents ++*/

/*++ Start TableFunctions ++*/
import TableLoads from './control/TableLoads';
const table = new TableLoads();
/*++ End TableFunctions ++*/

/*++ Start ControlFunctions ++*/
import ProjectControl from './control/ProjectControl';
const projectControl = new ProjectControl();
/*++ End ControlFunctions ++*/

/*++ Start JqueryReady ++*/
jQuery(()=>{
    /*++ StartLoadTables ++*/
    table.loadTaskTable();
    /*++ EndLoadTables ++*/

    /*++ StartAjaxForms ++*/
    projectControl.storeProjectAjax();
    /*++ EndAjaxForms ++*/
});
/*++ End JqueryReady ++*/

/*++ Start CustomFuctions ++*/ 
window.createProjectModal = () => { $("#create_project_modal").modal(); };
window.msg = (title,text) => Swal.fire({
    titleText: 'Listo',
    text: 'El proyecto se creo con éxito',
    confirmButtonText: "Aceptar",
    toast: true,
    timerProgressBar:8000,
    timer: 2000,
    showConfirmButton:false
});
/*++ End CustomFuctions ++*/ 
/*
function storeProjectAjax()
{
    const form = $("#frm_store_project_ajax");
    form.submit(e => {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: form.prop('action'),
            data: form.serialize(),
            success: (data) => {
                console.log(data);
                $("#select_project_task").html(data);
                $("#create_project_modal").modal("hide");
                msg('Listo','El proyecto se creo con éxito');
            },
            error: (jqXHR, status, error) => {
                console.log(error);
                $.each(jqXHR.responseJSON.errors, function(index, value) {
                    $("#"+index+"_project_error").text(value);
                });
            }
        });
    });
}
*/
/*
const customButton = Swal.mixin({
    
    customClass: {
        confirmButton: 'btn-primary-sys',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
});
*/
