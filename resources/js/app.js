/*++ Start LibImports ++*/
import React from "react";
import ReactDOM, { findDOMNode } from "react-dom";
require("./bootstrap");
require("./data_table");
import Swal from "sweetalert2/dist/sweetalert2.js";
/*++ End LibImports ++*/

/*++ Start ReactComponents ++*/
require("./components/tables/TaskTable");
require("./components/tables/TaskArchivedTable");
require("./components/modals/CreateProjectModal");
import ShowTaskModal from "./components/modals/ShowTaskModal";
import ShowProjectModal from "./components/modals/ShowProjectModal";
import ShowUserModal from "./components/modals/ShowUserModal";
import IndexCommentTask from "./components/modals/IndexCommentTask";
/*++ End ReactComponents ++*/

/*++ Start TableFunctions ++*/
import TableLoads from "./control/TableLoads";
const table = new TableLoads();
/*++ End TableFunctions ++*/

/*++ Start ControlFunctions ++*/
import ProjectControl from "./control/ProjectControl";
const projectControl = new ProjectControl();
/*++ End ControlFunctions ++*/
window.updateWhitdrawalFolio = (id, folio) => {
    console.log(id + ' ' + folio);
    const route = $("#txt_update_whidrawal_folio").val();
    $.ajax({
        type: "GET",
        url: route,
        data: {
            id: id,
            folio: folio
        },
        success: data => {
            console.log(data);
        },
        error: err => console.log(err)
    });
};
window.updateWhitdrawalPaid = (id, paid) => {
    console.log(id + ' ' + paid);
    const route = $("#txt_update_whidrawal_paid").val();
    $.ajax({
        type: "GET",
        url: route,
        data: {
            id: id,
            paid: paid
        },
        success: data => {
            console.log(data);
            //tr_whitdrawal_
            let tr = $("#tr_whitdrawal_" + data.id);
            if (data.paid == 'SI') {
                tr.addClass('bg-info');
            } else {
                tr.removeClass('bg-info');
            }
        },
        error: err => console.log(err)
    });
};
window.searchQuotes = value => {
    const route = $("#txt_search_quote_route_ajax2").val();
    console.log("Value: " + route);
    $.ajax({
        type: "GET",
        url: route,
        data: { q: value },
        success: data => {
            console.log(data);
            $("#tbl_quotes_to_search").html('');
            let count = 0;
            $.each(data, (index, item) => {
                count++;
                $("#tbl_quotes_to_search").append(`
                <tr>
                <td>${ item.id }</td>
                <td>${ item.company }</td>
                <td>${ item.description }</td>
                <td>$${ item.amount }</td>
                <td>${ item.date }</td>
                <td>${ item.links }</td>
                </tr>
                `);
            });

            if (value.length > 0) {
                $("#span_result").text('Se muestran ' + count + ' resultados para "' + value + '" ...');
            } else {
                $("#span_result").text('');
            }
        },
        error: err => console.log(err)
    });

};

window.searchProjects = value => {
    const route = $("#txt_search_project_route_ajax2").val();
    console.log("Value: " + route);
    $.ajax({
        type: "GET",
        url: route,
        data: { q: value },
        success: data => {
            console.log(data);
            $("#tbl_projects_to_search").html('');
            let count = 0;
            $.each(data, (index, item) => {
                count++;
                $("#tbl_projects_to_search").append(`
                <tr>
                <td>${ item.id }</td>
                <td>${ item.company }</td>
                <td>${ item.description }</td>
                <td>$${ item.amount }</td>
                <td>${ item.date }</td>
                <td>${ item.links }</td>
                </tr>
                `);
            });

            if (value.length > 0) {
                $("#span_result").text('Se muestran ' + count + ' resultados para "' + value + '" ...');
            } else {
                $("#span_result").text('');
            }
        },
        error: err => console.log(err)
    });

};

window.searchProjectsF = value => {
    const route = $("#txt_search_project_f_route_ajax").val();
    console.log("Value: " + route);
    $.ajax({
        type: "GET",
        url: route,
        data: { q: value },
        success: data => {
            console.log(data);
            $("#tbl_projects_to_search").html('');
            let count = 0;
            $.each(data, (index, item) => {
                count++;
                $("#tbl_projects_to_search").append(`
                <tr>
                <td>${ item.id }</td>
                <td>${ item.company }</td>
                <td>${ item.description }</td>
                <td>$${ item.amount }</td>
                <td>${ item.date }</td>
                <td>${ item.links }</td>
                </tr>
                `);
            });

            if (value.length > 0) {
                $("#span_result").text('Se muestran ' + count + ' resultados para "' + value + '" ...');
            } else {
                $("#span_result").text('');
            }
        },
        error: err => console.log(err)
    });

};

window.searchWhitdrawals = value => {
    const route = $("#txt_search_whitdrawal_route_ajax2").val();
    console.log("Value: " + route);
    $.ajax({
        type: "GET",
        url: route,
        data: { q: value },
        success: data => {
            console.log(data);
            $("#tbl_whitdrawal_to_search").html('');
            let count = 0;
            $.each(data, (index, item) => {
                count++;
                $("#tbl_whitdrawal_to_search").append(`

                ${(item.paid == 'SI') ? '<tr class="bg-info"  id="tr_whitdrawal_'+item.id+'">' : '<tr id="tr_whitdrawal_'+item.id+'">' }
                <td>${ item.id }</td>
                <!--<td>${ item.provider }</td>-->
                <!--<td>${ item.company }</td>-->
                <td>
                <a href="#" target="_blank">
                ${ item.sale_id } 
                ${ item.company } 
                - 
                ${ item.sale_description}
                </a>
                <br/>
                <span class="text-info">Proveedor: </span>
                <br/>
                ${ item.provider }
                </td>
                <td>${ item.description }</td>
                <td>${ item.author }</td>
                <td>$${ item.quantity }</td>
                <!--<td>${ item.invoive }</td>-->
                <td>${ item.date }</td>
                <!--<td>${ item.folio }</td>-->
                <td>${ item.paidCombo }</td>
                <td>${ item.links }</td>
                </tr>
                `);
            });

            if (value.length > 0) {
                $("#span_result").text('Se muestran ' + count + ' resultados para "' + value + '" ...');
            } else {
                $("#span_result").text('');
            }
        },
        error: err => console.log(err)
    });
};

