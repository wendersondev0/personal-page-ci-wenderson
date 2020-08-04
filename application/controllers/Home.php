<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $this->load->model("Projects_model", "project");
        $this->load->model("Certificates_model", "certificate");
        $projects = $this->project->show_projects();
        $certificates = $this->certificate->show_certificates();

        $data = [
            "scripts" => [
                "owl.carousel.min.js",
                "cbpAnimatedHeader.js",
                "theme-scripts.js"
            ],
            "projects" => $projects,
            "certificates" => $certificates
        ];

        $this->template->show('home', $data);
    }
}
