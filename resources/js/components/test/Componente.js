import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import './Componente.scss'

export default class Componente extends Component {
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header texto_red">Hola, Este es el componente.</div> 
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('componente')) {
    ReactDOM.render(<Componente />, document.getElementById('componente'));
}