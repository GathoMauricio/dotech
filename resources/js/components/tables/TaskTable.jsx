import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class TaskTable extends Component {
    constructor(props) {
        super(props);
        this.state = {
            title0 : null,
            title1 : null,
            title2 : 'Proyecto',
            title3 : 'Titulo',
            title4 : 'Usuario',
            title5 : 'DeadLine',
            title6 : 'Comm',
            title7 : 'Estatus',
            title8 : null,
        };
    }
    render(){
        return (
            <table id="tbl_tasks" className="table table-bordered">
                <thead>
                    <tr>
                        <th width="2%" scope="col">{ this.state.title0 }</th>
                        <th width="2%" scope="col">{ this.state.title1 }</th>
                        <th width="15%" scope="col">{ this.state.title2 }</th>
                        <th width="25%" scope="col">{ this.state.title3 }</th>
                        <th width="20%" scope="col">{ this.state.title4 }</th>
                        <th width="10%" scope="col">{ this.state.title5 }</th>
                        <th width="5%" scope="col">{ this.state.title6 }</th>
                        <th width="10%" scope="col">{ this.state.title7 }</th>
                        <th width="5%" scope="col">{ this.state.title8 }</th>
                    </tr>
                </thead>
            </table>
        );
    }
}
if (document.getElementById('task_table_render'))
{
    ReactDOM.render(<TaskTable />, document.getElementById('task_table_render'));
}