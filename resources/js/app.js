/*++ Start LibImports ++*/
import React from 'react';
import ReactDOM , { findDOMNode } from 'react-dom';
require('./bootstrap');
require('./data_table');
import Swal from 'sweetalert2/dist/sweetalert2.js';
/*++ End LibImports ++*/

/*++ Start ReactComponents ++*/
require('./components/tables/TaskTable');
require('./components/modals/CreateProjectModal');
import ShowTaskModal from './components/modals/ShowTaskModal';
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
window.createProjectModal = () => $("#create_project_modal").modal(); 

window.showProjectModal = id => {
    console.log('showProjectModal');
    $("#show_project_modal").modal(); 
}
window.showTaskModal = id => {
    const route = $("#txt_show_task_route_ajax").val();
    ReactDOM.unmountComponentAtNode(document.getElementById('show_task_modal_render')); 
    ReactDOM.render(<ShowTaskModal route={ route } task_id={id}/>,document.getElementById('show_task_modal_render'));
    $("#show_task_modal").modal(); 
}
window.showUserModal = id => {
    console.log('showUserModal');
    $("#show_user_modal").modal(); 
}
window.editTaskModal = id=> {
    console.log('editTaskModal');
    $("#edit_task_modal").modal(); 
}
window.archiveTaskModal = id => {
    console.log('archiveTaskModal');
    $("#archive_task_modal").modal(); 
}
window.deleteTaskModal = id => {
    console.log('deleteTaskModal');
    $("#delete_task_modal").modal(); 
}
window.showTaskCommentsModal = id => {
    console.log('showTaskCommentsModal');
    $("#show_comments_task_modal").modal(); 
}
window.msg = (title,text) => Swal.fire({
    titleText: title,
    text: text,
    confirmButtonText: "Aceptar",
    toast: true,
    timerProgressBar:8000,
    timer: 3000,
    showConfirmButton:false
});
window.loading = () => Swal.fire({
    titleText: 'Poocesando peticion...',
    text: '',
    confirmButtonText: "",
    toast: true,
    timerProgressBar:8000,
    showConfirmButton:false
});
/*++ End CustomFuctions ++*/ 
const customButton = Swal.mixin({
    
    customClass: {
        confirmButton: 'btn-primary-sys',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
});
