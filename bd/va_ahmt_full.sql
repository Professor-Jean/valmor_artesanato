-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/11/2016 às 19:17
-- Versão do servidor: 5.7.11-log
-- Versão do PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `va_bd`
--
CREATE DATABASE IF NOT EXISTS `va_bd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `va_bd`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` tinyint(1) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador da categoria',
  `categoria` varchar(20) NOT NULL COMMENT 'Nome da categoria'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para cadastrar as diversas categorias de produtos, que é relacionada ao produto e é um componente fundamental para buscas, sendo um dos filtros de produtos.';

--
-- Fazendo dump de dados para tabela `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Tampa'),
(2, 'Cadeira '),
(3, 'Caixa'),
(4, 'Miniatura'),
(5, 'Jardim'),
(7, 'Mesa '),
(8, 'Placa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador do cliente',
  `enderecos_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador do endereço',
  `nome` varchar(45) NOT NULL COMMENT 'Nome do cliente',
  `email` varchar(70) NOT NULL COMMENT 'E-mail do cliente',
  `telefone` bigint(15) NOT NULL COMMENT 'Telefone do cliente',
  `cpf` bigint(11) UNSIGNED DEFAULT NULL COMMENT '(Campo Opcional) CPF do cliente',
  `link_facebook` varchar(255) DEFAULT NULL COMMENT '(Campo opcional) Link do facebook do cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para cadastrar os clientes da empresa atrelando eles ao orçamento e ao endereço';

--
-- Fazendo dump de dados para tabela `clientes`
--

INSERT INTO `clientes` (`id`, `enderecos_id`, `nome`, `email`, `telefone`, `cpf`, `link_facebook`) VALUES
(000001, 000002, 'Antonio Geraldo ', 'antonio.geraldo ', 4734428991, 2331429, 'https://pt-br.facebook.com/'),
(000002, 000003, 'Maria Eduarda da Silva', 'duda_silva@homtail.com', 4734829172, 4993817, 'https://pt-br.facebook.com/'),
(000003, 000004, 'Jorge Tramontini', 'jorge_tramontini@hotmail.com', 4782910377, 38827165, 'https://pt-br.facebook.com/'),
(000004, 000005, 'Antonio da Silva', 'antonio.seilva@gmail.com', 4733292781, 1233151, 'https://pt-br.facebook.com/'),
(000005, 000006, 'Anderson Tramontini Junior', 'juninho.at@gmail.com', 472298739, 3002192, 'https://pt-br.facebook.com/'),
(000006, 000007, 'Eduarda Maga Silva', 'duda_maga@hot,ail.com', 47261903816, 30019273, 'https://pt-br.facebook.com/'),
(000007, 000008, 'João Dicer', 'jao_dicer@hotmail.com', 4728103991, 3990102837, 'https://pt-br.facebook.com/'),
(000008, 000009, 'Gabriela Maria da Silva ', 'gabi.ms@gmail.com', 472355328, 382719200, 'https://pt-br.facebook.com/'),
(000009, 000010, 'Adriana Tramontini', 'adri_tramontini@hotmail.com', 4723449188, 38817293, 'https://pt-br.facebook.com/');

-- --------------------------------------------------------

--
-- Estrutura para tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de cada endereço',
  `cidade` varchar(30) DEFAULT NULL COMMENT '(Campo Opcional) Cidade onde mora cada cliente ',
  `bairro` varchar(30) DEFAULT NULL COMMENT '(Campo Opcional) Bairro em que o cliente reside',
  `logradouro` varchar(40) DEFAULT NULL COMMENT '(Campo Opcional) Logradouro que o cliente reside',
  `numero` int(5) DEFAULT NULL COMMENT '(Campo Opcional) Número da casa onde mora cada cliente',
  `cep` int(8) DEFAULT NULL COMMENT '(Campo Opcional) CEP da casa onde mora cada cliente',
  `complemento` varchar(20) DEFAULT NULL COMMENT '(Campo opcional) Complemeto da casa onde mora cada cliente '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para cadastrar os endereços de cada cliente, a tabela se atrelará com a tabela de clientes.';

