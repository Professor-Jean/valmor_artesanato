-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/11/2016 às 18:06
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
(000001, NULL, NULL, NULL, NULL, NULL, NULL);

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
(00001, 00002, 000001, 'João Silva', 4734423764, 'Vendedor');

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `materias_primas`
--

CREATE TABLE `materias_primas` (
  `id` tinyint(1) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de cada matéria-prima',
  `nome` varchar(15) NOT NULL COMMENT 'Nome da matéria-prima',
  `descricao` text COMMENT 'Descrição de cada matéria-prima'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as diferentes matérias-primas que os produtos podem ser feitos, evitando ter que escrever esta toda vez que se registra um produto e possibilitando novas inserções de matérias-primas.';

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
(00002, 'joao', '61fde6da99a39d34b3bd0452745c39bd', 1);

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
  MODIFY `id` tinyint(1) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador da categoria';
--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador do cliente';
--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada endereço', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador para cada funcionário, serve para os diferenciar', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `id` tinyint(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada máquina, serve para diferenciar cada máquina';
--
-- AUTO_INCREMENT de tabela `materias_primas`
--
ALTER TABLE `materias_primas`
  MODIFY `id` tinyint(1) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada matéria-prima';
--
-- AUTO_INCREMENT de tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'identificador de cada movimentação';
--
-- AUTO_INCREMENT de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada orçamento';
--
-- AUTO_INCREMENT de tabela `orcamentos_has_produtos`
--
ALTER TABLE `orcamentos_has_produtos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador do orçamento com produto';
--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador do produto';
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'identificador de cada usuário, para diferenciar os usuários', AUTO_INCREMENT=3;
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
