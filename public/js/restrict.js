$(function() {
    $("#btn_add_project").click(function() {
        clearErrors();
        $('#form_project')[0].reset();
        $('#project_img_path').attr("src", "");
        $('#modal_project').modal();
    });

    $("#btn_add_certificate").click(function() {
        clearErrors();
        $('#form_certificate')[0].reset();
        $('#certificate_photo_path').attr("src", "");
        $('#modal_certificate').modal();
    });

    $("#btn_add_user").click(function() {
        clearErrors();
        $('#form_user')[0].reset();
        $('#modal_user').modal();
    });

    $("#btn_upload_project_img").change(function() {
        uploadImg($(this), $("#project_img_path"), $("#project_img"));
    });

    $("#btn_upload_certificate_photo").change(function() {
        uploadImg($(this), $("#certificate_photo_path"), $("#certificate_photo"));
    });

    $('#form_project').submit(function() {
        $.ajax({
            type: "post",
            url: BASE_URL + "restrict/ajax_save_project",
            dataType: "json",
            data: $(this).serialize(),
            beforeSend: function() {
                clearErrors();
                $("#btn_save_project").siblings(".help-block").html(loadingImg("Verificando..."));
            },
            success: function(response) {
                clearErrors();
                if (response["status"]) {
                    $('#modal_project').modal("hide");
                    swal("Sucesso!", "Projeto salvo com sucesso!", "success");
                    dt_project.ajax.reload();
                } else {
                    showErrorsModal(response["error_list"]);
                }
            },
            error: function() {
                alert("erro, ocorreu um erro inesperado");
            }

        })

        return false;
    });

    $('#form_certificate').submit(function() {
        $.ajax({
            type: "post",
            url: BASE_URL + "restrict/ajax_save_certificate",
            dataType: "json",
            data: $(this).serialize(),
            beforeSend: function() {
                clearErrors();
                $("#btn_save_certificate").siblings(".help-block").html(loadingImg("Verificando..."));
            },
            success: function(response) {
                clearErrors();
                if (response["status"]) {
                    $('#modal_certificate').modal("hide");
                    swal("Sucesso!", "Certificado salvo com sucesso!", "success");
                    dt_certificate.ajax.reload();
                } else {
                    showErrorsModal(response["error_list"]);
                }
            },
            error: function() {
                alert("erro, ocorreu um erro inesperado");
            }

        })

        return false;
    });

    $('#form_user').submit(function() {
        $.ajax({
            type: "post",
            url: BASE_URL + "restrict/ajax_save_user",
            dataType: "json",
            data: $(this).serialize(),
            beforeSend: function() {
                clearErrors();
                $("#btn_save_user").siblings(".help-block").html(loadingImg("Verificando..."));
            },
            success: function(response) {
                clearErrors();
                if (response["status"]) {
                    $('#modal_user').modal("hide");
                    swal("Sucesso!", "Usuário salvo com sucesso!", "success");
                    dt_user.ajax.reload();
                } else {
                    showErrorsModal(response["error_list"]);
                }
            },
            error: function() {
                alert("erro, ocorreu um erro inesperado");
            }

        })

        return false;
    });

    $('#btn_your_user').click(function() {
        $.ajax({
            type: "post",
            url: BASE_URL + "restrict/ajax_get_user_data",
            dataType: "json",
            data: {
                "user_id": $(this).attr("user_id")
            },
            success: function(response) {
                clearErrors();
                $('#form_user')[0].reset();
                $.each(response["input"], function(id, value) {
                    $("#" + id).val(value);
                });
                $('#modal_user').modal();

            },
            error: function() {
                alert("erro, ocorreu um erro inesperado");
            }

        })

        return false;
    });


    function active_btn_project() {
        $('.btn-edit-project').click(function() {
            $.ajax({
                type: "post",
                url: BASE_URL + "restrict/ajax_get_project_data",
                dataType: "json",
                data: {
                    "project_id": $(this).attr("project_id")
                },
                success: function(response) {
                    clearErrors();
                    $('#form_project')[0].reset();
                    $.each(response["input"], function(id, value) {
                        $("#" + id).val(value);
                    });
                    $("#project_img_path").attr("src", response["img"]["project_img_path"]);

                    $('#modal_project').modal();

                },
                error: function() {
                    alert("erro, ocorreu um erro inesperado");
                }

            })
        });

        $('.btn-del-project').click(function() {
            var project_id = $(this);
            swal({
                title: "Atenção!",
                text: "Deseja deletar esse curso?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d9534f",
                confirmButtonText: "Sim",
                cancelButtontext: "Não",
                closeOnConfirm: true,
                closeOnCancel: true,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: BASE_URL + "restrict/ajax_delete_project_data",
                        dataType: "json",
                        data: {
                            "project_id": project_id.attr("project_id")
                        },
                        success: function(response) {
                            swal("Sucesso!", "Ação executada com sucesso", "success");
                            dt_project.ajax.reload();
                        },
                        error: function() {
                            alert("erro, ocorreu um erro inesperado");
                        }
                    })
                }
            })
        });
    }

    function active_btn_certificate() {
        $('.btn-edit-certificate').click(function() {
            $.ajax({
                type: "post",
                url: BASE_URL + "restrict/ajax_get_certificate_data",
                dataType: "json",
                data: {
                    "certificate_id": $(this).attr("certificate_id")
                },
                success: function(response) {
                    clearErrors();
                    $('#form_certificate')[0].reset();
                    $.each(response["input"], function(id, value) {
                        $("#" + id).val(value);
                    });
                    $("#certificate_photo_path").attr("src", response["img"]["certificate_photo_path"]);
                    $('#modal_certificate').modal();

                },
                error: function() {
                    alert("erro, ocorreu um erro inesperado");
                }

            })

            return false;
        });

        $('.btn-del-certificate').click(function() {
            var certificate_id = $(this);
            swal({
                title: "Atenção!",
                text: "Deseja deletar esse certificado?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d9534f",
                confirmButtonText: "Sim",
                cancelButtontext: "Não",
                closeOnConfirm: true,
                closeOnCancel: true,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: BASE_URL + "restrict/ajax_delete_certificate_data",
                        dataType: "json",
                        data: {
                            "certificate_id": certificate_id.attr("certificate_id")
                        },
                        success: function(response) {
                            swal("Sucesso!", "Ação executada com sucesso", "success");
                            dt_certificate.ajax.reload();
                        }
                    })
                }
            })
        });
    }

    function active_btn_user() {
        $('.btn-edit-user').click(function() {
            $.ajax({
                type: "post",
                url: BASE_URL + "restrict/ajax_get_user_data",
                dataType: "json",
                data: {
                    "user_id": $(this).attr("user_id")
                },
                success: function(response) {
                    clearErrors();
                    $('#form_user')[0].reset();
                    $.each(response["input"], function(id, value) {
                        $("#" + id).val(value);
                    });
                    $('#modal_user').modal();
                },
                error: function() {
                    alert("erro, ocorreu um erro inesperado");
                }
            })
        });


        $('.btn-del-user').click(function() {
            var user_id = $(this);
            swal({
                title: "Atenção!",
                text: "Deseja deletar esse Usuário?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d9534f",
                confirmButtonText: "Sim",
                cancelButtontext: "Não",
                closeOnConfirm: true,
                closeOnCancel: true,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: BASE_URL + "restrict/ajax_delete_user_data",
                        dataType: "json",
                        data: {
                            "user_id": user_id.attr("user_id")
                        },
                        success: function(response) {
                            swal("Sucesso!", "Ação executada com sucesso", "success");
                            dt_user.ajax.reload();
                        },
                        error: function() {
                            alert("erro, ocorreu um erro inesperado");
                        }
                    })
                }
            })
        });
    }

    var dt_project = $("#dt_projects").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": BASE_URL + "restrict/ajax_list_project",
            "type": "post",
        },
        "columnDefs": [
            { targets: "no-sort", orderable: false },
            { targets: "dt-center", className: "dt-center" }
        ],
        "drawCallback": function() {
            active_btn_project();
        }
    });

    var dt_certificate = $("#dt_certificates").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": BASE_URL + "restrict/ajax_list_certificate",
            "type": "post",
        },
        "columnDefs": [
            { targets: "no-sort", orderable: false },
            { targets: "dt-center", className: "dt-center" }
        ],
        "drawCallback": function() {
            active_btn_certificate();
        }
    });

    var dt_user = $("#dt_users").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": BASE_URL + "restrict/ajax_list_user",
            "type": "post",
        },
        "columnDefs": [
            { targets: "no-sort", orderable: false },
            { targets: "dt-center", className: "dt-center" }
        ],
        "drawCallback": function() {
            active_btn_user();
        }
    });

});