/*++ Start JqueryReady ++*/
jQuery(() => {

    /*++ AutocompleteQuotes ++*/
    $("#txt_search_quote").autocomplete({
        source: (request, response) => {
            const route = $("#txt_search_quote_route_ajax").val();

            $.ajax({
                url: route,
                dataType: 'json',
                data: { q: request.term },
                success: data => {
                    console.log(data);
                    response(data);
                },
                error: err => console.log(err)
            });
        },
        minLength: 1,
        select: (event, ui) => {
            console.log(JSON.stringify(ui));
            const route = $("#txt_show_quote_route_ajax").val();
            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    id: ui.item.value
                },
                success: data => {
                    console.log(data);


                    $("#span_quote_id_show_modal").text(data.id + ' - ' + data.description);
                    $("#span_quote_company_show_modal").text(data.company);
                    $("#span_quote_author_show_modal").text(data.author);
                    $("#span_quote_description_show_modal").text(data.description);
                    $("#span_quote_price_show_modal").text(data.price);
                    $("#span_quote_date_show_modal").text(data.date);

                    $("#button1_quote_show_modal").html(data.button1);
                    $("#button2_quote_show_modal").html(data.button2);
                    $("#button3_quote_show_modal").html(data.button3);
                    $("#button4_quote_show_modal").html(data.button4);
                    $("#button5_quote_show_modal").html(data.button5);



                    $("#show_quote_modal").modal();
                    $("#txt_search_quote").val('');
                },
                error: err => console.log(err)
            });

            //window.location = $("#txt_search_account_route").val() + '/' + ui.item.value;
        }
    });
    /*++ AutocompleteProjects ++*/
    $("#txt_search_project").autocomplete({
        source: (request, response) => {
            const route = $("#txt_search_project_route_ajax").val();

            $.ajax({
                url: route,
                dataType: 'json',
                data: { q: request.term },
                success: data => {
                    console.log(data);
                    response(data);
                },
                error: err => console.log(err)
            });
        },
        minLength: 1,
        select: (event, ui) => {
            console.log(JSON.stringify(ui));
            const route = $("#txt_show_project_route_ajax").val();
            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    id: ui.item.value
                },
                success: data => {
                    console.log(data);


                    $("#span_project_id_show_modal").text(data.id + ' - ' + data.description);
                    $("#span_project_company_show_modal").text(data.company);
                    $("#span_project_author_show_modal").text(data.author);
                    $("#span_project_description_show_modal").text(data.description);
                    $("#span_project_price_show_modal").text(data.price);
                    $("#span_project_date_show_modal").text(data.date);

                    $("#button1_project_show_modal").html(data.button1);
                    $("#button2_project_show_modal").html(data.button2);
                    $("#button3_project_show_modal").html(data.button3);
                    $("#button4_project_show_modal").html(data.button4);



                    $("#show_project_modal").modal();
                    $("#txt_search_project").val('');
                },
                error: err => console.log(err)
            });

            //window.location = $("#txt_search_account_route").val() + '/' + ui.item.value;
        }
    });
    /*++ AutocompleteBinnacles ++*/
    $("#txt_search_binnacle").autocomplete({
        source: (request, response) => {
            const route = $("#txt_search_binnnacle_route_ajax").val();

            $.ajax({
                url: route,
                dataType: 'json',
                data: { q: request.term },
                success: data => {
                    //console.log(data);
                    response(data);
                },
                error: err => console.log(err)
            });
        },
        minLength: 1,
        select: (event, ui) => {
            console.log(JSON.stringify(ui));
            const route = $("#txt_show_binnacle_route_ajax").val();
            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    id: ui.item.value
                },
                success: data => {
                    console.log(data);


                    $("#span_binnacle_id_show_modal").text(data.binnacle.id);
                    $("#span_binnacle_company_show_modal").text(data.company.name);
                    $("#span_binnacle_project_show_modal").text(data.sale.description);
                    $("#span_binnacle_author_show_modal").text(data.author.name + ' ' + data.author.middle_name + ' ' + data.author.last_name);
                    $("#span_binnacle_description_show_modal").text(data.binnacle.description);
                    $("#span_binnacle_date_show_modal").text(data.binnacle.created_at + ' Hrs');

                    $("#button1_binnacle_show_modal").html(data.button1);
                    $("#button2_binnacle_show_modal").html(data.button2);
                    $("#button3_binnacle_show_modal").html(data.button3);
                    $("#button4_binnacle_show_modal").html(data.button4);


                    $("#show_binnacle_modal").modal();
                    $("#txt_search_binnacle").val('');
                },
                error: err => console.log(err)
            });

            //window.location = $("#txt_search_account_route").val() + '/' + ui.item.value;
        }
    });
    /*++ AutocompleteWhitdrawals ++*/
    $("#txt_search_whitdrawal").autocomplete({
        source: (request, response) => {
            const route = $("#txt_search_whitdrawal_route_ajax").val();

            $.ajax({
                url: route,
                dataType: 'json',
                data: { q: request.term },
                success: data => {
                    //console.log(data);
                    response(data);
                },
                error: err => console.log(err)
            });
        },
        minLength: 1,
        select: (event, ui) => {
            //console.log(JSON.stringify(ui));
            const route = $("#txt_show_whitdrawal_route_ajax").val();
            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    id: ui.item.value
                },
                success: data => {
                    //console.log(data);
                    $("#span_whitdrawal_id_show_modal").text(data.id);
                    $("#span_whitdrawal_provider_show_modal").text(data.provider);
                    $("#span_whitdrawal_project_show_modal").text(data.project);
                    $("#span_whitdrawal_description_show_modal").text(data.description);
                    $("#span_whitdrawal_author_show_modal").text(data.author);
                    $("#span_whitdrawal_quantity_show_modal").text(data.quantity);
                    $("#span_whitdrawal_invoive_show_modal").text(data.invoive);
                    $("#span_whitdrawal_date_show_modal").text(data.date);
                    $("#span_whitdrawal_status_show_modal").text(data.status);

                    $("#button1_whitdrawal_show_modal").html(data.button1);
                    $("#button2_whitdrawal_show_modal").html(data.button2);

                    $("#show_withdrawal_modal").modal();
                    $("#txt_search_whitdrawal").val('');
                },
                error: err => console.log(err)
            });

            //window.location = $("#txt_search_account_route").val() + '/' + ui.item.value;
        }
    });
    /*++ StartLoadTables ++*/
    setTimeout(calculateCurrencies, 1000);
    table.loadTaskTable();
    table.loadTaskArchivedTable();
    table.loadCompanyTable();
    /*++ EndLoadTables ++*/

    /*++ StartAjaxForms ++*/
    projectControl.storeProjectAjax();
    /*++ EndAjaxForms ++*/
    VMasker($("._currency_mask")).maskMoney({
        precision: 2,
        separator: ".",
        delimiter: "."
    });
    /*+Form edit my password+++*/
    $("#form_edit_my_password").on('submit', e => {
        const password = $("#txt_edit_my_password").val();
        const password_confirm = $("#txt_edit_my_password_confirm").val();
        if (password == password_confirm) {
            return true;
        } else {
            e.preventDefault();
            msg('Error: ', 'Las contraseñas no coinciden');
        }
    });
    $("#form_edit_password").on('submit', e => {
        const password = $("#txt_edit_password").val();
        const password_confirm = $("#txt_edit_password_confirm").val();
        if (password == password_confirm) {
            return true;
        } else {
            e.preventDefault();
            msg('Error: ', 'Las contraseñas no coinciden');
        }
    });
    $("#form_store_sale_follow").on('submit', e => {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $("#form_store_sale_follow").prop('action'),
            data: $("#form_store_sale_follow").serialize(),
            success: data => {
                $("#form_store_sale_follow")[0].reset();
                $("#SaleFollowBox").html("");
                let counter = 0;
                $.each(data, function(index, value) {
                    counter++;
                    $("#SaleFollowBox").append(
                        '<div class="comment-item">' +
                        '<label class="color-primary-sys font-weight-bold">' +
                        value.author +
                        "</label>" +
                        "<br/>" +
                        value.body +
                        "<br/>" +
                        '<span class="font-weight-bold float-right">' +
                        value.created_at +
                        "</span>" +
                        "<br/>" +
                        "</div><br/>"
                    );
                });
                setTimeout(() => {
                    $("#SaleFollowBox").animate({ scrollTop: $(document).height() * 10000 },
                        500
                    );
                }, 500);
            },
            error: err => console.log(err)
        });
    });

});
/*++ End JqueryReady ++*/

