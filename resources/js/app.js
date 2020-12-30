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

/*++ Start JqueryReady ++*/
jQuery(() => {
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
    /*
    jQuery('.date_mask').datetimepicker({
        timepicker:false,
        mask:false,
        formatDate:'Y-m-d',
    });
    */
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
    ReactDOM.render(
        <ShowProjectModal
            route={route}
            project_id={project_id}
            user_id={user_id}
            rol_user_id={rol_user_id}
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
    ReactDOM.render(
        <ShowTaskModal route={route} task_id={task_id} />,
        document.getElementById(element_id)
    );
    $("#" + modal_id).modal();
};
window.showUserModal = user_id => {
    const route = $("#txt_show_user_route_ajax").val();
    const element_id = "show_user_modal_render";
    const modal_id = "show_user_modal";
    ReactDOM.unmountComponentAtNode(document.getElementById(element_id));
    ReactDOM.render(
        <ShowUserModal route={route} user_id={user_id} />,
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
        text:
            "Esta tarea se podrá visualizar posteriórmente desde la vista de tareas archivadas.",
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
        text:
            "Esta acción eliminará todo el registro incluyendo los registros ligados a este y el cambio no se podrá deshacer.",
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
    ReactDOM.render(
        <IndexCommentTask route={route} task_id={task_id} />,
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
        titleText: "Poocesando peticion...",
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
                $("#CompanyFollowBox").animate(
                    { scrollTop: $(document).height() * 10000 },
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
                $("#CompanyFollowBox").animate(
                    { scrollTop: $(document).height() * 10000 },
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
            window.location = route+'/'+product_id;
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
            window.location = route+'/'+id;
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
            window.location = route+'/'+sale_id;
        }
    });
};

window.changeCommision = (commision_percent,sale_id) => {
    let route = $("#txt_change_commision_route").val();
    $.ajax({
        'type': 'GET',
        'url': route,
        'data': {
            commision_percent:commision_percent,
            sale_id:sale_id
        },
        success: data => { 
            window.location.reload();
        },
        error: error => console.log(error)
    });
};