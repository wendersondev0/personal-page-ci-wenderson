<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Restrict extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
    }

    public function index()
    {
        if ($this->session->userdata("user_id")) { //chamar as varíaveis de sessão
            $data = [
                "styles" => [
                    "dataTables.bootstrap.min.css",
                    "datatables.min.css"
                ],
                "scripts" => [
                    "dataTables.bootstrap.min.js",
                    "datatables.min.js",
                    "sweetalert2.all.min.js",
                    "util.js",
                    "restrict.js"
                ],
                "user_id" => $this->session->userdata("user_id")
            ];
            $this->template->show("restrict", $data);
        } else {
            $data = [
                "scripts" => [
                    "util.js",
                    "login.js"
                ]
            ];

            $this->template->show('login', $data);
        }
    }

    public function logoff()
    {
        $this->session->sess_destroy();
        header("Location: " . base_url() . "restrict");
    }

    public function ajax_login()
    {
        if (!$this->input->is_ajax_request()) { //verifica se é do tipo ajax
            exit("Nenhum acesso de script permitido");
        }
        //construir uma tela

        $json = array();
        $json["status"] = 1;
        $json["error_list"] = array();

        $username = $this->input->post("username");
        $password = $this->input->post("password");

        if (empty($username)) {
            $json["status"] = 0;
            $json["error_list"]["#username"] = "Usuário não pode ser vazio!";
        } else {
            $this->load->model("users_model");
            $result = $this->users_model->get_user_data($username);
            if ($result) {
                $user_id = $result->user_id;
                $password_hash = $result->password_hash;
                if (password_verify($password, $password_hash)) {
                    $this->session->set_userdata("user_id", $user_id);
                } else {
                    $json["status"] = 0;
                }
            } else {
                $json["status"] = 0;
            }
            if ($json["status"] == 0) {
                $json["error_list"]["#btn_login"] = "Usuário e/ou senha incorretos!";
            }
        }

        echo json_encode($json);
    }

    public function ajax_import_image()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $config["upload_path"] = "./tmp/";
        $config["allowed_types"] = "gif|png|jpg";
        $config["overwrite"] = TRUE;

        $this->load->library("upload", $config);

        $json = array();
        $json["status"] = 1;

        if (!$this->upload->do_upload("image_file")) {
            $json["status"] = 0;
            $json["error"] = $this->upload->display_errors("", "");
        } else {
            if ($this->upload->data()["file_size"] <= 2048) {
                $file_name = $this->upload->data()["file_name"];
                $json["img_path"] = base_url() . "tmp/" . $file_name;
            } else {
                $json["status"] = 0;
                $json["error"] = "Arquivo não deve ser maior que 2 MB!";
            }
        }

        echo json_encode($json);
    }

    public function ajax_save_project()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;
        $json["error_list"] = array();

        $this->load->model("Projects_model", "project");

        $data = $this->input->post();

        if (empty($data["project_name"])) {
            $json["error_list"]["#project_name"] = "Nome do projeto é obrigatório!";
        } else {
            if ($this->project->is_duplicated("project_name", $data["project_name"], $data["project_id"])) {
                $json["error_list"]["#project_name"] = "Nome do projeto já existente!";
            }
        }

        $data["project_duration"] = floatval($data["project_duration"]);
        if (empty($data["project_duration"])) {
            $json["error_list"]["#project_duration"] = "Duração do projeto é obrigatório!";
        } else {
            if (!($data["project_duration"] > 0 && $data["project_duration"] < 100)) {
                $json["error_list"]["#project_duration"] = "Duração do projeto deve ser maior que 0(h) e menor que 100(h)!";
            }
        }

        if (!empty($json["error_list"])) {
            $json["status"] = 0;
        } else {
            if (!empty($data["project_img"])) {

                $file_name = basename($data["project_img"]);
                $old_path = getcwd() . "/tmp/" . $file_name;
                $new_path = getcwd() . "/public/images/projects/" . $file_name;
                rename($old_path, $new_path);

                $data["project_img"] = "/public/images/projects/" . $file_name;
            } else {
                unset($data["project_img"]);
            }

            if (empty($data["project_id"])) {
                $this->project->insert($data);
            } else {
                $project_id = $data["project_id"];
                unset($data["project_id"]);
                $this->project->update($project_id, $data);
            }
        }
        echo json_encode($json);
    }

    public function ajax_save_certificate()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;
        $json["error_list"] = array();

        $this->load->model("Certificates_model", "certificate");

        $data = $this->input->post();

        if (empty($data["certificate_title"])) {
            $json["error_list"]["#certificate_title"] = "Título do certificado é obrigatório!";
        }

        if (!empty($data["certificate_duration"])) {
            if (!($data["certificate_duration"] > 0 && $data["certificate_duration"] < 100)) {
                $json["error_list"]["#certificate_duration"] = "Duração do certificado deve ser maior que 0(h) e menor que 100(h)!";
            }
        }


        if (!empty($json["error_list"])) {
            $json["status"] = 0;
        } else {
            if (!empty($data["certificate_photo"])) {

                $file_name = basename($data["certificate_photo"]);
                $old_path = getcwd() . "/tmp/" . $file_name;
                $new_path = getcwd() . "/public/images/certificates/" . $file_name;
                rename($old_path, $new_path);

                $data["certificate_photo"] = "/public/images/certificates/" . $file_name;
            } else {
                unset($data["certificate_photo"]);
            }

            if (empty($data["certificate_id"])) {
                $this->certificate->insert($data);
            } else {
                $certificate_id = $data["certificate_id"];
                unset($data["certificate_id"]);
                $this->certificate->update($certificate_id, $data);
            }
        }
        echo json_encode($json);
    }

    public function ajax_save_user()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;
        $json["error_list"] = array();

        $this->load->model("Users_model", "user");

        $data = $this->input->post();

        if (empty($data["user_login"])) {
            $json["error_list"]["#user_login"] = "Login é obrigatório!";
        } else {
            if ($this->user->is_duplicated("user_login", $data["user_login"], $data["user_id"])) {
                $json["error_list"]["#user_login"] = "Login já existente!";
            }
        }

        if (empty($data["user_full_name"])) {
            $json["error_list"]["#user_full_name"] = "Nome Completo é obrigatório!";
        }

        if (empty($data["user_email"])) {
            $json["error_list"]["#user_email"] = "E-mail é obrigatório!";
        } else {
            if ($this->user->is_duplicated("user_email", $data["user_email"], $data["user_id"])) {
                $json["error_list"]["#user_email"] = "E-mail já existente!";
            } else {
                if ($data["user_email"] != $data["user_email_confirm"]) {
                    $json["error_list"]["#user_email"] = "";
                    $json["error_list"]["#user_email_confirm"] = "E-mails não conferem!";
                }
            }
        }

        if (empty($data["user_password"])) {
            $json["error_list"]["#user_password"] = "Senha é obrigatório!";
        } else {
            if ($data["user_password"] != $data["user_password_confirm"]) {
                $json["error_list"]["#user_password"] = "";
                $json["error_list"]["#user_password_confirm"] = "Senhas não conferem!";
            }
        }

        if (!empty($json["error_list"])) {
            $json["status"] = 0;
        } else {
            $data["password_hash"] = password_hash($data["user_password"], PASSWORD_DEFAULT);
            unset($data["user_password"]);
            unset($data["user_password_confirm"]);
            unset($data["user_email_confirm"]);

            if (empty($data["user_id"])) {
                $this->user->insert($data);
            } else {
                $user_id = $data["user_id"];
                unset($data["user_id"]);
                $this->user->update($user_id, $data);
            }
        }
        echo json_encode($json);
    }

    public function ajax_get_user_data()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;
        $json["input"] = [];

        $this->load->model("Users_model", "user");

        $user_id = $this->input->post("user_id");
        $data =  $this->user->get_data($user_id)->result_array()[0];
        $json["input"]["user_id"] = $data["user_id"];
        $json["input"]["user_login"] = $data["user_login"];
        $json["input"]["user_full_name"] = $data["user_full_name"];
        $json["input"]["user_email"] = $data["user_email"];
        $json["input"]["user_email_confirm"] = $data["user_email"];
        $json["input"]["user_password"] = '';
        $json["input"]["user_password_confirm"] = '';

        echo json_encode($json);
    }


    public function ajax_get_project_data()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;
        $json["input"] = [];

        $this->load->model("Projects_model", "project");

        $project_id = $this->input->post("project_id");
        $data =  $this->project->get_data($project_id)->result_array()[0];
        $json["input"]["project_id"] = $data["project_id"];
        $json["input"]["project_name"] = $data["project_name"];
        $json["input"]["project_duration"] = $data["project_duration"];
        $json["input"]["project_stacks"] = $data["project_stacks"];
        $json["input"]["project_description"] = $data["project_description"];
        if (!empty($data["project_img"]))
            $data["project_img"] = base_url() . $data["project_img"];
        $json["img"]["project_img_path"] = $data["project_img"];

        echo json_encode($json);
    }

    public function ajax_get_certificate_data()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;
        $json["input"] = [];

        $this->load->model("Certificates_model", "certificate");

        $certificate_id = $this->input->post("certificate_id");
        $data =  $this->certificate->get_data($certificate_id)->result_array()[0];
        $json["input"]["certificate_id"] = $data["certificate_id"];
        $json["input"]["certificate_title"] = $data["certificate_title"];
        $json["input"]["certificate_description"] = $data["certificate_description"];
        $json["input"]["certificate_duration"] = $data["certificate_duration"];
        if (!empty($data["certificate_photo"]))
            $data["certificate_photo"] = base_url() . $data["certificate_photo"];
        $json["img"]["certificate_photo_path"] = $data["certificate_photo"];


        echo json_encode($json);
    }

    public function ajax_delete_project_data()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;


        $this->load->model("Projects_model", "project");

        $project_id = $this->input->post("project_id");
        $this->project->delete($project_id);

        echo json_encode($json);
    }
    public function ajax_delete_certificate_data()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;


        $this->load->model("Certificates_model", "certificate");

        $certificate_id = $this->input->post("certificate_id");
        $this->certificate->delete($certificate_id);

        echo json_encode($json);
    }

    public function ajax_delete_user_data()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;


        $this->load->model("Users_model", "user");

        $user_id = $this->input->post("user_id");
        $this->user->delete($user_id);

        echo json_encode($json);
    }

    public function ajax_list_project()
    {
        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $this->load->model("Projects_model", "project");
        $projects = $this->project->get_datatable();

        $data = [];

        foreach ($projects as $project) {
            $row = [];
            $row[] = $project->project_name;

            if ($project->project_img) {
                $row[] = '<img src="' . base_url() . $project->project_img . '" style="max-height: 100px; max-width: 100px;">';
            } else {
                $row[] = "";
            }
            $row[] = $project->project_duration;
            $row[] = '<div class="description">' . $project->project_description . '</div>';
            $row[] = '<div class="description">' . $project->project_stacks . '</div>';

            $row[] = '<div style="display: inline-block;">
                        <button 
                            class="btn btn-primary btn-edit-project"
                            project_id="' . $project->project_id . '">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button 
                            class="btn btn-danger btn-del-project"
                            project_id="' . $project->project_id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>';

            $data[] = $row;
        }

        $json = [
            "draw" => $this->input->post("draw"),
            "recordsTotal" => $this->project->records_total(),
            "recordsFiltered" => $this->project->records_filtered(),
            "data" => $data
        ];
        echo json_encode($json);
    }

    public function ajax_list_certificate()
    {
        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $this->load->model("certificates_model", "certificate");
        $certificates = $this->certificate->get_datatable();

        $data = [];

        foreach ($certificates as $certificate) {
            $row = [];
            $row[] = $certificate->certificate_title;

            if ($certificate->certificate_photo) {
                $row[] = '<img src="' . base_url() . $certificate->certificate_photo . '" style="max-height: 100px; max-width: 100px;">';
            } else {
                $row[] = "";
            }
            $row[] = '<div class="description">' . $certificate->certificate_description . '</div>';
            $row[] = $certificate->certificate_duration;

            $row[] = '<div style="display: inline-block;">
                        <button 
                            class="btn btn-primary btn-edit-certificate"
                            certificate_id="' . $certificate->certificate_id . '">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button 
                            class="btn btn-danger btn-del-certificate"
                            certificate_id="' . $certificate->certificate_id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>';

            $data[] = $row;
        }

        $json = [
            "draw" => $this->input->post("draw"),
            "recordsTotal" => $this->certificate->records_total(),
            "recordsFiltered" => $this->certificate->records_filtered(),
            "data" => $data
        ];
        echo json_encode($json);
    }

    public function ajax_list_user()
    {
        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $this->load->model("users_model", "user");
        $users = $this->user->get_datatable();

        $data = [];

        foreach ($users as $user) {
            $row = [];
            $row[] = $user->user_login;
            $row[] = $user->user_full_name;
            $row[] = $user->user_email;

            $row[] = '<div style="display: inline-block;">
                        <button 
                            class="btn btn-primary btn-edit-user"
                            user_id="' . $user->user_id . '">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button 
                            class="btn btn-danger btn-del-user"
                            user_id="' . $user->user_id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>';

            $data[] = $row;
        }

        $json = [
            "draw" => $this->input->post("draw"),
            "recordsTotal" => $this->user->records_total(),
            "recordsFiltered" => $this->user->records_filtered(),
            "data" => $data
        ];
        echo json_encode($json);
    }
}