/*++ Start CustomFuctions ++*/

window.createProjectModal = () => $("#create_project_modal").modal();

window.showProjectModal = project_id => {
    const route = $("#txt_show_project_route_ajax").val();
    const user_id = $("#txt_user_id").val();
    const rol_user_id = $("#txt_rol_user_id").val();
    const element_id = "show_project_modal_render";
    const modal_id = "show_project_modal";
    ReactDOM.unmountComponentAtNode(document.getElementById(element_id));
    ReactDOM.render( <
        ShowProjectModal route = { route }
        project_id = { project_id }
        user_id = { user_id }
        rol_user_id = { rol_user_id }
        />,
        document.getElementById(element_id)
    );
    $("#" + modal_id).modal();
};
window.showTaskModal = task_id => {
    const route = $("#txt_show_task_route_ajax").val();
    const element_id = "show_task_modal_render";
    const modal_id = "show_task_modal";
    ReactDOM.unmountComponentAtNode(document.getElementById(element_id));
    ReactDOM.render( <
        ShowTaskModal route = { route }
        task_id = { task_id }
        />,
        document.getElementById(element_id)
    );
    $("#" + modal_id).modal();
};
window.showUserModal = user_id => {
    const route = $("#txt_show_user_route_ajax").val();
    const element_id = "show_user_modal_render";
    const modal_id = "show_user_modal";
    ReactDOM.unmountComponentAtNode(document.getElementById(element_id));
    ReactDOM.render( <
        ShowUserModal route = { route }
        user_id = { user_id }
        />,
        document.getElementById(element_id)
    );
    $("#" + modal_id).modal();
};
window.editTaskModal = route => {
    window.location = route;
};
window.archiveTaskModal = task_id => {
    Swal.fire({
        title: "¿Archivar tarea?",
        text: "Esta tarea se podrá visualizar posteriórmente desde la vista de tareas archivadas.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, archivar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            const route = $("#txt_archive_task_route").val();
            $.ajax({
                type: "POST",
                url: route,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    _method: "PUT",
                    id: task_id
                },
                success: data => {
                    console.log(data);
                    table.loadTaskTable();
                    msg("Listo: ", "Tarea archivada!");
                },
                error: error => {
                    console.log(error);
                }
            });
        }
    });
};
window.deleteTaskModal = task_id => {
    Swal.fire({
        title: "¿Eliminar tarea?",
        text: "Esta acción eliminará todo el registro incluyendo los registros ligados a este y el cambio no se podrá deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            const route = $("#txt_destroy_task_route").val();
            $.ajax({
                type: "POST",
                url: route,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    _method: "DELETE",
                    id: task_id
                },
                success: data => {
                    console.log(data);
                    table.loadTaskTable();
                    table.loadTaskArchivedTable();
                    msg("Listo: ", "Registro eliminado!");
                },
                error: error => {
                    console.log(error);
                }
            });
        }
    });
};
window.showTaskCommentsModal = task_id => {
    const route = $("#txt_index_task_comment_route_ajax").val();
    const element_id = "index_task_comment_modal_render";
    const modal_id = "index_task_comment_modal";
    ReactDOM.unmountComponentAtNode(document.getElementById(element_id));
    ReactDOM.render( <
        IndexCommentTask route = { route }
        task_id = { task_id }
        />,
        document.getElementById(element_id)
    );
    $("#" + modal_id).modal();
};
window.msg = (title, text) =>
    Swal.fire({
        titleText: title,
        text: text,
        confirmButtonText: "Aceptar",
        toast: true,
        timerProgressBar: 8000,
        timer: 3000,
        showConfirmButton: false
    });
