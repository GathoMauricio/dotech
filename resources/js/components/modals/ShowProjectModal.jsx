import React , {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
class ShowProjectModal extends Component{
    constructor(props){
        super(props);
        this.state = {
            _token:$('meta[name="csrf-token"]').attr('content'),
            _method: 'PUT',
            route: $("#txt_update_project_route_ajax").val(),
            modal_id:'show_project_modal',
            react_component_id: 'show_project_modal_render',
            modal_title: "Información del projecto",
            project_name: '',
            options_box_display: 'none',
        };
        axios.get(this.props.route,{
            params:{ id: this.props.project_id }
        }).then(result =>{
            const data = result.data;
            this.state.project_author = data.project_author;
            this.state.project_name = data.project_name;
            this.state.project_description = data.project_description;
            this.state.created_at = data.created_at;
            this.state.updated_at = data.updated_at;
            if(data.author_id == this.props.user_id || this.props.rol_user_id == 1)
            {  
                $("#options_box").css('display', 'block'); 
            }
            ReactDOM.render(<ShowProjectModal />,document.getElementById(this.state.react_component_id));
        }).catch( console.log );
    }
    activateForm(){
        $("#btn_submit").css('display', 'inline');
        $("#link_submit").css('display', 'none');
        $("#txt_project_name").attr('readOnly',false);
        $("#txt_project_description").attr('readOnly',false);
        $("#frm_update_project_ajax").submit(e => {
            e.preventDefault();
            const form = $("#frm_update_project_ajax");
            loading();
            $.ajax({
                type: "POST", url: form.attr('action'),data: form.serialize(),
                success: data => { 
                    msg(data.type,data.msg);
                    $("#btn_submit").css('display', 'none');
                    $("#link_submit").css('display', 'inline');
                    $("#txt_project_name").attr('readOnly',true);
                    $("#txt_project_description").attr('readOnly',true);
                    $(".project_task_"+data.project_id).text(data.name);
                    $("#"+this.state.modal_id).modal('hide');
                },
                error: (jqXHR, status, error) => { 
                    console.clear();
                    msg("Error:","Compruebe que todos los datos son correctos...");
                    $.each(jqXHR.responseJSON.errors, function(index, value) {
                        $("#"+index+"_project_error").text(value);
                    });
                }
            });
        });
    }
    render() {
        return (
            <div className="modal fade" id={ this.state.modal_id } tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div className="modal-dialog modal-lg" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">{ this.state.modal_title}</h5>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action={ this.state.route } method="POST" id="frm_update_project_ajax">
                            <input type="hidden" name="_token" defaultValue={ this.state._token } readOnly/>
                            <input type="hidden" name="_method" defaultValue={ this.state._method } readOnly/>
                            <input type="hidden" name="project_id" defaultValue={ this.props.project_id } readOnly/>
                            <div className="modal-body">
                                <div className="container">
                                    <div className="row">
                                        <div className="col-md-12">
                                            <label className="font-weight-bold">
                                                Autor:
                                            </label>
                                            &nbsp;
                                            { this.state.project_author }
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col-md-12">
                                            <label className="font-weight-bold color-primary-sys">
                                                Nombre:
                                            </label>
                                            &nbsp;
                                            <input name="name" defaultValue={this.state.project_name} id="txt_project_name" type="text" className="form-control"  readOnly/>
                                            <small id="name_project_error" style={{color:'#d30035'}}></small>
                                        </div>
                                        <div className="col-md-12">
                                            <label className="font-weight-bold color-primary-sys">
                                                Descripción:
                                            </label>
                                            &nbsp;
                                            <textarea name="description" defaultValue={this.state.project_name} id="txt_project_description" className="form-control" rows="5" readOnly></textarea>
                                            <small id="description_project_error" style={{color:'#d30035'}}></small>
                                        </div>
                                        <div className="col-md-12">
                                            <b className="color-primary-sys">
                                                <small>Creado el { this.state.created_at }</small>   
                                                <br/>
                                                <small>Última vez actualizado el { this.state.updated_at }</small>
                                            </b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id= "options_box" style= {{ display: 'none' }} className= "modal-footer">
                                <button style={{display:'none'}} id="btn_submit" type="submit" className="btn btn-primary-sys float-right">Actualizar</button>
                                <a href="#" onClick={ () => this.activateForm() } style={{display:''}} id="link_submit" className="btn link-sys float-right">Actualizar></a>
                                <br/><br/>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        );
    };
}
export default ShowProjectModal;