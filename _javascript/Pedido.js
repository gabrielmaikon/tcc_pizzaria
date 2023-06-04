class Produto {
    constructor() {
        this.id = 1;
        this.id_bebida = 1;
        this.arrayProdutos = [];
        this.arrayBebida = [];
        this.pedido = 0;
        this.result = {};
        this.valor_total = 0;
        this.valor_bebida = 0;
        this.valor_total_pedido = 0;
    }

    salvar(cod, pizza, preco, quantidade) {
        let produto = this.lerDados(
            cod,
            pizza,
            preco,
            quantidade
        ); /* adicionou 'this.lerDados()' na variavel produto, 'this.lerDados' retorna um objeto com os atributos id, nomeProduto e preco*/
        this.adicionar(produto);

        this.listaTabela(); //exibe o arrayProdutos na tela limpa os input
    }

    listaTabela() {
        let tbody = document.getElementById("tbody");
        tbody.innerText = "";

        for (let i = 0; i < this.arrayProdutos.length; i++) {
            let tr = tbody.insertRow(); //função para add linhas na tabela, tr no table

            let td_pizza = tr.insertCell();
            let td_quantidade = tr.insertCell();
            let td_valor = tr.insertCell();
            let td_acoes = tr.insertCell();

            td_pizza.innerText = this.arrayProdutos[i].nomeProduto;
            td_valor.innerText = this.arrayProdutos[i].preco;
            td_quantidade.innerText = this.arrayProdutos[i].quantidade;

            td_quantidade.classList.add("text-center");
            td_valor.classList.add("text-center");
            td_acoes.classList.add("text-center");

            let imgDelete = document.createElement("img");
            imgDelete.src = "_img/delete.png";
            imgDelete.setAttribute(
                "onclick",
                "produto.deletar(" + this.arrayProdutos[i].id + ")"
            );
            td_acoes.appendChild(imgDelete);
        }

        console.log(this.arrayProdutos);
    }

    adicionar(produto) {
        if (produto.already) {
            console.log("p1", produto);
            this.arrayProdutos.forEach((p) => {
                if (p.id === produto.id) {
                    p.quantidade = String(
                        Number(p.quantidade) + Number(produto.quantidade)
                    );
                    p.preco += produto.preco;
                }
                console.log("produto", p);
            });
        } else {
            //função para adicionar o protudo salvo no array
            this.arrayProdutos.push(produto); //função '.push' é para adicionar algo no final do array e crescendo seu tamanho
            this.id++;
        }
    }

    finalizar() {
        const pedido = {
            nuPedido: randomNumber,
            produtos: this.arrayProdutos,
            valorTotal: this.valor_total_pedido,
            nomeCliente: $("#nomeCliente").val(),
            obsevarcao: $("#msg").val(),
        };

        if (pedido.valorTotal) {
            $.ajax({
                type: "POST",
                url: "finalizarPedido.php",
                dataType: "html",
                data: pedido,
                success: function (data) {
                    console.log("SUCESSO! ", data);
                    $("#pedidoGerado").text(`Número gerado: ${data}`);
                },
                error: function (err) {
                    console.log("ERROR! ", err.responseText);
                },
            });
            document.getElementById("alert_erro").style.display = "none";

            document.getElementById("alert_sucesso").style.display = "block";

        } else {
            document.getElementById("alert_sucesso").style.display = "none";
            document.getElementById("alert_erro").style.display = "block";
        }

        let total_pedido = document.getElementById("totalPedido");
        this.valor_total = 0;
        this.valor_bebida = 0;
        this.valor_total_pedido = 0;

        total_pedido.innerText = `Valor do Pedido: R$ ${this.valor_total_pedido}`;

        let tbody = document.getElementById("tbody");
        let tbody2 = document.getElementById("tbody2");
        for (let i = 0; i < this.arrayProdutos.length; i++) {
            tbody.deleteRow(this.arrayProdutos.id);
        }
        for (let i = 0; i < this.arrayBebida.length; i++) {
            tbody2.deleteRow(this.arrayBebida.id);
        }

        this.arrayProdutos = [];
        this.arrayBebida = [];

        document.getElementById("msg").value = "";
        console.log("teste:", this.result);
        this.comanda(this.result);
    }

    lerDados(cod, pizza, preco, quantidade) {
        /* função para pegar os valores do input e jogar no objeto produto */
        document.getElementById("alert_sucesso").style.display = "none";
        document.getElementById("alert_erro").style.display = "none";
        let produto = {}; //objeto

        let tbody = document.getElementById("tbody");
        let already = false;

        for (let i = 0; i < this.arrayProdutos.length; i++) {
            console.log("teste:", this.arrayProdutos[i].id);
            if (this.arrayProdutos[i].id === cod) {
                already = true;
            }
        }

        this.valor_total += preco * quantidade;
        let total_pedido = document.getElementById("totalPedido");

        produto.id = cod;
        produto.pedido = this.pedido; //atributos
        produto.nomeProduto = pizza; //atributos
        produto.quantidade = quantidade; //atributos
        produto.preco = preco * quantidade;
        produto.already = already;

        this.valor_total_pedido += produto.preco;
        total_pedido.innerText = `Valor do Pedido: R$ ${this.valor_total_pedido}`;

        return produto; //retorna o objeto atributo para a variavel produto em salvar()
    }

    deletar(id) {
        for (let i = 0; i < this.arrayProdutos.length; i++) {
            if (this.arrayProdutos[i].id === id) {
                var nomePizza = this.arrayProdutos[i].nomeProduto;
            }
        }
        if (confirm("Deseja realmente deletar " + nomePizza)) {
            let tbody = document.getElementById("tbody");
            for (let i = 0; i < this.arrayProdutos.length; i++) {
                if (this.arrayProdutos[i].id === id) {
                    this.valor_total = this.valor_total - this.arrayProdutos[i].preco;
                    this.valor_total_pedido =
                        this.valor_total_pedido - this.arrayProdutos[i].preco;
                    this.arrayProdutos.splice(i, 1);
                    tbody.deleteRow(i);
                }
            }
        }
        let total_pedido = document.getElementById("totalPedido");
        total_pedido.innerText = `Valor do Pedido: R$ ${this.valor_total_pedido}`;
    }

    // TUDO ACIMA É A TABELA DO PEDIDO DE PIZZA.

    SalvarBebida(drink, preco, quantidade) {
        let bebida = this.lerDadosBebida(drink, preco, quantidade);

        this.adicionarBebida(bebida);
        this.listaTabelaBebida();
    }

    listaTabelaBebida() {
        let tbody2 = document.getElementById("tbody2");
        tbody2.innerText = "";

        for (let i = 0; i < this.arrayBebida.length; i++) {
            let tr = tbody2.insertRow(); //função para add linhas na tabela, tr no table

            let td_bebida = tr.insertCell();
            let td_quantidade = tr.insertCell();
            let td_valor = tr.insertCell();
            let td_acoes = tr.insertCell();

            td_bebida.innerText = this.arrayBebida[i].nomeDrink;
            td_valor.innerText = this.arrayBebida[i].precoDrink;
            td_quantidade.innerText = this.arrayBebida[i].quantidadeDrink;

            td_quantidade.classList.add("text-center");
            td_valor.classList.add("text-center");
            td_acoes.classList.add("text-center");

            let imgDelete = document.createElement("img");
            imgDelete.src = "_img/delete.png";
            imgDelete.setAttribute(
                "onclick",
                "produto.deletarBebida(" + this.arrayBebida[i].id + ")"
            );
            td_acoes.appendChild(imgDelete);
        }
    }

    adicionarBebida(bebida) {
        //função para adicionar a bebibda salva no array
        this.arrayBebida.push(bebida); //função '.push' é para adicionar algo no final do array e crescendo seu tamanho
        this.id_bebida++;
    }

    lerDadosBebida(drink, preco, quantidade) {
        /* função para pegar os valores do input e jogar no objeto bebida */
        var alerta = document.getElementById("alert");
        alerta.style.display = "none";
        let bebida = {}; //objeto

        let drinks = document.getElementById(drink).innerHTML;
        let quantidadesDrink = document.getElementById(quantidade).value;
        let precoDrink = document.getElementById(preco).value;
        if (quantidadesDrink <= 0) {
            quantidadesDrink.value = 1;
        }

        this.valor_bebida += precoDrink * quantidadesDrink;

        let total2 = document.getElementById("total2");
        total2.innerText = `Valor: R$ ${this.valor_bebida}`;

        let total_pedido = document.getElementById("totalPedido");

        bebida.id = this.id_bebida;
        bebida.pedido = this.pedido; //atributos
        bebida.nomeDrink = drinks; //atributos
        bebida.quantidadeDrink = quantidadesDrink; //atributos
        bebida.precoDrink = precoDrink * quantidadesDrink;

        this.valor_total_pedido += bebida.precoDrink;
        total_pedido.innerText = `Valor do Pedido: R$ ${this.valor_total_pedido}`;

        return bebida; //retorna o objeto atributo para a variavel produto em salvar
    }

    deletarBebida(id) {
        for (let i = 0; i < this.arrayBebida.length; i++) {
            if (this.arrayBebida[i].id === id) {
                var nomeDrink = this.arrayBebida[i].nomeDrink;
            }
        }
        if (confirm("Deseja realmente deletar " + nomeDrink)) {
            let tbody2 = document.getElementById("tbody2");
            for (let i = 0; i < this.arrayBebida.length; i++) {
                if (this.arrayBebida[i].id === id) {
                    this.valor_bebida =
                        this.valor_bebida - this.arrayBebida[i].precoDrink;
                    this.valor_total_pedido =
                        this.valor_total_pedido - this.arrayBebida[i].precoDrink;

                    this.arrayBebida.splice(i, 1);
                    tbody2.deleteRow(i);
                }
            }
        }
        let total2 = document.getElementById("total2");
        let total_pedido = document.getElementById("totalPedido");
        total_pedido.innerText = `Valor do Pedido: R$ ${this.valor_total_pedido}`;
        total2.innerText = `Valor: R$ ${this.valor_bebida}`;
    }

    // INICIANDO A PARTE DA COZINHA
    comanda(result) {
        //alert(result.nome);
        // console.log(result.Nome);
    }
}

var produto = new Produto(); //Instanciando a classe