window.loading = () =>
    Swal.fire({
        titleText: "Procesando peticion...",
        text: "",
        confirmButtonText: "",
        toast: true,
        timerProgressBar: 8000,
        showConfirmButton: false
    });
/*++ End CustomFuctions ++*/

const customButton = Swal.mixin({
    customClass: {
        confirmButton: "btn-primary-sys",
        cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
});
window.indexServiceFollow = service_id => {

    const index_route = $("#txt_index_service_follow").val();
    $.ajax({
        type: "GET",
        url: index_route,
        data: {
            id: service_id
        },
        success: data => {
            $("#ServiceFollowBox").html("");
            let counter = 0;
            $.each(data, function(index, value) {
                counter++;
                $("#ServiceFollowBox").append(
                    '<div class="comment-item">' +
                    '<label class="color-primary-sys font-weight-bold">' +
                    value.author +
                    "</label>" +
                    "<br/>" +
                    value.body +
                    "<br/>" +
                    '<span class="font-weight-bold float-right">' +
                    value.created_at +
                    "</span>" +
                    "<br/>" +
                    "</div><br/>"
                );
            });
            setTimeout(() => {
                $("#ServiceFollowBox").animate({ scrollTop: $(document).height() * 10000 },
                    500
                );
            }, 500);
            if (counter <= 0) {
                $("#ServiceFollowBox").html(
                    '<center><span style="background-color:#F7DC6F;padding:5px;border-radius:3px;" class="text-center font-weight-bold">' +
                    "Aún no se han agregado seguimientos en esta compañía" +
                    "</span></center>"
                );
            }
            $("#service_follow_modal").modal("show");
        },
        error: error => console.log(error)
    });

    $("#form_store_service_follow").on("submit", e => {
        e.preventDefault();
        const form = $("#form_store_service_follow");
        $.ajax({
            type: "POST",
            url: form.prop("action"),
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                service_id: service_id,
                body: $("#txt_body_service_follow").val()
            },
            success: data => {
                form[0].reset();
                $("#ServiceFollowBox").html("");
                let counter = 0;
                $.each(data, function(index, value) {
                    counter++;
                    $("#ServiceFollowBox").append(
                        '<div class="comment-item">' +
                        '<label class="color-primary-sys font-weight-bold">' +
                        value.author +
                        "</label>" +
                        "<br/>" +
                        value.body +
                        "<br/>" +
                        '<span class="font-weight-bold float-right">' +
                        value.created_at +
                        "</span>" +
                        "<br/>" +
                        "</div><br/>"
                    );
                });
                $("#ServiceFollowBox").animate({ scrollTop: $(document).height() * 10000 },
                    0
                );
                if (counter <= 0) {
                    $("#ServiceFollowBox").html(
                        '<center><span style="background-color:#F7DC6F;padding:5px;border-radius:3px;" class="text-center font-weight-bold">' +
                        "Aún no se han agregado seguimientos en esta compañía" +
                        "</span></center>"
                    );
                }
                $("#service_service_modal").modal("show");
            },
            error: error => console.log(error)
        });

    });
};
window.indexCompanyFollow = company_id => {
    const index_route = $("#txt_index_company_follow").val();
    $.ajax({
        type: "GET",
        url: index_route,
        data: {
            id: company_id
        },
        success: data => {
            $("#CompanyFollowBox").html("");
            let counter = 0;
            $.each(data, function(index, value) {
                counter++;
                $("#CompanyFollowBox").append(
                    '<div class="comment-item">' +
                    '<label class="color-primary-sys font-weight-bold">' +
                    value.author +
                    "</label>" +
                    "<br/>" +
                    value.body +
                    "<br/>" +
                    '<span class="font-weight-bold float-right">' +
                    value.created_at +
                    "</span>" +
                    "<br/>" +
                    "</div><br/>"
                );
            });
            setTimeout(() => {
                $("#CompanyFollowBox").animate({ scrollTop: $(document).height() * 10000 },
                    500
                );
            }, 500);
            if (counter <= 0) {
                $("#CompanyFollowBox").html(
                    '<center><span style="background-color:#F7DC6F;padding:5px;border-radius:3px;" class="text-center font-weight-bold">' +
                    "Aún no se han agregado seguimientos en esta compañía" +
                    "</span></center>"
                );
            }
            $("#company_follow_modal").modal("show");
        },
        error: error => console.log(error)
    });

    $("#form_store_company_follow").on("submit", e => {
        e.preventDefault();
        const form = $("#form_store_company_follow");
        $.ajax({
            type: "POST",
            url: form.prop("action"),
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                company_id: company_id,
                body: $("#txt_body_company_follow").val()
            },
            success: data => {
                form[0].reset();
                $("#CompanyFollowBox").html("");
                let counter = 0;
                $.each(data, function(index, value) {
                    counter++;
                    $("#CompanyFollowBox").append(
                        '<div class="comment-item">' +
                        '<label class="color-primary-sys font-weight-bold">' +
                        value.author +
                        "</label>" +
                        "<br/>" +
                        value.body +
                        "<br/>" +
                        '<span class="font-weight-bold float-right">' +
                        value.created_at +
                        "</span>" +
                        "<br/>" +
                        "</div><br/>"
                    );
                });
                $("#CompanyFollowBox").animate({ scrollTop: $(document).height() * 10000 },
                    0
                );
                if (counter <= 0) {
                    $("#CompanyFollowBox").html(
                        '<center><span style="background-color:#F7DC6F;padding:5px;border-radius:3px;" class="text-center font-weight-bold">' +
                        "Aún no se han agregado seguimientos en esta compañía" +
                        "</span></center>"
                    );
                }
                $("#company_follow_modal").modal("show");
            },
            error: error => console.log(error)
        });
    });
};
window.loadDepartmentsByCompany = company_id => {
    $("#load_departments_by_company").css("display", "block");
    $.ajax({
        type: "GET",
        url: $("#txt_route_load_departments_by_id").val(),
        data: { id: company_id },
        success: data => {
            let html = "";
            $.each(data, function(index, value) {
                html +=
                    '<option value="' +
                    value.id +
                    '">' +
                    value.name +
                    ' - ' +
                    value.email +
                    "</option>";
            });
            $("#cbo_departments_by_company").html(html);
            $("#load_departments_by_company").css("display", "none");
        },
        error: error => console.log(error)
    });
};
window.calculateCurrencies = () => {
    let investment = $("#txt_investment_amount").val();
    let estimated = $("#txt_estimated_amount").val();
    let commisionPercent = $("#cbo_commision_percent").val();
    let utility = parseFloat(estimated) - parseFloat(investment);
    let iva = parseFloat(estimated * 16) / 100;
    let total = parseFloat(estimated) + parseFloat(iva);
    let commisionPay = parseFloat(total * commisionPercent) / 100;

    $("#txt_iva_amount").val(iva);
    $("#txt_total_amount").val(total);
    $("#txt_utility_amount").val(utility);
    $("#txt_commision_pay_amount").val(commisionPay);
};
window.showCompanyModal = id => {
    const route = $("#txt_company_show_ajax").val();
    $.ajax({
        type: "GET",
        url: route,
        data: { id: id },
        success: data => {
            $("#span_origin_modal").text(data.origin);
            $("#span_status_modal").text(data.status);
            $("#span_name_modal").text(data.name);
            $("#span_responsable_modal").text(data.responsable);
            $("#span_rfc_modal").text(data.rfc);
            $("#span_email_modal").text(data.email);
            $("#span_phone_modal").text(data.phone);
            $("#span_address_modal").text(data.address);
            $("#span_description_modal").text(data.description);
            $("#conmpany_show_modal").modal();
        },
        error: () => console.log
    });
};
window.editQuote = sale_id => {
    let route = $("#txt_show_quote_modal_ajax").val();
    $.ajax({
        type: "GET",
        url: route,
        data: { id: sale_id },
        success: data => {
            $("#edit_quote_modal_sale_id").val(sale_id);
            $("#edit_quote_modal_company").text(data.company);
            $("#edit_quote_modal_description").val(data.description);
            $("#edit_quote_modal_observation").val(data.observation);
            $("#edit_quote_modal_delivery_days").val(data.delivery_days);
            $("#edit_quote_modal_shipping").val(data.shipping);
            $("#edit_quote_modal_payment_type").val(data.payment_type);
            $("#edit_quote_modal_credit").val(data.credit);
            $("#edit_quote_modal_currency").val(data.currency);
            $("#edit_quote_modal").modal();
        },
        error: () => console.log
    });
};
window.editProject = sale_id => {
    let route = $("#txt_show_quote_modal_ajax").val();
    $.ajax({
        type: "GET",
        url: route,
        data: { id: sale_id },
        success: data => {
            $("#edit_quote_modal_sale_id").val(sale_id);
            $("#edit_quote_modal_company").text(data.company);
            $("#edit_quote_modal_description").val(data.description);
            $("#edit_quote_modal_observation").val(data.observation);
            $("#edit_project_modal").modal();
        },
        error: () => console.log
    });
};
window.addProductModal = () => {
    $("#add_product_modal").modal();
};
window.editProductModal = product_id => {
    let route = $("#txt_show_product_ajax").val();
    $.ajax({
        type: "GET",
        url: route,
        data: { id: product_id },
        success: data => {
            $("#txt_add_product_modal_id").val(data.id);
            $("#txt_add_product_modal_sale_id").val(data.sale_id);
            $("#txt_add_product_modal_measure").val(data.measure);
            $("#txt_add_product_modal_description").val(data.description);
            $("#txt_add_product_modal_quantity").val(data.quantity);
            $("#txt_add_product_modal_discount").val(data.discount);
            $("#txt_add_product_modal_unity_price_sell").val(
                data.unity_price_sell
            );
            $("#edit_product_modal").modal();
        },
        error: () => console.log
    });
};
window.deleteProductModal = product_id => {
    Swal.fire({
        title: "Alto",
        text: "El registro se eliminará de forma permanente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            let route = $("#txt_delete_product_route").val();
            window.location = route + '/' + product_id;
        }
    });
};
window.changeStatusModal = sale_id => {
    $("#txt_change_status_id").val(sale_id);
    $("#change_status_modal").modal();
};
window.addSaleFollowModal = sale_id => {
    $("#txt_add_sale_follow_sale_id").val(sale_id);
    $("#add_sale_follow_modal").modal();
};
window.deleteSaleFollow = id => {
    Swal.fire({
        title: "Alto",
        text: "El registro se eliminará de forma permanente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            let route = $("#txt_delete_sale_follow_route").val();
            window.location = route + '/' + id;
        }
    });
};
window.deleteSale = sale_id => {
    Swal.fire({
        title: "Alto",
        text: "El registro se eliminará de forma permanente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            let route = $("#txt_delete_sale_route").val();
            window.location = route + '/' + sale_id;
        }
    });
};

