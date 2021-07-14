import React , {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
class CreateProjectModal extends Component{

    constructor(props){
        super(props);
        this.state = {
            route:$("#txt_stored_project_ajax").val(),
            _token:$('meta[name="csrf-token"]').attr('content'),
            modal_title: "Crear proyecto",
        };
        axios.get($('#txt_cbo_company_route').val()).then(result => 
            { 
                $("#cbo_company_create_project").html(result.data); 
            }).catch(console.log);;
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
                        <form action={ this.state.route } method="POST" id="frm_store_project_ajax">
                            <div className="modal-body">
                                <input type="hidden" name="_token" defaultValue={ this.state._token } />
                                <div className="form-group">
                                    <label htmlFor={ this.state.name } className="font-weight-bold">
                                        Nombre del proyecto 
                                        &nbsp;
                                        <small className="icon icon-svg" style={{color:'#d30035',fontSize:'8px'}}></small>
                                        </label>
                                    <input name="name" type="text"  placeholder="Ingrese el título del proyecto." className="form-control"/>
                                    <small id="name_project_error" style={{color:'#d30035'}}></small>
                                </div>
                                <div className="form-group">
                                    <label className="font-weight-bold">
                                        Compañía
                                        </label>
                                    <select name="company_id" id="cbo_company_create_project" className="form-control"></select>
                                    <small id="company_id_error" style={{color:'#d30035'}}></small>
                                </div>
                                <div className="form-group">
                                    <label htmlFor={ this.state.description } className="font-weight-bold">
                                        Descripción
                                    </label>
                                    <textarea name="description"  placeholder="Especifique una descripción para el proyecto." className="form-control"></textarea>
                                    <small id="description_project_error" style={{color:'#d30035'}}></small>
                                </div>
                                <div className="form-group">
                                <small className="icon icon-svg" id="small_title_project_error" style={{color:'#d30035',fontSize:'8px'}}></small>
                                &nbsp;Estos campos son obligatorios.
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