import React , {Component} from 'react';
import ReactDOM from 'react-dom';

class CreateProjectModal extends Component{

    constructor(props){
        super(props);
        this.state = {
            route:$("#txt_stored_project_ajax").val(),
            _token:$('meta[name="csrf-token"]').attr('content'),
            modal_title: "Crear proyecto",
            title: 'title',
            description: 'description'
        };
    }

    render() {
        return (
            <div className="modal fade" id="create_project_modal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">{ this.state.modal_title}</h5>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action={ this.state.route } method="POST">
                            <div className="modal-body">
                                <input type="hidden" name="_token" defaultValue={ this.state._token } />
                                <div className="form-group">
                                    <label htmlFor={ this.state.title } className="font-weight-bold">Título</label>
                                    <input type="text" id="txt1" name={ this.state.title } className="form-control"/>
                                </div>
                                <div className="form-group">
                                    <label htmlFor={ this.state.description } className="font-weight-bold">Descripción</label>
                                    <textarea id="txt2" name={ this.state.description } className="form-control"></textarea>
                                </div>
                                
                            </div>
                            <div className="modal-footer">
                                <button type="button" className="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" className="btn btn-primary-sys">Guardar proyecto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        );
    };
}
if(document.getElementById('create_project_modal_render'))
{
    ReactDOM.render(<CreateProjectModal />,document.getElementById('create_project_modal_render'));
}