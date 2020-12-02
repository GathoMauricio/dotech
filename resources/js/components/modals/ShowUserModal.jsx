import React , {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
class ShowUserModal extends Component{
    constructor(props){
        super(props);
        this.state = {
            modal_id:'show_user_modal',
            react_component_id: 'show_user_modal_render',
            modal_title: "Información del usuario",
        };
        axios.get(this.props.route,{
            'params':{ id:this.props.user_id }
        }).
        then(result => {
            const data = result.data;
            this.state.image = data.image
            this.state.name = data.name
            this.state.rol = data.rol
            this.state.email = data.email
            this.state.phone = data.phone
            this.state.emergency = data.emergency
            this.state.address = data.address
            this.state.location = data.location
            ReactDOM.render(<ShowUserModal />,document.getElementById(this.state.react_component_id));
        }).catch(console.log);
    }

    render() {
        return (
            <div className="modal fade" id={ this.state.modal_id } tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div className="modal-dialog modal-lg" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                                { this.state.modal_title}
                            </h5>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-body">
                            <div className="container">
                                <div className="row">
                                    <div className="col-md-3">
                                        <img src={ this.state.image } width="80" height="80"/>
                                    </div>
                                    <div className="col-md-6">
                                        <label className="color-primary-sys font-weight-bold">
                                            Nombre: 
                                        </label> 
                                        &nbsp;
                                        { this.state.name }
                                    </div>
                                    <div className="col-md-3">
                                        <label className="color-primary-sys font-weight-bold">
                                            Rol: 
                                        </label> 
                                        &nbsp;
                                        { this.state.rol }
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="col-md-4">
                                        <label className="color-primary-sys font-weight-bold">
                                            Email: 
                                        </label> 
                                        &nbsp;
                                        { this.state.email }
                                    </div>
                                    <div className="col-md-4">
                                        <label className="color-primary-sys font-weight-bold">
                                            Teléfono: 
                                        </label> 
                                        &nbsp;
                                        { this.state.phone }
                                    </div>
                                    <div className="col-md-4">
                                        <label className="color-primary-sys font-weight-bold">
                                            Emergencia: 
                                        </label> 
                                        &nbsp;
                                        { this.state.emergency }
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="col-md-9">
                                        <label className="color-primary-sys font-weight-bold">
                                            Dirección: 
                                        </label> 
                                        &nbsp;
                                        { this.state.address }
                                    </div>
                                    <div className="col-md-3">
                                        <label className="color-primary-sys font-weight-bold">
                                            Localidad: 
                                        </label> 
                                        &nbsp;
                                        { this.state.location }
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-primary-sys" data-dismiss="modal">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        );
    };
}
export default ShowUserModal;