--
-- Fazendo dump de dados para tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `cidade`, `bairro`, `logradouro`, `numero`, `cep`, `complemento`) VALUES
(000001, NULL, NULL, NULL, NULL, NULL, NULL),
(000002, 'Joinville', 'Bom Retiro', 'R. Itajubá', 223, 38827192, NULL),
(000003, 'Joinville', 'Glória', 'R. Bananal', 11, 3881923, 'casa 2'),
(000004, 'Joinville', 'Glória', 'R. pelotas', 412, 4992827, 'apartamento 3'),
(000005, 'Joinville', 'Aventureiro', 'R. Jequié', NULL, NULL, NULL),
(000006, 'Joinville', 'Costa e Silva', 'R. Pavao', 332, 3000182, 'apartamento 4'),
(000007, 'Joinville', 'Floresta', 'R. Florianópolis ', 3341, 39183048, NULL),
(000008, 'Joinville', 'Glória', 'R. Max Colin', 332, 32349123, 'apartamento 5'),
(000009, 'Joinville', 'Bom Retiro', 'R. Riachuelo', 11, 38737719, NULL),
(000010, 'Joinville', 'Glória', 'R. Timbó', 553, 33399018, 'casa 2'),
(000011, 'Joinville', 'Costa e Silva', 'AV. Marquês de Olinda', 534, 8921882, NULL),
(000012, 'Joinville', 'Costa e Silva', 'R.piritiba', NULL, NULL, NULL),
(000013, 'Joinville', 'Costa e Silva', 'R.Piritiba', 286, 82719203, NULL),
(000014, 'Joinville', 'Costa e Silva', 'R .Jaú', 127, 99281000, NULL),
(000015, 'Joinville', 'Glória', 'R. Campo Sales', 986, 13331280, NULL),
(000016, 'Joinville', 'Floresta', 'R. Florianópolis ', 245, 21422312, 'apartamento 2');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador para cada funcionário, serve para os diferenciar',
  `usuario_id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador do usuário',
  `enderecos_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador do endereço de cada funcionário',
  `nome` varchar(45) NOT NULL COMMENT 'Nome de cada funcionário ',
  `telefone` bigint(15) NOT NULL COMMENT 'Telefone de cada funcionário',
  `cargo` varchar(30) NOT NULL COMMENT 'Cargo de cada funcionário '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para cadastrar as informações de cada funcionário e os atribuir um usuário.';