window.changeCommision = (commision_percent, sale_id) => {
    let route = $("#txt_change_commision_route").val();
    $.ajax({
        'type': 'GET',
        'url': route,
        'data': {
            commision_percent: commision_percent,
            sale_id: sale_id
        },
        success: data => {
            window.location.reload();
        },
        error: error => console.log(error)
    });
};
window.addSaleDocumentModal = sale_id => {
    $("#txt_add_sale_document_modal_sale_id").val(sale_id);
    $("#add_sale_document_modal").modal();
};
window.addSalePaymentModal = sale_id => {
    $("#txt_add_sale_payment_modal_sale_id").val(sale_id);
    $("#add_sale_payment_modal").modal();
};
window.addSaleWhitdrawal = sale_id => {
    $("#txt_add_sale_whitdrawal_modal_sale_id").val(sale_id);
    $("#add_sale_whitdrawal_modal").modal();
};
window.addWhitdralDocumentModal = id => {
    $("#txt_add_whitdrawal_document_modal_id").val(id);
    $("#add_whitdrawal_document_modal").modal();
};
window.addQuoteByCompanyModal = company_id => {
    $("#cbo_company_to_create_department").val(company_id);
    let route = $("#txt_show_company_department_ajax_route").val();
    $("#add_quote_by_company_modal_company_id").val(company_id);
    $.ajax({
        'type': 'GET',
        url: route,
        data: { id: company_id },
        success: data => {
            $("#cbo_add_quote_by_company_department").html(data.department_items);
            $("#add_quote_by_company_modal_company").text(data.company.name);
            $("#add_quote_by_company_modal").modal();
        },
        error: error => console.log(error)
    });
};
window.addQuoteModal = () => {
    $("#add_quote_modal").modal();
};
window.aproveWithdrawalModal = whitdrawal_id => {
    let route = $("#txt_show_whitdrawal_route").val();
    $.ajax({
        type: "GET",
        url: route,
        data: { id: whitdrawal_id },
        success: data => {
            console.log(data);
            $("#txt_aprove_withdrawal_description").text(data.description);
        },
        error: error => console.log(error)
    });
    $("#txt_aprove_withdrawal_modal_id").val(whitdrawal_id);
    $("#aprove_withdrawal_modal").modal();
};
window.sendQuoteModal = (sale_id, email) => {
    $("#txt_send_quote_modal_email").text(email);
    $("#txt_send_quote_modal_sale_id").val(sale_id);
    $("#send_quote_modal").modal();
}
window.disaproveWithdrawal = whitdrawal_id => {
    Swal.fire({
        title: "Alto",
        text: "La solicitud será rechazada y desaparecerá de esta lista.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, rechazar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            let route = $("#txt_disaprove_whitdrawal_route").val();
            window.location = route + '/' + whitdrawal_id;
        }
    });
};
window.deleteWithdrawal = whitdrawal_id => {
    Swal.fire({
        title: "Alto",
        text: "La solicitud será eliminada por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            let route = $("#txt_delete_whitdrawal_route").val();
            window.location = route + '/' + whitdrawal_id;
        }
    });
};
window.addProviderModal = () => {
    $("#add_sale_whitdrawal_modal").modal('hide');
    $("#add_provider_modal").modal();
};
window.deleteProvider = id => {
    Swal.fire({
        title: "Alto",
        text: "El registro será eliminada por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            let route = $("#txt_delete_provider_route").val();
            window.location = route + '/' + id;
        }
    });
};


