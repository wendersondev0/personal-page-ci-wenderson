-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Ago-2020 às 04:40
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `personal-page-ci`
--
CREATE DATABASE IF NOT EXISTS `personal-page-ci` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `personal-page-ci`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `certificates`
--

CREATE TABLE `certificates` (
  `certificate_id` int(11) NOT NULL,
  `certificate_title` varchar(100) NOT NULL,
  `certificate_photo` varchar(199) DEFAULT NULL,
  `certificate_description` text DEFAULT NULL,
  `certificate_duration` decimal(3,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `certificates`
--

INSERT INTO `certificates` (`certificate_id`, `certificate_title`, `certificate_photo`, `certificate_description`, `certificate_duration`) VALUES
(23, 'Crud com Bootstrap', '/public/images/certificates/UC-dc9d6f0b-2821-431d-9884-f3ce89d43f05.jpg', 'Certificado do curso de Crud(Create, Read, Update e Delete) com Bootstrap da <a href=\"https://www.udemy.com/\" target=\"_blank\"><img class=\"link_thumb\" src=\"\" title=\"\">Udemy</a>.', '10.0'),
(24, 'PHP orientado a objetos', '/public/images/certificates/Certificado_RL_System_-_Curso_de_PHP_Orientado_a_Objetos_Online.png', 'Certificado do curso de PHP orientado a objetos online da <a href=\"https://www.rlsystem.com.br/\" target=\"_blank\"><img class=\"link_thumb\" src=\"\" title=\"\">RL System</a>.', '10.0'),
(25, 'PHP com MVC ', '/public/images/certificates/Certificado_RL_System_-_Curso_de_PHP_com_MVC_Online.png', 'Certificado de um curso de PHP com MVC(model, view e control) da <a href=\"https://www.rlsystem.com.br/\" target=\"_blank\"><img class=\"link_thumb\" src=\"\" title=\"\">RL System</a>.', '10.0'),
(26, 'CodeIgniter', '/public/images/certificates/curso_de_codeigniter.jpg', 'Certificado do curso CodeIgniter: Criando Websites Profissionais com PHP <a href=\"https://www.udemy.com/\" target=\"_blank\"><img class=\"link_thumb\" src=\"\" title=\"\">Udemy</a>.', '6.5'),
(27, 'PHP fundamentos Online', '/public/images/certificates/Certificado_RL_System_-_Curso_de_PHP_Fundamentos_Online.png', '', '10.0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_img` varchar(100) DEFAULT NULL,
  `project_duration` decimal(3,1) NOT NULL,
  `project_stacks` varchar(100) DEFAULT NULL,
  `project_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_img`, `project_duration`, `project_stacks`, `project_description`) VALUES
(173, 'Site pessoal com CodeIgniter', '/public/images/projects/codeigniter_wallpaper_by_benrivero_d2jb1uy-fullview.jpg', '10.0', 'CodeIgniter, PHP, JS, CSS, HTML', 'Esse é um site pessoal feito com o framework chamado CodeIgniter, ele foi feito como um aprimoramento de um curso da udemy chamado <a href=\"https://www.udemy.com/course/codeigniter-php/\" target=\"_blank\"><img class=\"link_thumb\" src=\"\" title=\"\">CodeIgniter: Criando websites Profissionais PHP </a>'),
(174, 'Projeto da semana next level week da Rocketseat', '/public/images/projects/next.jpg', '1.0', 'React, React native, Typescript, nodeJS', 'Este é um projeto realizado na semana de desenvolvimento de um projeto da Rocketseat chamada next level week.'),
(175, 'Projeto da semana omnistack rocketseat', '/public/images/projects/omnistack-wallpaper-1920x1080.png', '10.0', 'Javascriot, React e React native', 'Este é um projeto realizado na semana de desenvolvimento de um projeto da Rocketseat chamada semana omnistack.'),
(176, 'Projeto da semana next level week da Rocketseat 2', '/public/images/projects/banner.png', '5.0', 'React, React native, Typescript, nodeJS e expo', 'Este é um projeto realizado na semana de desenvolvimento de um projeto da Rocketseat chamada next level week edição 2.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `user_full_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `password_hash`, `user_full_name`, `user_email`) VALUES
(1, 'admin', '$2y$10$/HWMY24WUFIcqgRW9X1ObOQrj0cCA8joP9m158A.dHe8wAf17JXHW', 'personal-page-ci', 'personal-page-ci-admin@personal-page-ci-admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`certificate_id`);

--
-- Índices para tabela `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `certificates`
--
ALTER TABLE `certificates`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