--
-- Fazendo dump de dados para tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `usuario_id`, `enderecos_id`, `nome`, `telefone`, `cargo`) VALUES
(00001, 00002, 000001, 'João Silva', 4734423764, 'Vendedor'),
(00002, 00003, 000011, 'Carlos Junior', 4798856632, 'Auxiliar de Produção'),
(00003, 00004, 000013, 'Daniel Pereira', 4799832712, 'Vendedor'),
(00004, 00005, 000014, 'João da Silva', 347291919127827, 'Gerente'),
(00005, 00006, 000015, 'Kátia Nogueira', 4734829981, 'Sub gerente '),
(00006, 00007, 000016, 'Pedro Alves ', 472819928, 'Zelador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `maquinas`
--

CREATE TABLE `maquinas` (
  `id` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de cada máquina, serve para diferenciar cada máquina',
  `modelo` varchar(45) NOT NULL COMMENT 'Modelo de cada máquina',
  `marca` varchar(25) NOT NULL COMMENT 'Marca de cada máquina',
  `descricao` text COMMENT '(Campo opcional) Descreve a função e localização de cada máquina',
  `data_aquisicao` date DEFAULT NULL COMMENT '(Campo opcional) Data em que a máquina foi comprada pela empresa, podendo assim, visualizar a quanto tempo ela está na empresa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para cadastrar as máquinas que a empresa possui, além de atrelar com a movimentação de saída e retorno da manutenção ';

--
-- Fazendo dump de dados para tabela `maquinas`
--

INSERT INTO `maquinas` (`id`, `modelo`, `marca`, `descricao`, `data_aquisicao`) VALUES
(001, 'GL-1290', 'Hefei', 'Máquina de gravação e recorte a laser', '2016-03-23'),
(002, 'MDL300', 'IPG', 'Serra circular de bancada\r\n', '2014-09-09'),
(003, 'PR2', 'IXAR', 'Corte em acrílico', '2015-01-22'),
(004, 'STST1825', 'STANLEY ', 'Serra circular de bancada ', '2013-06-04');

-- --------------------------------------------------------

--
-- Estrutura para tabela `materias_primas`
--

CREATE TABLE `materias_primas` (
  `id` tinyint(1) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de cada matéria-prima',
  `nome` varchar(15) NOT NULL COMMENT 'Nome da matéria-prima',
  `descricao` text COMMENT 'Descrição de cada matéria-prima'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as diferentes matérias-primas que os produtos podem ser feitos, evitando ter que escrever esta toda vez que se registra um produto e possibilitando novas inserções de matérias-primas.';

--
-- Fazendo dump de dados para tabela `materias_primas`
--

INSERT INTO `materias_primas` (`id`, `nome`, `descricao`) VALUES
(1, 'MDF', NULL),
(3, 'Acrilico', NULL),
(4, 'Madeira ', 'Maciça');

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentacoes`
--

CREATE TABLE `movimentacoes` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'identificador de cada movimentação',
  `maquinas_id` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador da máquina ',
  `status` tinyint(1) NOT NULL COMMENT 'status de movimentação de cada máquina:\n0 = em funcionamento\n1 = em manutenção',
  `data_saida` date NOT NULL COMMENT 'Data que a máquina sai para a manutenção  ',
  `data_prevista` date NOT NULL COMMENT 'Data prevista de retorno da manutenção de cada máquina ',
  `data_retorno` date NOT NULL COMMENT 'Data que a máquina retorna da manutenção',
  `preco` decimal(7,2) UNSIGNED NOT NULL COMMENT 'Preço de cada manutenção',
  `descricao` text COMMENT '(Campo opcional) Descrição do que foi feito na máquina, pode ser usado para comentar o estado que a máquina voltou, como estava quando foi enviada, etc...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para cadastrar quando um máquina sai para a manutenção e retorna da manutenção, atrelando com as máquinas registradas';

--
-- Fazendo dump de dados para tabela `movimentacoes`
--

INSERT INTO `movimentacoes` (`id`, `maquinas_id`, `status`, `data_saida`, `data_prevista`, `data_retorno`, `preco`, `descricao`) VALUES
(000001, 001, 0, '2016-11-09', '2016-11-30', '2016-11-30', '250.00', 'Não esta ligando '),
(000002, 002, 1, '2016-11-16', '2016-11-27', '2016-11-27', '200.00', 'Botão de força não esta funcionando '),
(000003, 003, 0, '2016-11-07', '2016-12-20', '2016-12-20', '1200.00', 'Laser não liga '),
(000004, 004, 0, '2016-05-18', '2016-10-19', '2016-10-19', '1100.00', 'Disco quebrado e desalinhada '),
(000005, 003, 1, '2016-11-07', '2016-12-20', '2016-12-20', '1200.00', 'Laser não liga '),
(000006, 001, 1, '2016-11-29', '2016-11-29', '2016-11-29', '1.00', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `orcamentos`
--

CREATE TABLE `orcamentos` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de cada orçamento',
  `clientes_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador do cliente',
  `status` tinyint(1) NOT NULL COMMENT 'Status do orçamento com valor: \n0 = orçamento não confirmado\n1 = orçamento cancelado\n2 = pedido em produção (passou a ser chamado de pedido)\n3 = pedido em estoque\n4 = pedido entregue\n5 = pedido cancelado',
  `data_orcamento` date NOT NULL COMMENT 'Armazena a data em que o orçamento foi realizado ',
  `data_prevista` date DEFAULT NULL COMMENT 'Data prevista de entrega do pedido',
  `data_entrega` date DEFAULT NULL COMMENT 'Armazena a data em que o pedido foi entregue ao cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para cadastrar o orçamento  ';

--
-- Fazendo dump de dados para tabela `orcamentos`
--

INSERT INTO `orcamentos` (`id`, `clientes_id`, `status`, `data_orcamento`, `data_prevista`, `data_entrega`) VALUES
(000001, 000009, 4, '2016-11-24', '2016-11-27', '2016-11-28'),
(000002, 000002, 4, '2016-11-24', '2016-11-30', '2016-11-26'),
(000003, 000007, 4, '2016-11-24', '2016-12-02', '2016-11-27'),
(000004, 000006, 4, '2016-11-24', '2016-11-30', '2016-11-27'),
(000005, 000002, 4, '2016-11-24', '2016-12-12', '2016-11-25'),
(000006, 000006, 4, '2016-11-24', '2016-12-14', '2016-11-28'),
(000007, 000005, 1, '2016-11-24', NULL, NULL),
(000008, 000001, 4, '2016-11-24', '2016-11-25', '2016-11-25'),
(000009, 000004, 4, '2016-11-24', '2016-11-28', '2016-11-28'),
(000010, 000002, 4, '2016-11-24', '2016-12-09', '2016-11-27'),
(000011, 000003, 3, '2016-11-24', '2016-11-27', NULL),
(000012, 000004, 2, '2016-11-24', '2016-12-21', NULL),
(000013, 000001, 3, '2016-11-24', '2016-11-30', NULL),
(000014, 000008, 3, '2016-11-24', '2016-12-01', NULL),
(000015, 000006, 2, '2016-11-24', '2016-11-28', NULL),
(000016, 000004, 0, '2016-11-24', NULL, NULL),
(000017, 000002, 0, '2016-11-24', NULL, NULL),
(000018, 000007, 0, '2016-11-24', NULL, NULL),
(000019, 000002, 0, '2016-11-24', NULL, NULL),
(000020, 000007, 2, '2016-11-28', '2016-11-29', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `orcamentos_has_produtos`
--

CREATE TABLE `orcamentos_has_produtos` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador do orçamento com produto',
  `orcamentos_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador do orçamento',
  `produtos_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador do produto',
  `materias_primas_id` tinyint(1) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador da matéria-prima',
  `setor` tinyint(1) UNSIGNED NOT NULL COMMENT 'Setor em que o produto é fabricado\n0 = Marcenaria;\n1 = Laser \n2 = Marcenaria e Laser.',
  `n_pecas` tinyint(3) DEFAULT NULL COMMENT '(Campo Opcional) Armazena o número de peças caso o produto padrão tenha seus dados alterados, do contrário o campo recebe valor NULL.',
  `preco` decimal(7,2) UNSIGNED DEFAULT NULL COMMENT '(Campo Opcional) Armazena o preço caso o produto padrão tenha seus dados alterados, do contrário o campo recebe valor NULL.',
  `largura` decimal(5,2) UNSIGNED DEFAULT NULL COMMENT '(Campo Opcional) Armazena a largura caso o produto padrão tenha seus dados alterados, do contrário o campo recebe valor NULL.',
  `altura` decimal(5,2) UNSIGNED DEFAULT NULL COMMENT '(Campo Opcional) Armazena a altura caso o produto padrão tenha seus dados alterados, do contrário o campo recebe valor NULL.',
  `profundidade` decimal(5,2) UNSIGNED DEFAULT NULL COMMENT '(Campo Opcional) Armazena a profundidade caso o produto padrão tenha seus dados alterados, do contrário o campo recebe valor NULL.',
  `imagem` varchar(255) DEFAULT NULL COMMENT '(Campo Opcional) Armazena a imagem caso o produto padrão tenha seus dados alterados, do contrário o campo recebe valor NULL.',
  `quantidade` tinyint(3) UNSIGNED NOT NULL COMMENT 'Quantidade de produtos idênticos.',
  `descricao` text COMMENT '(Campo Opcional) Armazena a descrição caso o produto padrão tenha seus dados alterados, do contrário o campo recebe valor NULL.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que relaciona os produtos aos orçamentos, além de possibilitar que produtos personalizados, baseados nos padrões, possam ser inseridos.';

--
-- Fazendo dump de dados para tabela `orcamentos_has_produtos`
--

INSERT INTO `orcamentos_has_produtos` (`id`, `orcamentos_id`, `produtos_id`, `materias_primas_id`, `setor`, `n_pecas`, `preco`, `largura`, `altura`, `profundidade`, `imagem`, `quantidade`, `descricao`) VALUES
(000001, 000001, 000001, 1, 1, NULL, NULL, NULL, NULL, NULL, 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQEyD-bluswgxKfcU_O9X6X-Rf0ve2sewFrXXBJANnXWAQO0PP3nQ', 2, 'Placa de boas vindas para portas '),
(000002, 000002, 000007, 3, 1, NULL, NULL, NULL, NULL, NULL, 'https://http2.mlstatic.com/caixa-acrilico-transparente-ou-leitoso-30mmx20cmx20cmx20cm-D_NQ_NP_420701-MLB20379948708_082015-F.jpg', 1, 'Caixa pequena transparente '),
(000003, 000003, 000005, 4, 0, NULL, NULL, NULL, NULL, NULL, 'http://www.tacolandia.com.br/img/produtos/carteado/grd/13.jpg', 2, 'Mesa de poker amadora \r\n'),
(000004, 000004, 000003, 4, 0, NULL, NULL, NULL, NULL, NULL, 'http://www.arteemminiaturas.com.br/webapps/imagefile/arquivos/boneco-de-desenho-20-cm-08610-01.jpg', 3, 'Boneco pequeno '),
(000005, 000005, 000003, 4, 0, NULL, NULL, NULL, NULL, NULL, 'http://www.arteemminiaturas.com.br/webapps/imagefile/arquivos/boneco-de-desenho-20-cm-08610-01.jpg', 2, 'Boneco pequeno '),
(000006, 000006, 000002, 4, 0, NULL, NULL, NULL, NULL, NULL, 'https://legadoarte.files.wordpress.com/2011/10/cadeira-3-pes-em-duas-madeiras-jt-lado.jpg?w=1075', 6, 'Cadeira de 3 pernas \r\n'),
(000007, 000007, 000004, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Avião de enfeite '),
(000008, 000008, 000005, 4, 0, NULL, NULL, NULL, NULL, NULL, 'http://www.tacolandia.com.br/img/produtos/carteado/grd/13.jpg', 1, 'Mesa de poker amadora \r\n'),
(000009, 000009, 000003, 4, 0, NULL, NULL, NULL, NULL, NULL, 'http://www.arteemminiaturas.com.br/webapps/imagefile/arquivos/boneco-de-desenho-20-cm-08610-01.jpg', 1, 'Boneco pequeno '),
(000010, 000010, 000001, 1, 2, NULL, NULL, NULL, NULL, NULL, 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQEyD-bluswgxKfcU_O9X6X-Rf0ve2sewFrXXBJANnXWAQO0PP3nQ', 2, 'Placa de boas vindas para portas '),
(000011, 000011, 000006, 1, 1, NULL, NULL, NULL, NULL, NULL, 'https://http2.mlstatic.com/bau-em-mdf-bau-para-brinquedos-bau-de-madeira-caixa-D_NQ_NP_951611-MLB20590041135_022016-F.jpg', 5, 'caixa pequena estilo baú'),
(000012, 000012, 000002, 4, 0, NULL, NULL, NULL, NULL, NULL, 'https://legadoarte.files.wordpress.com/2011/10/cadeira-3-pes-em-duas-madeiras-jt-lado.jpg?w=1075', 2, 'Cadeira de 3 pernas \r\n'),
(000013, 000013, 000004, 1, 2, NULL, NULL, NULL, NULL, NULL, 'http://img.elo7.com.br/product/original/BF774F/aviao-de-madeira-enfeite-mesa-22-cm-enfeite-de-mesa.jpg', 1, 'Avião de enfeite '),
(000014, 000014, 000001, 1, 2, NULL, NULL, NULL, NULL, NULL, 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQEyD-bluswgxKfcU_O9X6X-Rf0ve2sewFrXXBJANnXWAQO0PP3nQ', 4, 'Placa de boas vindas para portas '),
(000015, 000015, 000004, 4, 0, NULL, NULL, NULL, NULL, NULL, 'http://img.elo7.com.br/product/original/BF774F/aviao-de-madeira-enfeite-mesa-22-cm-enfeite-de-mesa.jpg', 2, 'Avião de enfeite '),
(000016, 000016, 000006, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'caixa pequena estilo baú'),
(000017, 000017, 000005, 4, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Mesa de poker amadora \r\n'),
(000018, 000018, 000007, 4, 1, 6, '12.00', '10.00', '10.00', '10.00', 'https://http2.mlstatic.com/caixa-acrilico-transparente-ou-leitoso-30mmx20cmx20cmx20cm-D_NQ_NP_420701-MLB20379948708_082015-F.jpg', 1, 'Caixa pequena transparente '),
(000019, 000019, 000007, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, 5, 'Caixa pequena transparente '),
(000020, 000020, 000001, 1, 0, 2, '5.50', '77.00', '10.00', '2.00', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQEyD-bluswgxKfcU_O9X6X-Rf0ve2sewFrXXBJANnXWAQO0PP3nQ', 2, 'Placa de boas vindas para portas ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador do produto',
  `categorias_id` tinyint(1) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador da categoria\n',
  `n_pecas` tinyint(3) NOT NULL COMMENT 'Número de peças do produto',
  `preco` decimal(7,2) UNSIGNED NOT NULL COMMENT 'Preço do produto',
  `nome` varchar(45) NOT NULL COMMENT 'Nome do produto',
  `largura` decimal(5,2) UNSIGNED NOT NULL COMMENT 'Largura do produto',
  `altura` decimal(5,2) UNSIGNED NOT NULL COMMENT 'Altura do produto',
  `profundidade` decimal(5,2) UNSIGNED NOT NULL COMMENT 'Profundidade do produto',
  `imagem` varchar(255) DEFAULT NULL COMMENT '(Campo opcional) Link da imagem',
  `descricao` text COMMENT '(Campo opcional) Descrição do produto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para cadastrar os produtos';

--
-- Fazendo dump de dados para tabela `produtos`
--

INSERT INTO `produtos` (`id`, `categorias_id`, `n_pecas`, `preco`, `nome`, `largura`, `altura`, `profundidade`, `imagem`, `descricao`) VALUES
(000001, 8, 2, '5.50', 'Boas Vindas', '20.00', '10.00', '2.00', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQEyD-bluswgxKfcU_O9X6X-Rf0ve2sewFrXXBJANnXWAQO0PP3nQ', 'Placa de boas vindas para portas '),
(000002, 2, 4, '35.00', 'Cadeira tripé ', '40.00', '180.00', '40.00', 'https://legadoarte.files.wordpress.com/2011/10/cadeira-3-pes-em-duas-madeiras-jt-lado.jpg?w=1075', 'Cadeira de 3 pernas \r\n'),
(000003, 4, 8, '10.00', 'Boneco', '5.00', '30.00', '5.00', 'http://www.arteemminiaturas.com.br/webapps/imagefile/arquivos/boneco-de-desenho-20-cm-08610-01.jpg', 'Boneco pequeno '),
(000004, 4, 7, '2000.00', 'Avião ', '20.00', '10.00', '40.00', 'http://img.elo7.com.br/product/original/BF774F/aviao-de-madeira-enfeite-mesa-22-cm-enfeite-de-mesa.jpg', 'Avião de enfeite '),
(000005, 7, 12, '300.00', 'Mesa de Poker', '100.00', '130.00', '100.00', 'http://www.tacolandia.com.br/img/produtos/carteado/grd/13.jpg', 'Mesa de poker amadora \r\n'),
(000006, 3, 5, '15.00', 'Baú', '10.00', '10.00', '10.00', 'https://http2.mlstatic.com/bau-em-mdf-bau-para-brinquedos-bau-de-madeira-caixa-D_NQ_NP_951611-MLB20590041135_022016-F.jpg', 'caixa pequena estilo baú'),
(000007, 3, 6, '12.00', 'Caixa transparente ', '10.00', '10.00', '10.00', 'https://http2.mlstatic.com/caixa-acrilico-transparente-ou-leitoso-30mmx20cmx20cmx20cm-D_NQ_NP_420701-MLB20379948708_082015-F.jpg', 'Caixa pequena transparente ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'identificador de cada usuário, para diferenciar os usuários',
  `usuario` varchar(20) DEFAULT NULL COMMENT 'Nome de cada usuário ',
  `senha` char(32) DEFAULT NULL COMMENT 'Senha de cada usuário',
  `permissao` tinyint(1) DEFAULT NULL COMMENT 'Permissao de acesso de cada usuário, serve para diferenciar o que cada usuário poderá usufruir do software. \n0 = Administrador\n1 = Funcionário de Vendas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para cadstrar um usuário que será atrelado a um funcionário';

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `permissao`) VALUES
(00001, 'adm', '61fde6da99a39d34b3bd0452745c39bd', 0),
(00002, 'joao', '61fde6da99a39d34b3bd0452745c39bd', 1),
(00003, NULL, '758627d00b62eb093f83364a8f72ed75', NULL),
(00004, 'daniel', '61fde6da99a39d34b3bd0452745c39bd', 1),
(00005, 'joaosilva', '61fde6da99a39d34b3bd0452745c39bd', 0),
(00006, 'katia', '61fde6da99a39d34b3bd0452745c39bd', 0),
(00007, NULL, '758627d00b62eb093f83364a8f72ed75', NULL);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clientes_enderecos1_idx` (`enderecos_id`);

--
-- Índices de tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_funcionarios_usuario_idx` (`usuario_id`),
  ADD KEY `fk_funcionarios_enderecos1_idx` (`enderecos_id`);

--
-- Índices de tabela `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `materias_primas`
--
ALTER TABLE `materias_primas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movimentacoes_maquinas1_idx` (`maquinas_id`);

--
-- Índices de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orcamentos_clientes1_idx` (`clientes_id`);

--
-- Índices de tabela `orcamentos_has_produtos`
--
ALTER TABLE `orcamentos_has_produtos`
  ADD PRIMARY KEY (`id`,`orcamentos_id`,`produtos_id`),
  ADD KEY `fk_orcamentos_has_produtos_produtos1_idx` (`produtos_id`),
  ADD KEY `fk_orcamentos_has_produtos_orcamentos1_idx` (`orcamentos_id`),
  ADD KEY `fk_orcamentos_has_produtos_materias_primas1_idx` (`materias_primas_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produtos_categorias1_idx` (`categorias_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` tinyint(1) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador da categoria', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador do cliente', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada endereço', AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador para cada funcionário, serve para os diferenciar', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `id` tinyint(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada máquina, serve para diferenciar cada máquina', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `materias_primas`
--
ALTER TABLE `materias_primas`
  MODIFY `id` tinyint(1) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada matéria-prima', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'identificador de cada movimentação', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada orçamento', AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de tabela `orcamentos_has_produtos`
--
ALTER TABLE `orcamentos_has_produtos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador do orçamento com produto', AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador do produto', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'identificador de cada usuário, para diferenciar os usuários', AUTO_INCREMENT=8;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_enderecos1` FOREIGN KEY (`enderecos_id`) REFERENCES `enderecos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `fk_funcionarios_enderecos1` FOREIGN KEY (`enderecos_id`) REFERENCES `enderecos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_funcionarios_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `movimentacoes`
--
ALTER TABLE `movimentacoes`
  ADD CONSTRAINT `fk_movimentacoes_maquinas1` FOREIGN KEY (`maquinas_id`) REFERENCES `maquinas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD CONSTRAINT `fk_orcamentos_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `orcamentos_has_produtos`
--
ALTER TABLE `orcamentos_has_produtos`
  ADD CONSTRAINT `fk_orcamentos_has_produtos_materias_primas1` FOREIGN KEY (`materias_primas_id`) REFERENCES `materias_primas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orcamentos_has_produtos_orcamentos1` FOREIGN KEY (`orcamentos_id`) REFERENCES `orcamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orcamentos_has_produtos_produtos1` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_categorias1` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