window.editNameModal = () => {
    $("#edit_name_modal").modal();
};

window.deleteCompany = id => {
    Swal.fire({
        title: "Alto",
        text: "El registro será eliminada por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            let route = $("#txt_delete_company_route").val();
            window.location = route + '/' + id;
        }
    });
};
window.deleteDepartment = id => {
    Swal.fire({
        title: "Alto",
        text: "El registro será eliminada por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            let route = $("#txt_delete_department_route").val();
            window.location = route + '/' + id;
        }
    });
};
window.deleteAccount = id => {
    Swal.fire({
        title: "Alto",
        text: "El registro será eliminada por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            let route = $("#txt_delete_account_route").val();
            window.location = route + '/' + id;
        }
    });
};
window.deleteUser = id => {
    Swal.fire({
        title: "Alto",
        text: "El registro será eliminado por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            let route = $("#txt_delete_user_route").val();
            window.location = route + '/' + id;
        }
    });
};
window.showUserImage = src => {
    alert(src);
};
window.addDepartmentCompanyModal = () => {
    let company_id = $("#cbo_company_to_create_department").val();
    $("#txt_add_department_company_id").val(company_id);
    $("#add_department_company_modal").modal();
}
window.showServiceImage = id => {
    let route = $("#txt_show_service_image").val();
    $.ajax({
        'type': 'GET',
        'url': route,
        data: { id: id },
        success: data => {
            $("#show_image_description").text(data.description);
            $("#show_image_container").css('background-image', 'url(' + data.image + ')');
            $("#show_image_modal").css('display', 'flex');
        },
        error: error => console.log(error)
    });
};

window.editPasswordModal = () => {
    $("#edit_password_modal").modal();
};

window.viewBinnacleImages = (binnacle_id, count) => {
    if (count > 0) {
        const route = $("#txt_view_binnacle_images_route").val();
        let viewer = new PhotoViewer();
        viewer.disableEmailLink();
        //viewer.disablePhotoLink();
        viewer.enableLoop();
        viewer.enableAutoPlay();
        viewer.setFontSize(16);
        const show_binnacle_image = $("#txt_show_binnacle_image_route").val();
        viewer.permalink = () => {
            window.open(show_binnacle_image + '/' + $("#PhotoViewerByline").text());
        };
        //viewer.setOnClickEvent(viewer.permalink);
        $.ajax({
            type: 'GET',
            url: route + '/' + binnacle_id,
            data: {},
            success: data => {
                console.log(data);
                $.each(data, (index, item) => {
                    viewer.add(item.url, item.description, item.date, '' + item.id);
                });
                viewer.show(0);
            },
            error: error => console.log(error)
        });

    } else {
        msg("Aviso: ", "No hay imagenes para mostrar");
    }

};

window.addBinnacle = sale_id => {
    $("#txt_add_sale_id").val(sale_id);
    $("#add_binnacle_modal").modal();
};
window.addBinnacleImage = binnacle_id => {
    $("#txt_add_binnacle_image_id").val(binnacle_id);
    $("#add_binnacle_image_modal").modal();
};

