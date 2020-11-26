/*++ Start LibImports ++*/
require('./bootstrap');
require('./data_table');
/*++ End LibImports ++*/

/*++ Start ReactComponents ++*/
require('./components/tables/TaskTable');
require('./components/modals/CreateProjectModal');
/*++ End ReactComponents ++*/

/*++ Start TableFunctions ++*/
import TableLoads from './TableLoads';
const table = new TableLoads();
/*++ End TableFunctions ++*/

/*++ Start JqueryReady ++*/
jQuery(()=>{
    table.loadTaskTable();
});
/*++ End JqueryReady ++*/

/*++ Start Fuctions ++*/ 

window.createProjectModal = () => { $("#create_project_modal").modal(); };

/*++ End Fuctions ++*/ 