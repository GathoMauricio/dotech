class ProjectControl {
    storeProjectAjax()
    {
        const form = $("#frm_store_project_ajax");
        form.submit(e => {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: form.prop('action'),
                data: form.serialize(), 
                success: (data) => {
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
}

export default ProjectControl;