window.sendBinnacle = binnacle_id => {
    const route = $("#txt_get_binnacle").val();
    $.ajax({
        type: 'GET',
        url: route + '/' + binnacle_id,
        data: {},
        success: data => {
            console.log(data);
            $("#txt_binnacle_id_send_pdf").val(data.binnacle.id);
            $("#txt_email_binnacle_pdf").val(data.department.email);
            $("#send_binnacle_pdf_modal").modal();
        },
        error: error => console.log(error)
    });
};
window.deleteBinnacleImage = id => {
    Swal.fire({
        title: "¿Eliminar imagen?",
        text: "Esta acción eliminará todo el registro y el cambio no se podrá deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            const route = $("#txt_destroy_binnacle_image").val();
            loading();
            $.ajax({
                type: "POST",
                url: route + '/' + id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    _method: "DELETE"
                },
                success: data => {
                    console.log(data);
                    window.close();
                },
                error: error => {
                    window.close();
                    console.log(error);
                }
            });
        }
    });
};
window.deleteCompanyRepository = id => {
    Swal.fire({
        title: "¿Eliminar repositorio?",
        text: "Esta acción no se podrá deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            const route = $("#txt_destroy_company_repository_route").val();
            window.location = route + '/' + id;
        }
    });
};

window.setTaskStatus = (id, status) => {
    loading();
    const route = $("#txt_set_task_status_route").val();
    $.ajax({
        type: "POST",
        url: route,
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            _method: "PUT",
            id: id,
            status: status
        },
        success: data => {
            msg(data);
        },
        error: error => {
            console.log(error);
        }
    });
};
window.setProjectAsFinish = id => {
    const route = $("#txt_set_project_as_finish").val();
    Swal.fire({
        title: "¿Marcar proyecto como finalizado?",
        text: "Este proyecto desaparecerá de la lista primcipal.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "green",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, finalizar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            window.location = route + '/' + id;
        }
    });
};
window.deleteVehicle = id => {
    const route = $("#txt_delete_vehicle_route").val();
    Swal.fire({
        title: "¿Eliminar vehiculo?",
        text: "El registro se eliminará por completo así como los registros relacionados a este.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            window.location = route + '/' + id;
        }
    });
};
window.addVehicleImage = id => {
    $("#txt_add_vehicle_image_id").val(id);
    $("#add_vehicle_image_modal").modal();
};
window.deleteVehicleImage = id => {
    const route = $("#txt_delete_vehicle_image_route").val();
    Swal.fire({
        title: "¿Eliminar imagen del vehiculo?",
        text: "El registro se eliminará por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            window.location = route + '/' + id;
        }
    });
};
window.addMaintenanceVehicle = id => {
    $("#txt_add_maintenance_id").val(id);
    $("#add_maintenance_modal").modal();
};
window.checkSectionOther = id => {
    if (id == 22) {
        $("#section_other_type").css("display", "block");
    } else {
        $("#section_other_type").css("display", "none");
    }
};
window.deleteMaintenance = id => {
    const route = $("#txt_delete_maitenance_route").val();
    Swal.fire({
        title: "¿Eliminar mantenimiento del vehiculo?",
        text: "El registro se eliminará por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            window.location = route + '/' + id;
        }
    });
};
window.addMaintenanceImage = id => {
    $("#txt_add_maintenance_image_id").val(id);
    $("#add_maintenance_image_modal").modal();
};
window.deleteMaintenanceImage = id => {
    const route = $("#txt_delete_maintenance_image_route").val();
    Swal.fire({
        title: "¿Eliminar imagen del mantenimiento?",
        text: "El registro se eliminará por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            window.location = route + '/' + id;
        }
    });
};
window.deleteBinnacle = id => {
    const route = $("#txt_delete_binnacle_route").val();
    Swal.fire({
        title: "¿Eliminar registro?",
        text: "El registro se eliminará por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            window.location = route + '/' + id;
        }
    });
};

window.sendBinnacleAll = sale_id => {
    const route = $("#txt_get_project_data").val();
    $.ajax({
        type: 'GET',
        url: route,
        data: {
            id: sale_id
        },
        success: data => {
            console.log(data);
            $("#txt_project_id_send_pdf_all").val(data.id);
            $("#txt_email_project_pdf_all").val(data.email);
            $("#send_all_binnacle_pdf_modal").modal();
        },
        error: error => console.log(error)
    });
};

window.showVehicleTab = tab => {
    $("#fotos_vehicles_container_tab").css('display', 'none');
    $("#mantenimientos_vehicles_container_tab").css('display', 'none');
    $("#salidas_vehicles_container_tab").css('display', 'none');
    $("#verificaciones_vehicles_container_tab").css('display', 'none');
    $("#documentacion_vehicles_container_tab").css('display', 'none');
    $("#" + tab + "_vehicles_container_tab").css('display', 'block');
};

window.addVehicleVerification = vehicle_id => {
    $("#txt_add_vehicle_verification_id").val(vehicle_id);
    $("#add_vehicle_verification_modal").modal();
};

window.addVehicleDocument = vehicle_id => {
    $("#txt_add_vehicle_document_id").val(vehicle_id);
    $("#add_vehicle_document_modal").modal();
};

window.deleteStockProduct = product_id => {
    console.log("eliminar producto");
    const route = $("#txt_delete_binnacle_route").val();
    Swal.fire({
        title: "¿Eliminar registro?",
        text: "El registro se eliminará por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            window.location = route + '/' + product_id;
        }
    });
}

window.addStockProductCategory = () => {
    $("#stock_category_products_create_modal").modal();
};

window.showCotizadoTab = tab => {
    $("#cotizado_container_tab").css('display', 'none');
    $("#productos_container_tab").css('display', 'none');
    $("#pagos_container_tab").css('display', 'none');
    $("#archivos_container_tab").css('display', 'none');
    $("#retiros_container_tab").css('display', 'none');
    $("#bitacoras_container_tab").css('display', 'none');
    $("#" + tab + "_container_tab").css('display', 'block');
};

