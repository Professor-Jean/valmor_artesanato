produtoAntigo = new Array();
  produtoAntigo[0] = "";
$(function () {

	//cria a função removeCampo
    function removeDiv() {
      //desvincula os elementos da class "removeDiv" à função criada abaixo, para que o alert de "A última linha não pode ser removida." funcione apenas quando necessário
      $(".removerDiv").unbind("click");
      //ao se clicar em um elemento com a class removerDiv, inicia uma função em que...
      $(".removerDiv").bind("click", function () {
        //... se a quantidade de tags tr com a classe linhas for maior que 1 (ou seja, se houver mais de uma linha no mestre-detalhe - isso serve para evitar que se exclua todas as linhas)
        if($("table.linhas").length > 1){
          //remove a linha que contém o botão de excluir clicado (explicando: this seria o botão, o primeiro parent é a célula onde está o botão e o segundo parent é a linha onde está o botão, por isso o remove age na linha)
          $(this).parent().parent().parent().parent().remove();
          //chama a função valoresAntigos para guardar os valores atuais das atracaos como antigos
          valoresAntigos();
        //senão
        }else{
          alert("O ultimo produto não pode ser removido.");
        }
        //fecha a function do bind
      });
      //fecha a função removeCampo
    }

    //Ao clicar no botão adicionarCampo, inicia a seguinte função:
    $(".adicionarDiv").click(function () {

      //Cria um clone da primeira linha de detalhe e salva na variável novoCampo
      novoDiv = $("table.linhas:first").clone();
      //esvazia os valores de todos os inputs do clone
      novoDiv.find("input").val("");
      //Insere o clone na página, logo após a última linha já existente
      novoDiv.insertAfter("table.linhas:last");
      /*inicio da parte que faz com que o select de palco fique sem opções*/
      //captura todo o array selpalco...
      var esvaziaproduto = document.getElementsByName('selproduto[]');
      //descobre a última posição do array selpalco e a armazena em last
      last = esvaziaproduto.length - 1;
      //chama a função valoresAntigos para guardar os valores atuais das atracaos como antigos
      valoresAntigos();
      //Executa a função removeCampo para que o detalhe inserido ao clicar no botão adicionarCampo possa ser excluido
      removeDiv();
    });
  });

  /*função criada para receber os valores dos campos existentes, usados posteriormente para descobrirmos se o valor do campo foi alterado ou não*/
  function valoresAntigos (){
    //recebe todas as posições do campo selprodutos[] e salva na variável atracaos
    var produtos = document.getElementsByName('selproduto[]');
    //da posição 0 até a posição final do array...
    for (var i=0;i<produtos.length;i++){
      //...captura e salva o valor atual do campo selatracao no array criado no carregamento da página para os valores antigos
      produtoAntigo[i] = produtos[i].value;
    }
  }


  //função de validação dos campos do mestre detalhe
  function validaDetalhe(){
    var produtoValidar = document.getElementsByName('selproduto[]');
    var materiaprimaValidar = document.getElementsByName('selmateriaprima[]');
    var categoriaValidar = document.getElementsByName('selcategoria[]');
    var setorValidar = document.getElementsByName('selsetor[]');
    var npecasValidar = document.getElementsByName('selnpecas[]');
    var alturaValidar = document.getElementsByName('txtaltura[]');
    var larguraValidar = document.getElementsByName('txtlargura[]');
    var profundidadeValidar = document.getElementsByName('txtprofundidade[]');
    var descricaoValidar = document.getElementsByName('txadescricao[]');
    var precoValidar = document.getElementsByName('txtpreco[]');
    var quantidadeValidar = document.getElementsByName('txtquantidade[]');
    //estrutura para-faça para repetir a validação enquanto i for menor que o tamanho do array, sendo que i começa de 0 e tem incremento 1
    for (var i = 0;i < atracaosValidar.length; i++){
      //cria a variável linha com valor de "i mais um" para a mensagem avisar corretamente qual campo não foi preenchido
      var linha = i+1;
      //se a posição atual dos arrays de atracao e/ou produto estiverem vazios,
      if ((produtoValidar[i].value=="")||(materiaprimaValidar[i].value=="")||(categoriaValidar[i].value=="")||(alturaValidar[i].value=="")||(larguraValidar[i].value=="")||(profundidadeValidar[i].value=="")||(descricaoValidar[i].value=="")||(precoValidar[i].value=="")||(quantidadeValidar[i].value=="")){
        alert ("A linha "+linha+" não foi completamente preenchida.");
        return false;
      }
    }

  }
