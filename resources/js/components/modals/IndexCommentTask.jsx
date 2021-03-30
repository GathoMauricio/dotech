import React , {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
class IndexCommentTask extends Component{
    constructor(props){
        super(props);
        this.state = {
            task_id: this.props.task_id,
            modal_id:'index_task_comment_modal',
            react_component_id: 'index_task_comment_modal_render',
            modal_title: "Comentarios de la tarea",
            store_task_comment: $("#txt_store_task_comment_route_ajax").val(),
            _token:$('meta[name="csrf-token"]').attr('content'),
        };
        axios.get(this.props.route,{
            'params':{ id:this.props.task_id }
        }).
        then(result => {
            const data = result.data;
            $("#TaskcommentBox").html('');
            let counter = 0;
            $.each(data, function(index, value) {
                counter ++;
                $("#TaskcommentBox").append(
                    '<div class="comment-item">'+
                    '<label class="color-primary-sys font-weight-bold">'+
                    value.author+
                    '</label>'+
                    '<br/>'+
                    value.body+
                    '<br/>'+
                    '<span class="font-weight-bold float-right">'+
                    value.created_at+
                    '</span>'+
                    '<br/>'+
                    '</div><br/>'
                );
            });
            $("#TaskcommentBox").animate({ scrollTop: $(document).height()*10000 }, 0);
            if(counter <= 0)
            {
                $("#TaskcommentBox").html(
                    '<center><span style="background-color:#F7DC6F;padding:5px;border-radius:3px;" class="text-center font-weight-bold">'+
                        'Aún no se han agregado comentarios en esta tarea'+
                    '</span></center>'
                );
            }
            ReactDOM.render(<IndexCommentTask />,document.getElementById(this.state.react_component_id),() => {
                const form = $("#form_store_task_comment");
                form.on("submit", e => {
                    e.preventDefault();
                    const body = $("#txt_body_comment_task").val();
                    if(body.length > 0) {
                        $.ajax({
                            type:'POST',
                            url: form.attr('action'),
                            data:form.serialize(),
                            success: data => {
                                form[0].reset();
                                $("#TaskcommentBox").html('');
                                let count = 0;
                                $.each(data, function(index, value) {
                                    count ++;
                                    $("#TaskcommentBox").append(
                                        '<div class="comment-item">'+
                                        '<label class="color-primary-sys font-weight-bold">'+
                                        value.author+
                                        '</label>'+
                                        '<br/>'+
                                        value.body+
                                        '<br/>'+
                                        '<span class="font-weight-bold float-right">'+
                                        value.created_at+
                                        '</span>'+
                                        '<br/>'+
                                        '</div><br/>'
                                    );
                                });
                                $("#tbl_count_comments_task_"+this.state.task_id).text(count);
                                $("#TaskcommentBox").animate({ scrollTop: $(document).height()*10000 }, 3000);
                            },
                            error: error => { console.log(error); }
                        });
                    }
                });
            });
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
                        <div className="modal-body comment-box-modal" id="TaskcommentBox">
                        </div>
                        <div className="modal-footer">
                            <form style={{ width: '100%' }} className="form" id="form_store_task_comment" action={ this.state.store_task_comment } method="POST">
                                <div className="container">
                                    <div className="row">
                                        <div className="col-md-12">
                                            <input type="hidden" name="_token" defaultValue= { this.state._token }/>
                                            <input type="hidden" name="task_id" defaultValue= { this.props.task_id }/>
                                            <input type="text" id="txt_body_comment_task" name="body" className="form-control" placeholder="Escriba aqui su comentario..."/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        );
    };
}
export default IndexCommentTask;