window.deleteStockProductExit = id => {
    console.log("eliminar producto");
    const route = $("#txt_delete_stock_product_exit_route").val();
    Swal.fire({
        title: "¿Eliminar registro?",
        text: "El registro se eliminará por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            window.location = route + '/' + id;
        }
    });
};

window.changeStatusExitModal = exit_id => {
    $("#txt_change_status_ext_id").val(exit_id);
    $("#change_status_exit_modal").modal();
};

window.deleteStatusExit = id => {
    const route = $("#txt_delete_status_exit_route").val();
    Swal.fire({
        title: "¿Eliminar registro?",
        text: "El registro se eliminará por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            window.location = route + '/' + id;
        }
    });
};

window.isQuoteReject = value => {
    if (value == 'Rechazada') {
        $("#div_quote_reject_follow").css('display', 'block');
        $("#txt_quote_reject_follow").prop('required', true);
    } else {
        $("#div_quote_reject_follow").css('display', 'none');
        $("#txt_quote_reject_follow").val('');
        $("#txt_quote_reject_follow").removeAttr('required');
    }
};

window.saleFollowModal = sale_id => {
    $("#txt_follow_sale_id").val(sale_id);
    const index_route = $("#txt_index_sale_follow").val();
    $.ajax({
        type: "GET",
        url: index_route,
        data: {
            id: sale_id
        },
        success: data => {
            $("#SaleFollowBox").html("");
            let counter = 0;
            $.each(data, function(index, value) {
                counter++;
                $("#SaleFollowBox").append(
                    '<div class="comment-item">' +
                    '<label class="color-primary-sys font-weight-bold">' +
                    value.author +
                    "</label>" +
                    "<br/>" +
                    value.body +
                    "<br/>" +
                    '<span class="font-weight-bold float-right">' +
                    value.created_at +
                    "</span>" +
                    "<br/>" +
                    "</div><br/>"
                );
            });
            setTimeout(() => {
                $("#SaleFollowBox").animate({ scrollTop: $(document).height() * 10000 },
                    500
                );
            }, 500);
            if (counter <= 0) {
                $("#SaleFollowBox").html(
                    '<center><span style="background-color:#F7DC6F;padding:5px;border-radius:3px;" class="text-center font-weight-bold">' +
                    "Aún no se han agregado seguimientos" +
                    "</span></center>"
                );
            }
            $("#sale_follow_modal").modal();
        },
        error: error => console.log(error)
    });
};

window.addUserDocument = user_id => {
    $("#txt_add_user_document_modal_sale_id").val(user_id);
    $("#add_user_document_modal").modal();
};

window.deleteUserDocument = id => {
    const route = $("#txt_delete_user_document_route").val();
    Swal.fire({
        title: "¿Eliminar registro?",
        text: "El registro se eliminará por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            window.location = route + '/' + id;
        }
    });
};
window.deleteCandidate = id => {
    Swal.fire({
        title: "Alto",
        text: "El registro será eliminado por completo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            let route = $("#txt_delete_candidate_route").val();
            window.location = route + '/' + id;
        }
    });
};
window.addStockProductImage = id => {
    $("#txt_add_stock_product_image_id").val(id);
    $("#add_stock_product_image_modal").modal();
};
window.viewStockProductImages = (binnacle_id, count) => {
    if (count > 0) {
        const route = $("#txt_view_stock_product_images_route").val();
        let viewer = new PhotoViewer();
        viewer.disableEmailLink();
        //viewer.disablePhotoLink();
        viewer.enableLoop();
        viewer.enableAutoPlay();
        viewer.setFontSize(16);
        const show_binnacle_image = $("#txt_show_binnacle_image_route").val();
        viewer.permalink = () => {
            window.open(show_binnacle_image + '/' + $("#PhotoViewerByline").text());
        };
        //viewer.setOnClickEvent(viewer.permalink);
        $.ajax({
            type: 'GET',
            url: route + '/' + binnacle_id,
            data: {},
            success: data => {
                console.log(data);
                $.each(data, (index, item) => {
                    viewer.add(item.url, item.description, item.date, '' + item.id);
                });
                viewer.show(0);
            },
            error: error => console.log(error)
        });

    } else {
        msg("Aviso: ", "No hay imagenes para mostrar");
    }

};
window.deleteStockProductImage = id => {
    Swal.fire({
        title: "¿Eliminar imagen?",
        text: "Esta acción eliminará el registro y el cambio no se podrá deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#000",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) {
            const route = $("#txt_destroy_stock_product_image").val();
            loading();
            $.ajax({
                type: "POST",
                url: route + '/' + id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    _method: "DELETE"
                },
                success: data => {
                    console.log(data);
                    //window.close();
                    window.location.reload();
                },
                error: error => {
                    window.close();
                    console.log(error);
                }
            });
        }
    });
};

window.openUserTest = user_id => {
    const route = $("#txt_check_user_test_route").val();
    $.ajax({
        type: "GET",
        url: route + '/' + user_id,
        data: {},
        success: data => {
            if (data.error <= 0) {
                const route = $("#txt_generate_user_test_route").val();
                msg("Abriendo test...");
                window.open(route + '/' + user_id);
            } else {
                msg("No se encontró un test para mostrar.");
            }
        },
        error: error => {
            window.close();
            console.log(error);
        }
    });
};

window.changeProjectBinnacle = project_id => {
    if (project_id.length <= 0) {
        $("#div_alias").css("display", "block");
    } else {
        $("#div_alias").css("display", "none");
        $("#txt_alias_binnacle").val('');
    }
};



//Livewire functions

Livewire.on('showFullModal', () => {
    $("#full_modal").css('display', 'block');
});
Livewire.on('dissmisFullModal', () => {
    $("#full_modal").css('display', 'none');
});

window.createWhitdrawal = () => $("#add_sale_whitdrawal_modal").modal();