-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Maio-2021 às 19:20
-- Versão do servidor: 10.4.16-MariaDB
-- versão do PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aveia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anoslectivos`
--

CREATE TABLE `anoslectivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ya_inicio` year(4) NOT NULL,
  `ya_fim` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `anoslectivos`
--

INSERT INTO `anoslectivos` (`id`, `ya_inicio`, `ya_fim`, `created_at`, `updated_at`) VALUES
(1, 2020, 2021, '2021-05-21 14:23:01', '2021-05-21 14:23:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cabecalhos`
--

CREATE TABLE `cabecalhos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_ensignia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_escola` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_acronimo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_nif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_republica` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_ministerio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_endereco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_telefone` int(11) NOT NULL,
  `vc_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_nomeDirector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cabecalhos`
--

INSERT INTO `cabecalhos` (`id`, `vc_ensignia`, `vc_logo`, `vc_escola`, `vc_acronimo`, `vc_nif`, `vc_republica`, `vc_ministerio`, `vc_endereco`, `it_telefone`, `vc_email`, `vc_nomeDirector`, `created_at`, `updated_at`) VALUES
(1, 'logo', 'logo', 'Escola de Formação de Técnicos de Saúde', 'EFTS', '00454564568453132', 'República de Angola', 'Ministério da Educação', 'Uige', 922555555, 'tecni@te.com', 'Adalberto Cabenge', '2021-05-21 14:04:16', '2021-05-21 14:04:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_classe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `classes`
--

INSERT INTO `classes` (`id`, `vc_classe`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, '10', 1, '2021-05-21 14:18:13', '2021-05-21 14:18:13'),
(2, '11', 1, '2021-05-21 14:18:28', '2021-05-21 14:18:28'),
(3, '12', 1, '2021-05-21 14:18:36', '2021-05-21 14:18:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe_disciplinas`
--

CREATE TABLE `classe_disciplinas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classe_id` bigint(20) UNSIGNED NOT NULL,
  `disciplina_id` bigint(20) UNSIGNED NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `classe_disciplinas`
--

INSERT INTO `classe_disciplinas` (`id`, `classe_id`, `disciplina_id`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2021-05-21 14:20:47', '2021-05-21 14:20:47'),
(2, 2, 2, 1, '2021-05-21 14:21:57', '2021-05-21 14:21:57'),
(3, 2, 3, 1, '2021-05-21 14:22:05', '2021-05-21 14:22:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dias_semanas`
--

CREATE TABLE `dias_semanas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_dia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `dias_semanas`
--

INSERT INTO `dias_semanas` (`id`, `vc_dia`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 'Segunda-Feira', 1, '2021-05-21 14:04:16', '2021-05-21 14:04:16'),
(2, 'Terça-Feira', 1, '2021-05-21 14:04:16', '2021-05-21 14:04:16'),
(3, 'Quarta-Feira', 1, '2021-05-21 14:04:16', '2021-05-21 14:04:16'),
(4, 'Quinta-Feira', 1, '2021-05-21 14:04:16', '2021-05-21 14:04:16'),
(5, 'Sexta-Feira', 1, '2021-05-21 14:04:16', '2021-05-21 14:04:16'),
(6, 'Sábado', 1, '2021-05-21 14:04:16', '2021-05-21 14:04:16'),
(7, 'Domingo', 1, '2021-05-21 14:04:16', '2021-05-21 14:04:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_disciplina` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_imagem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `disciplinas`
--

INSERT INTO `disciplinas` (`id`, `vc_disciplina`, `vc_imagem`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 'EMC', 'disciplinas/1619012021052160a7dd75ec759.jpg', 1, '2021-05-21 14:19:02', '2021-05-21 14:19:02'),
(2, 'Electrónica', 'disciplinas/1619412021052160a7dd9d6bd65.png', 1, '2021-05-21 14:19:41', '2021-05-21 14:19:41'),
(3, 'Programação', 'disciplinas/1620142021052160a7ddbe089dc.png', 1, '2021-05-21 14:20:14', '2021-05-21 14:20:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escolas`
--

CREATE TABLE `escolas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_escola` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_num_ide` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_localizacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_id_provincia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_id_minicipio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_director` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_id_utilizador` bigint(20) UNSIGNED NOT NULL,
  `dt_data_registro` date NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `escolas`
--

INSERT INTO `escolas` (`id`, `vc_escola`, `vc_logo`, `vc_num_ide`, `vc_localizacao`, `it_id_provincia`, `it_id_minicipio`, `vc_director`, `vc_email`, `vc_senha`, `it_id_utilizador`, `dt_data_registro`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 'Instituto de Telecomunicações', 'logoEscola/1617312021052160a7dd1bc01e8.png', 'r3', 'angola', 'luanda', 'Talatona', 'júlio barros', 'itel@gmail.com', '$2y$10$3mDxF4bdtHguPG.AtKlJVO3OHPWIh4DS58VdR1sledLdpkGt4Lw2y', 1, '2021-05-21', 1, '2021-05-21 14:17:32', '2021-05-21 14:17:32');

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_escolas`
--

CREATE TABLE `funcionario_escolas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `it_id_utilizador` bigint(20) UNSIGNED NOT NULL,
  `it_id_escola` bigint(20) UNSIGNED NOT NULL,
  `it_id_classedisciplina` bigint(20) UNSIGNED NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `funcionario_escolas`
--

INSERT INTO `funcionario_escolas` (`id`, `it_id_utilizador`, `it_id_escola`, `it_id_classedisciplina`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, 1, '2021-05-21 14:25:38', '2021-05-21 14:25:38'),
(2, 3, 1, 2, 1, '2021-05-21 14:27:46', '2021-05-21 14:27:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gabaritos`
--

CREATE TABLE `gabaritos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_gabarito` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_descricao_gabarito` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_id_tarefas` bigint(20) UNSIGNED NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `gabaritos`
--

INSERT INTO `gabaritos` (`id`, `vc_gabarito`, `vc_descricao_gabarito`, `it_id_tarefas`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 'Gabarito/1420482021052460abb64090fa4.pdf', 'Gabarito 2 de eletrónica', 2, 1, '2021-05-24 12:20:49', '2021-05-24 12:20:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarios`
--

CREATE TABLE `horarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `it_id_classedisciplina` bigint(20) UNSIGNED NOT NULL,
  `vc_hora_inicio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_hora_fim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_id_dias` bigint(20) UNSIGNED NOT NULL,
  `it_id_anoslectivos` bigint(20) UNSIGNED NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `horarios`
--

INSERT INTO `horarios` (`id`, `it_id_classedisciplina`, `vc_hora_inicio`, `vc_hora_fim`, `it_id_dias`, `it_id_anoslectivos`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 1, '19:04', '21:04', 1, 1, 1, '2021-05-21 15:04:39', '2021-05-21 15:04:39'),
(2, 2, '19:13', '23:13', 2, 1, 1, '2021-05-21 15:13:16', '2021-05-21 15:13:16'),
(3, 3, '16:07', '18:07', 4, 1, 1, '2021-05-24 11:07:45', '2021-05-24 11:07:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `horas`
--

CREATE TABLE `horas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_hora_inicio` time NOT NULL,
  `vc_hora_fim` time NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `it_idUser` bigint(20) UNSIGNED NOT NULL,
  `vc_descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`id`, `it_idUser`, `vc_descricao`, `created_at`, `updated_at`) VALUES
(1, 1, 'Adicionou um Utilizador', '2021-05-21 14:15:55', '2021-05-21 14:15:55'),
(2, 1, 'Adicionou Escola', '2021-05-21 14:17:32', '2021-05-21 14:17:32'),
(3, 1, 'Adicionou Classe', '2021-05-21 14:18:14', '2021-05-21 14:18:14'),
(4, 1, 'Adicionou Classe', '2021-05-21 14:18:28', '2021-05-21 14:18:28'),
(5, 1, 'Adicionou Classe', '2021-05-21 14:18:36', '2021-05-21 14:18:36'),
(6, 1, 'Adicionou Disciplina', '2021-05-21 14:19:02', '2021-05-21 14:19:02'),
(7, 1, 'Adicionou Disciplina', '2021-05-21 14:19:41', '2021-05-21 14:19:41'),
(8, 1, 'Adicionou Disciplina', '2021-05-21 14:20:14', '2021-05-21 14:20:14'),
(9, 1, 'Atribui Disciplina a uma classe', '2021-05-21 14:20:47', '2021-05-21 14:20:47'),
(10, 1, 'Atribui Disciplina a uma classe', '2021-05-21 14:21:58', '2021-05-21 14:21:58'),
(11, 1, 'Atribui Disciplina a uma classe', '2021-05-21 14:22:05', '2021-05-21 14:22:05'),
(12, 1, 'Adicionou  Ano Lectivo', '2021-05-21 14:23:01', '2021-05-21 14:23:01'),
(13, 1, 'Actualizou um Utilizador', '2021-05-21 14:24:03', '2021-05-21 14:24:03'),
(14, 1, 'Adicionou um Utilizador', '2021-05-21 14:26:32', '2021-05-21 14:26:32'),
(15, 1, 'Actualizou um Utilizador', '2021-05-21 14:27:20', '2021-05-21 14:27:20'),
(16, 5, 'Escreveu Filho', '2021-05-21 14:44:40', '2021-05-21 14:44:40'),
(17, 5, 'Escreveu Filho', '2021-05-21 14:56:46', '2021-05-21 14:56:46'),
(18, 5, 'Adicionou uma Matrícula', '2021-05-21 15:02:06', '2021-05-21 15:02:06'),
(19, 5, 'Adicionou uma Matrícula', '2021-05-21 15:02:16', '2021-05-21 15:02:16'),
(20, 1, 'Adicionou Horario', '2021-05-21 15:04:39', '2021-05-21 15:04:39'),
(21, 1, 'Actualizou Escola', '2021-05-21 15:05:23', '2021-05-21 15:05:23'),
(22, 1, 'Adicionou pdf a uma Matéria', '2021-05-21 15:06:12', '2021-05-21 15:06:12'),
(23, 1, 'Adicionou Vídeo a Matéria', '2021-05-21 15:08:07', '2021-05-21 15:08:07'),
(24, 1, 'Adicionou Horario', '2021-05-21 15:13:16', '2021-05-21 15:13:16'),
(25, 1, 'Actualizou Escola', '2021-05-21 15:15:23', '2021-05-21 15:15:23'),
(26, 1, 'Adicionou pdf a uma Matéria', '2021-05-21 15:16:03', '2021-05-21 15:16:03'),
(27, 1, 'Adicionou Tarefa', '2021-05-24 10:38:06', '2021-05-24 10:38:06'),
(28, 6, 'Adicionou uma Tarefa Submetida', '2021-05-24 10:43:23', '2021-05-24 10:43:23'),
(29, 1, 'Adicionou Tarefa', '2021-05-24 10:59:13', '2021-05-24 10:59:13'),
(30, 1, 'Adicionou Horario', '2021-05-24 11:07:45', '2021-05-24 11:07:45'),
(31, 1, 'Actualizou Escola', '2021-05-24 11:08:21', '2021-05-24 11:08:21'),
(32, 7, 'Adicionou uma Tarefa Submetida', '2021-05-24 11:14:33', '2021-05-24 11:14:33'),
(33, 4, 'Escreveu Filho', '2021-05-24 11:21:21', '2021-05-24 11:21:21'),
(34, 4, 'Adicionou uma Matrícula', '2021-05-24 11:21:38', '2021-05-24 11:21:38'),
(35, 7, 'Adicionou uma Tarefa Submetida', '2021-05-24 12:29:35', '2021-05-24 12:29:35'),
(36, 7, 'Adicionou uma Tarefa Submetida', '2021-05-24 13:20:29', '2021-05-24 13:20:29'),
(37, 7, 'Actualizou um Utilizador', '2021-05-24 13:58:37', '2021-05-24 13:58:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materias`
--

CREATE TABLE `materias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_materia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_horarios` bigint(20) UNSIGNED NOT NULL,
  `it_id_classeDisciplina` bigint(20) UNSIGNED NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `dt_data_vizualizar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `materias`
--

INSERT INTO `materias` (`id`, `vc_materia`, `id_horarios`, `it_id_classeDisciplina`, `it_estado`, `dt_data_vizualizar`, `created_at`, `updated_at`) VALUES
(1, 'Educação', 1, 1, 1, '2021-05-21', '2021-05-21 15:05:23', '2021-05-21 15:05:23'),
(2, 'Resistores', 2, 2, 1, '2021-05-21', '2021-05-21 15:15:23', '2021-05-21 15:15:23'),
(3, 'Trabalhando com if/else', 3, 3, 1, '2021-05-25', '2021-05-24 11:08:21', '2021-05-24 11:08:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia_alunos`
--

CREATE TABLE `materia_alunos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `it_id_utilizador` bigint(20) UNSIGNED NOT NULL,
  `it_id_materia` bigint(20) UNSIGNED NOT NULL,
  `it_estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `materia_alunos`
--

INSERT INTO `materia_alunos` (`id`, `it_id_utilizador`, `it_id_materia`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, '2021-05-24 11:10:31', '2021-05-24 11:10:31'),
(2, 6, 2, 1, '2021-05-24 11:10:31', '2021-05-24 11:10:31'),
(3, 6, 3, 1, '2021-05-24 11:10:31', '2021-05-24 11:10:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `matriculas`
--

CREATE TABLE `matriculas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `it_id_utilizador` bigint(20) UNSIGNED NOT NULL,
  `it_id_escola` bigint(20) UNSIGNED NOT NULL,
  `it_id_classe` bigint(20) UNSIGNED NOT NULL,
  `it_id_anolectivo` bigint(20) UNSIGNED NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `matriculas`
--

INSERT INTO `matriculas` (`id`, `it_id_utilizador`, `it_id_escola`, `it_id_classe`, `it_id_anolectivo`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, 1, 1, '2021-05-21 15:02:06', '2021-05-21 15:02:06'),
(2, 7, 1, 2, 1, 1, '2021-05-21 15:02:16', '2021-05-21 15:02:16'),
(3, 8, 1, 1, 1, 1, '2021-05-24 11:21:38', '2021-05-24 11:21:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2014_11_15_120533_create_escolas_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2020_05_21_100000_create_teams_table', 1),
(8, '2020_05_21_200000_create_team_user_table', 1),
(9, '2020_12_01_231656_create_sessions_table', 1),
(10, '2020_12_09_155337_create_cabecalhos_table', 1),
(11, '2020_12_14_154624_create_anoslectivos_table', 1),
(12, '2021_04_06_101623_logs', 1),
(13, '2021_04_09_125800_dias_semanas', 1),
(14, '2021_04_13_140317_create_classes_table', 1),
(15, '2021_04_13_160743_create_disciplinas_table', 1),
(16, '2021_04_14_105005_matriculas', 1),
(17, '2021_04_14_14002_create_classe_disciplinas_table', 1),
(18, '2021_04_14_144735_horarios', 1),
(19, '2021_04_15_105758_create_materias_table', 1),
(20, '2021_04_16_074027_create_videos_table', 1),
(21, '2021_04_16_120952_create_p_d_f_s_table', 1),
(22, '2021_04_16_125041_horas', 1),
(23, '2021_04_16_184744_create_tarefas_table', 1),
(24, '2021_04_17_093333_tarefas_submetidas', 1),
(25, '2021_04_26_125539_create_funcionario_escolas_table', 1),
(26, '2021_05_07_104207_create_gabaritos_table', 1),
(27, '2021_05_10_101423_create_materia_alunos_table', 1),
(28, '2021_05_11_131000_create_tarefa_alunos_table', 1),
(29, '2021_05_11_141148_create_notificacao_utilizadors_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacao_utilizadors`
--

CREATE TABLE `notificacao_utilizadors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `it_id_utilizador` bigint(20) UNSIGNED NOT NULL,
  `it_id_materia` bigint(20) UNSIGNED DEFAULT NULL,
  `it_id_tarefa` bigint(20) UNSIGNED DEFAULT NULL,
  `vc_assunto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vc_descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `it_estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `notificacao_utilizadors`
--

INSERT INTO `notificacao_utilizadors` (`id`, `it_id_utilizador`, `it_id_materia`, `it_id_tarefa`, `vc_assunto`, `vc_descricao`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'Materia', 'Foi adicionada uma nova materia', 1, '2021-05-21 15:05:23', '2021-05-21 15:05:23'),
(2, 1, NULL, NULL, 'Materia', 'Foi adicionada uma nova materia', 1, '2021-05-21 15:15:23', '2021-05-21 15:15:23'),
(3, 1, NULL, NULL, 'Tarefa', 'Foi adicionada uma nova tarefa', 1, '2021-05-24 10:38:06', '2021-05-24 10:38:06'),
(4, 1, NULL, NULL, 'Tarefa', 'Foi adicionada uma nova tarefa', 1, '2021-05-24 10:59:13', '2021-05-24 10:59:13'),
(5, 1, NULL, NULL, 'Materia', 'Foi adicionada uma nova materia', 1, '2021-05-24 11:08:22', '2021-05-24 11:08:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_d_f_s`
--

CREATE TABLE `p_d_f_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_materia` bigint(20) UNSIGNED NOT NULL,
  `vc_pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_descricao_pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `p_d_f_s`
--

INSERT INTO `p_d_f_s` (`id`, `id_materia`, `vc_pdf`, `vc_descricao_pdf`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'pdfMateria/1706122021052160a7e8847409f.pdf', 'Primeiro PDF', 1, '2021-05-21 15:06:12', '2021-05-21 15:06:12'),
(2, 2, 'pdfMateria/1716032021052160a7ead31dc78.pdf', 'Calculo de potencia', 1, '2021-05-21 15:16:03', '2021-05-21 15:16:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_tarefa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_data_entrega` date NOT NULL,
  `vc_descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_classe_disciplinas` bigint(20) UNSIGNED NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`id`, `vc_tarefa`, `dt_data_entrega`, `vc_descricao`, `id_classe_disciplinas`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 'Humildade', '2021-05-24', 'Fazer redação de Humildade', 1, 1, '2021-05-24 10:38:06', '2021-05-24 10:38:06'),
(2, 'Resolução de algoritmos', '2021-05-24', 'Resolver todos os problemas da lista', 3, 1, '2021-05-24 10:59:13', '2021-05-24 10:59:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas_submetidas`
--

CREATE TABLE `tarefas_submetidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_tarefa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_id_tarefas` bigint(20) UNSIGNED NOT NULL,
  `it_id_utilizador` bigint(20) UNSIGNED NOT NULL,
  `it_id_matricula` bigint(20) UNSIGNED NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tarefas_submetidas`
--

INSERT INTO `tarefas_submetidas` (`id`, `vc_tarefa`, `vc_pdf`, `it_id_tarefas`, `it_id_utilizador`, `it_id_matricula`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 'fddfdfdf', 'pdfTarefaSubmeter/1243222021052460ab9f6a78a1b.pdf', 1, 6, 1, 1, '2021-05-24 10:43:23', '2021-05-24 10:43:23'),
(2, 'Manuel barros', 'pdfTarefaSubmeter/1314332021052460aba6b9969a0.pdf', 2, 7, 2, 1, '2021-05-24 11:14:33', '2021-05-24 11:14:33'),
(3, 'Minha resposta', 'pdfTarefaSubmeter/1429342021052460abb84edc760.pdf', 2, 7, 2, 1, '2021-05-24 12:29:35', '2021-05-24 12:29:35'),
(4, 'Manuel Barros', 'pdfTarefaSubmeter/1520282021052460abc43c3c5eb.pdf', 2, 7, 2, 1, '2021-05-24 13:20:28', '2021-05-24 13:20:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefa_alunos`
--

CREATE TABLE `tarefa_alunos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `it_id_utilizador` bigint(20) UNSIGNED NOT NULL,
  `it_id_tarefa` bigint(20) UNSIGNED NOT NULL,
  `it_estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tarefa_alunos`
--

INSERT INTO `tarefa_alunos` (`id`, `it_id_utilizador`, `it_id_tarefa`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, '2021-05-24 11:10:31', '2021-05-24 11:10:31'),
(2, 6, 2, 1, '2021-05-24 11:10:31', '2021-05-24 11:10:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `name`, `personal_team`, `created_at`, `updated_at`) VALUES
(1, 2, '\'s Team', 1, '2021-05-21 14:15:54', '2021-05-21 14:15:54'),
(2, 3, '\'s Team', 1, '2021-05-21 14:26:32', '2021-05-21 14:26:32'),
(3, 4, '\'s Team', 1, '2021-05-21 14:37:50', '2021-05-21 14:37:50'),
(4, 5, '\'s Team', 1, '2021-05-21 14:41:33', '2021-05-21 14:41:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_nomeUtilizador` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vc_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoUtilizador` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Encarregado',
  `vc_telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vc_primemiroNome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vc_nome_meio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vc_apelido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vc_genero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vc_BI` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt_data_nascimento` date DEFAULT NULL,
  `it_num_processo` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `vc_nomeUtilizador`, `vc_email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `tipoUtilizador`, `vc_telefone`, `vc_primemiroNome`, `vc_nome_meio`, `vc_apelido`, `vc_genero`, `vc_BI`, `dt_data_nascimento`, `it_num_processo`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'luisagrilo', 'luisagrilo@gmail.com', '2021-05-21 14:04:16', '$2y$10$ONbwK3plO9ZSzidyTwLa0.PFhezezek1W1yVAsMNhen9eZZ5UchoK', NULL, NULL, 'Administrador', '933445534', 'Luísa Maria', NULL, 'Alves Grilo', 'masculino', NULL, NULL, NULL, '0rsUqnosMJ', NULL, 'userPhoto/1624032021052160a7dea33fb78.jpg', '2021-05-21 14:04:16', '2021-05-21 14:24:03'),
(2, 'Adilson', 'adilson@gmail.com', NULL, '$2y$10$k0YGcPpJjpWx/c/00C5lVuU/FkexD9OhO56bvAi7xJKYFHOmDzLU.', NULL, NULL, 'Professor', '933445534', 'Adilson', NULL, 'Futa', 'masculino', NULL, NULL, NULL, NULL, NULL, 'userPhoto/1615502021052160a7dcb651300.png', '2021-05-21 14:15:54', '2021-05-21 14:15:54'),
(3, 'Reis', 'reis@gmail.com', NULL, '$2y$10$Ar2nc.a3QNNcEb8DkUNHde6527s89jkMANXy8ldx5GL4wleVlaxFS', NULL, NULL, 'Professor', '933445534', 'Reis', NULL, 'antónio', 'masculino', NULL, NULL, NULL, NULL, NULL, 'userPhoto/1627202021052160a7df68b3ee8.jpg', '2021-05-21 14:26:32', '2021-05-21 14:27:20'),
(4, 'Nelson', 'nelson@gmail.com', NULL, '$2y$10$4VjJlxBDxm1JVIX8KMcLYufW.DSxbNdJySuCLTVTZeR3Y9.c2wpGe', NULL, NULL, 'Encarregado', '929039049', 'Nelson', NULL, 'Barros', 'masculino', NULL, NULL, NULL, NULL, NULL, 'userPhoto/1637492021052160a7e1dd357bd.jpg', '2021-05-21 14:37:50', '2021-05-21 14:37:50'),
(5, 'Maria', 'maria@gmail.com', NULL, '$2y$10$TiKBpinVrr2emisepOJAUO9dQOk9krt6unUHBNZFeS7qkUkESNmua', NULL, NULL, 'Encarregado', '929039049', 'Maria', NULL, 'Barros', 'masculino', NULL, NULL, NULL, NULL, NULL, 'userPhoto/1641332021052160a7e2bd1d3df.jpg', '2021-05-21 14:41:33', '2021-05-21 14:41:33'),
(6, 'Rossano', 'rossano@gmail.com', NULL, '$2y$10$mqq2oQx227fkRTHRYD9Hn.cMhJiQOxmmmrP4DrQSUZe6XEx7fhJA6', NULL, NULL, 'Filho', '900000003', 'Rossano', 'António', 'Barros', 'masculino', '123456789LA1212', '2021-05-21', 1, NULL, 5, 'userPhoto/1644392021052160a7e377ce5cc.jpg', '2021-05-21 14:44:39', '2021-05-21 14:44:39'),
(7, 'Manuel', 'manuel@gmail.com', NULL, '$2y$10$ZwyzWjXm1tEH7rYHS1Zxk.aH2s.ddqtM5xGvlEXLrZp4NFBQC9Gdm', NULL, NULL, 'Filho', '924953442', 'Manuel', 'Barros', 'Barros1', 'masculino', '123456789LA1212', '2021-05-21', 3, NULL, 5, 'userPhoto/1558362021052460abcd2cacae4.jpg', '2021-05-21 14:56:46', '2021-05-24 13:58:37'),
(8, 'Dioga', 'dioga@gmail.com', NULL, '$2y$10$EQYEaEMPxkftJ5fO2n/pEuDNDFYiCiTXrTbIMYtv0LXbG6G5pncEi', NULL, NULL, 'Filho', '900000002', 'Dioga', 'Barros', 'Barros', 'masculino', '123456789LA1212', '2021-05-24', 6, NULL, 4, 'userPhoto/1321212021052460aba85141f8a.jpg', '2021-05-24 11:21:21', '2021-05-24 11:21:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vc_descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vc_video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_materia` bigint(20) UNSIGNED NOT NULL,
  `it_estado` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `videos`
--

INSERT INTO `videos` (`id`, `vc_descricao`, `vc_video`, `id_materia`, `it_estado`, `created_at`, `updated_at`) VALUES
(1, 'Vídeo sobre educação', 'videoMateria/1708072021052160a7e8f712ff6.mp4', 1, 1, '2021-05-21 15:08:07', '2021-05-21 15:08:07');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `anoslectivos`
--
ALTER TABLE `anoslectivos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cabecalhos`
--
ALTER TABLE `cabecalhos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `classe_disciplinas`
--
ALTER TABLE `classe_disciplinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classe_disciplinas_classe_id_foreign` (`classe_id`),
  ADD KEY `classe_disciplinas_disciplina_id_foreign` (`disciplina_id`);

--
-- Índices para tabela `dias_semanas`
--
ALTER TABLE `dias_semanas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `escolas`
--
ALTER TABLE `escolas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `escolas_it_id_utilizador_foreign` (`it_id_utilizador`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `funcionario_escolas`
--
ALTER TABLE `funcionario_escolas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionario_escolas_it_id_utilizador_foreign` (`it_id_utilizador`),
  ADD KEY `funcionario_escolas_it_id_escola_foreign` (`it_id_escola`),
  ADD KEY `funcionario_escolas_it_id_classedisciplina_foreign` (`it_id_classedisciplina`);

--
-- Índices para tabela `gabaritos`
--
ALTER TABLE `gabaritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gabaritos_it_id_tarefas_foreign` (`it_id_tarefas`);

--
-- Índices para tabela `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horarios_it_id_classedisciplina_foreign` (`it_id_classedisciplina`),
  ADD KEY `horarios_it_id_dias_foreign` (`it_id_dias`),
  ADD KEY `horarios_it_id_anoslectivos_foreign` (`it_id_anoslectivos`);

--
-- Índices para tabela `horas`
--
ALTER TABLE `horas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_it_iduser_foreign` (`it_idUser`);

--
-- Índices para tabela `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materias_id_horarios_foreign` (`id_horarios`),
  ADD KEY `materias_it_id_classedisciplina_foreign` (`it_id_classeDisciplina`);

--
-- Índices para tabela `materia_alunos`
--
ALTER TABLE `materia_alunos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materia_alunos_it_id_utilizador_foreign` (`it_id_utilizador`),
  ADD KEY `materia_alunos_it_id_materia_foreign` (`it_id_materia`);

--
-- Índices para tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matriculas_it_id_utilizador_foreign` (`it_id_utilizador`),
  ADD KEY `matriculas_it_id_escola_foreign` (`it_id_escola`),
  ADD KEY `matriculas_it_id_classe_foreign` (`it_id_classe`),
  ADD KEY `matriculas_it_id_anolectivo_foreign` (`it_id_anolectivo`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `notificacao_utilizadors`
--
ALTER TABLE `notificacao_utilizadors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notificacao_utilizadors_it_id_utilizador_foreign` (`it_id_utilizador`),
  ADD KEY `notificacao_utilizadors_it_id_materia_foreign` (`it_id_materia`),
  ADD KEY `notificacao_utilizadors_it_id_tarefa_foreign` (`it_id_tarefa`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices para tabela `p_d_f_s`
--
ALTER TABLE `p_d_f_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_d_f_s_id_materia_foreign` (`id_materia`);

--
-- Índices para tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices para tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tarefas_id_classe_disciplinas_foreign` (`id_classe_disciplinas`);

--
-- Índices para tabela `tarefas_submetidas`
--
ALTER TABLE `tarefas_submetidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tarefas_submetidas_it_id_tarefas_foreign` (`it_id_tarefas`),
  ADD KEY `tarefas_submetidas_it_id_utilizador_foreign` (`it_id_utilizador`),
  ADD KEY `tarefas_submetidas_it_id_matricula_foreign` (`it_id_matricula`);

--
-- Índices para tabela `tarefa_alunos`
--
ALTER TABLE `tarefa_alunos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tarefa_alunos_it_id_utilizador_foreign` (`it_id_utilizador`),
  ADD KEY `tarefa_alunos_it_id_tarefa_foreign` (`it_id_tarefa`);

--
-- Índices para tabela `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Índices para tabela `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_vc_email_unique` (`vc_email`);

--
-- Índices para tabela `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_id_materia_foreign` (`id_materia`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anoslectivos`
--
ALTER TABLE `anoslectivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cabecalhos`
--
ALTER TABLE `cabecalhos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `classe_disciplinas`
--
ALTER TABLE `classe_disciplinas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `dias_semanas`
--
ALTER TABLE `dias_semanas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `escolas`
--
ALTER TABLE `escolas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionario_escolas`
--
ALTER TABLE `funcionario_escolas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `gabaritos`
--
ALTER TABLE `gabaritos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `horas`
--
ALTER TABLE `horas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `materias`
--
ALTER TABLE `materias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `materia_alunos`
--
ALTER TABLE `materia_alunos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `notificacao_utilizadors`
--
ALTER TABLE `notificacao_utilizadors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `p_d_f_s`
--
ALTER TABLE `p_d_f_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tarefas_submetidas`
--
ALTER TABLE `tarefas_submetidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tarefa_alunos`
--
ALTER TABLE `tarefa_alunos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `classe_disciplinas`
--
ALTER TABLE `classe_disciplinas`
  ADD CONSTRAINT `classe_disciplinas_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `classe_disciplinas_disciplina_id_foreign` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `escolas`
--
ALTER TABLE `escolas`
  ADD CONSTRAINT `escolas_it_id_utilizador_foreign` FOREIGN KEY (`it_id_utilizador`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `funcionario_escolas`
--
ALTER TABLE `funcionario_escolas`
  ADD CONSTRAINT `funcionario_escolas_it_id_classedisciplina_foreign` FOREIGN KEY (`it_id_classedisciplina`) REFERENCES `classe_disciplinas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `funcionario_escolas_it_id_escola_foreign` FOREIGN KEY (`it_id_escola`) REFERENCES `escolas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `funcionario_escolas_it_id_utilizador_foreign` FOREIGN KEY (`it_id_utilizador`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `gabaritos`
--
ALTER TABLE `gabaritos`
  ADD CONSTRAINT `gabaritos_it_id_tarefas_foreign` FOREIGN KEY (`it_id_tarefas`) REFERENCES `tarefas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_it_id_anoslectivos_foreign` FOREIGN KEY (`it_id_anoslectivos`) REFERENCES `anoslectivos` (`id`),
  ADD CONSTRAINT `horarios_it_id_classedisciplina_foreign` FOREIGN KEY (`it_id_classedisciplina`) REFERENCES `classe_disciplinas` (`id`),
  ADD CONSTRAINT `horarios_it_id_dias_foreign` FOREIGN KEY (`it_id_dias`) REFERENCES `dias_semanas` (`id`);

--
-- Limitadores para a tabela `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_it_iduser_foreign` FOREIGN KEY (`it_idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_id_horarios_foreign` FOREIGN KEY (`id_horarios`) REFERENCES `horarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `materias_it_id_classedisciplina_foreign` FOREIGN KEY (`it_id_classeDisciplina`) REFERENCES `classe_disciplinas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `materia_alunos`
--
ALTER TABLE `materia_alunos`
  ADD CONSTRAINT `materia_alunos_it_id_materia_foreign` FOREIGN KEY (`it_id_materia`) REFERENCES `materias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `materia_alunos_it_id_utilizador_foreign` FOREIGN KEY (`it_id_utilizador`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_it_id_anolectivo_foreign` FOREIGN KEY (`it_id_anolectivo`) REFERENCES `anoslectivos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matriculas_it_id_classe_foreign` FOREIGN KEY (`it_id_classe`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matriculas_it_id_escola_foreign` FOREIGN KEY (`it_id_escola`) REFERENCES `escolas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matriculas_it_id_utilizador_foreign` FOREIGN KEY (`it_id_utilizador`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `notificacao_utilizadors`
--
ALTER TABLE `notificacao_utilizadors`
  ADD CONSTRAINT `notificacao_utilizadors_it_id_materia_foreign` FOREIGN KEY (`it_id_materia`) REFERENCES `materias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notificacao_utilizadors_it_id_tarefa_foreign` FOREIGN KEY (`it_id_tarefa`) REFERENCES `tarefas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notificacao_utilizadors_it_id_utilizador_foreign` FOREIGN KEY (`it_id_utilizador`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `p_d_f_s`
--
ALTER TABLE `p_d_f_s`
  ADD CONSTRAINT `p_d_f_s_id_materia_foreign` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD CONSTRAINT `tarefas_id_classe_disciplinas_foreign` FOREIGN KEY (`id_classe_disciplinas`) REFERENCES `classe_disciplinas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tarefas_submetidas`
--
ALTER TABLE `tarefas_submetidas`
  ADD CONSTRAINT `tarefas_submetidas_it_id_matricula_foreign` FOREIGN KEY (`it_id_matricula`) REFERENCES `matriculas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tarefas_submetidas_it_id_tarefas_foreign` FOREIGN KEY (`it_id_tarefas`) REFERENCES `tarefas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tarefas_submetidas_it_id_utilizador_foreign` FOREIGN KEY (`it_id_utilizador`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tarefa_alunos`
--
ALTER TABLE `tarefa_alunos`
  ADD CONSTRAINT `tarefa_alunos_it_id_tarefa_foreign` FOREIGN KEY (`it_id_tarefa`) REFERENCES `tarefas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tarefa_alunos_it_id_utilizador_foreign` FOREIGN KEY (`it_id_utilizador`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_id_materia_foreign` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
