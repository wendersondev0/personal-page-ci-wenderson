<section style="min-height: calc(100vh - 83px);" class="light-bg">
    <div class="container">

        <div class="row">
            <div class="col-lg-offset-3 col-lg-6 text-center">
                <div class="section-title">
                    <h2>ÁREA RESTRITA</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-offset-5 col-lg-2 text-center">
                <div class="form-group">
                    <a id="btn_your_user" class="btn btn-link" user_id="<?= $user_id ?>""><i class=" fa fa-user"></i></a>
                    <a class="btn btn-link" href="restrict/logoff"><i class="fa fa-sign-out"></i></a>
                </div>
            </div>
        </div>

        <div class="container">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_projects" role="tab" data-toggle="tab">Projetos</a>
                </li>
                <li>
                    <a href="#tab_certificados" role="tab" data-toggle="tab">Certificados</a>
                </li>
                <li>
                    <a href="#tab_user" role="tab" data-toggle="tab">Usuários</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab_projects" class="tab-pane active">
                    <div class="container-fluid">
                        <h2 class="text-center"><strong>Gerenciar Projetos</strong></h2>
                        <a id="btn_add_project" class="btn btn-primary" style="margin-bottom: 10px;"><i class="fa fa-plus">&nbsp; &nbsp;Adicionar projeto</i></a>
                        <table id="dt_projects" class="table table-striped table-bordered">
                            <thead>
                                <tr class="tableheader">
                                    <th class="dt-center">Nome</th>
                                    <th class="dt-center no-sort">Imagem</th>
                                    <th class="dt-center">Duração</th>
                                    <th class="no-sort">Descrição</th>
                                    <th class="no-sort">Tecnologias</th>
                                    <th class="dt-center no-sort">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="tab_certificados" class="tab-pane">
                    <div class="container-fluid">
                        <h2 class="text-center"><strong>Gerenciar Certificados</strong></h2>
                        <a id="btn_add_certificate" class="btn btn-primary" style="margin-bottom: 10px;"><i class="fa fa-plus">&nbsp; &nbsp;Adicionar Certificados</i></a>
                        <table id="dt_certificates" class="table table-striped table-bordered">
                            <thead>
                                <tr class="tableheader">
                                    <th class="dt-center">Título</th>
                                    <th class="dt-center no-sort">Foto</th>
                                    <th class="no-sort">Descrição</th>
                                    <th class="dt-center">Duração</th>
                                    <th class="dt-center no-sort">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="tab_user" class="tab-pane">
                    <div class="container-fluid">
                        <h2 class="text-center"><strong>Gerenciar Usuários</strong></h2>
                        <a id="btn_add_user" class="btn btn-primary" style="margin-bottom: 10px;"><i class="fa fa-plus">&nbsp; &nbsp;Adicionar Usuários</i></a>
                        <table id="dt_users" class="table table-striped table-bordered">
                            <thead>
                                <tr class="tableheader">
                                    <th>Login</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /.container -->
</section>

<div id="modal_project" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close text-danger"></i></button>
                <h4 class="modal-title">Projetos</h4>
            </div>
            <div class="modal-body">
                <form id="form_project">
                    <input id="project_id" name="project_id" hidden>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nome</label>
                        <div class="col-lg-10">
                            <input id="project_name" name="project_name" class="form-control" maxlength="100">
                            <span class="help-block"></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 control-label">Imagem</label>

                        <div class="col-lg-10">
                            <img id="project_img_path" src="" style="max-height: 400px; max-height: 400px;">
                            <label class="btn btn-block btn-info">
                                <i class="fa fa-upload"></i>&nbsp;&nbsp; Importar imagem
                                <input type="file" id="btn_upload_project_img" accept="image/*" style="display: none;">
                            </label>
                            <input id="project_img" name="project_img" hidden>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Duração (h)</label>
                        <div class="col-lg-10">
                            <input type="number" step="0.1" id="project_duration" name="project_duration" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Conhecimentos</label>
                        <div class="col-lg-10">
                            <input id="project_stacks" name="project_stacks" class="form-control" maxlength="100">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Descrição</label>
                        <div class="col-lg-10">
                            <textarea id="project_description" name="project_description" class="form-control"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" id="btn_save_project" class="btn btn-primary">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
                        </button>
                        <span class="help-block"></span>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>



<div id="modal_certificate" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close text-danger"></i></button>
                <h4 class="modal-title">Certificados</h4>
            </div>
            <div class="modal-body">
                <form id="form_certificate">
                    <input id="certificate_id" name="certificate_id" hidden>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Título</label>
                        <div class="col-lg-10">
                            <input id="certificate_title" name="certificate_title" class="form-control" maxlength="100">
                            <span class="help-block"></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 control-label">Foto do certificado</label>

                        <div class="col-lg-10">
                            <img id="certificate_photo_path" src="" style="max-height: 400px; max-width: 400px;">
                            <label class="btn btn-block btn-info">
                                <i class="fa fa-upload"></i>&nbsp;&nbsp; Importar Foto
                                <input type="file" id="btn_upload_certificate_photo" accept="image/*" style="display: none;">
                            </label>
                            <input id="certificate_photo" name="certificate_photo" hidden>
                            <span class="help-block"></span>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-lg-2 control-label">Duração (h)</label>
                        <div class="col-lg-10">
                            <input type="number" step="0.1" id="certificate_duration" name="certificate_duration" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Descrição</label>
                        <div class="col-lg-10">
                            <textarea id="certificate_description" name="certificate_description" class="form-control"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" id="btn_save_certificate" class="btn btn-primary">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
                        </button>
                        <span class="help-block"></span>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>


<div id="modal_user" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close text-danger"></i></button>
                <h4 class="modal-title">Usuários</h4>
            </div>
            <div class="modal-body">
                <form id="form_user">
                    <input id="user_id" name="user_id" hidden>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Login</label>
                        <div class="col-lg-10">
                            <input id="user_login" name="user_login" class="form-control" maxlength="30">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nome completo</label>
                        <div class="col-lg-10">
                            <input id="user_full_name" name="user_full_name" class="form-control" maxlength="100">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">E-mail</label>
                        <div class="col-lg-10">
                            <input type="email" id="user_email" name="user_email" class="form-control" maxlength="100">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Confirmar E-mail</label>
                        <div class="col-lg-10">
                            <input type="email" id="user_email_confirm" name="user_email_confirm" class="form-control" maxlength="100">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Senha</label>
                        <div class="col-lg-10">
                            <input type="password" id="user_password" name="user_password" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Confirmar Senha</label>
                        <div class="col-lg-10">
                            <input type="password" id="user_password_confirm" name="user_password_confirm" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" id="btn_save_user" class="btn btn-primary">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
                        </button>
                        <span class="help-block"></span>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>