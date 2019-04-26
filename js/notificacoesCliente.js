
//NOTIFICAÇOES DE PEDIDOS DE SERVIÇO
    document.addEventListener('DOMContentLoaded', function(){
        var icon_not = document.getElementsByClassName('notifs')[0],
            dp       = document.getElementsByClassName('dp')[0],
            dp1          = document.getElementsByClassName('dpMsg')[0],
            btn_not  = document.getElementsByClassName('addnot')[0],
            id_user  = document.getElementById('id_user'),
            total_not= document.getElementsByClassName('ctnots')[0],
            res      = document.getElementById('res');

        icon_not.addEventListener('click', function(e){
            e.stopPropagation();
            dp.style.display = 'block';
            $(".dpMsg").hide();
        });

        document.addEventListener('click', function(){
            dp.style.display = 'none';
        });

        window.setInterval(function(){
            xhr.get('php/notificacoesPedidoseNegociacoes.php?acao=verificar', function(total){
                total_not.innerHTML = total;
            });
            
        }, 5000);

        window.setInterval(function(){
            xhr.get('php/notificacoesPedidoseNegociacoes.php?acao=getnots', function(nots){
                res.innerHTML = nots;
            });
            
        }, 5000);

    });
//----------------------------------------------------------------------//
               
//NOTIFICAÇOES DE MENSAGENS
    document.addEventListener('DOMContentLoaded', function(){
        var icon_not = document.getElementsByClassName('msgs')[0],
            dp       = document.getElementsByClassName('dpMsg')[0],
            dp1          = document.getElementsByClassName('dp')[0],
            btn_not  = document.getElementsByClassName('addnotMsg')[0],
            id_user  = document.getElementById('id_user'),
            total_not= document.getElementsByClassName('ctnotsMsg')[0],
            res      = document.getElementById('resMsg');

        icon_not.addEventListener('click', function(e){
            e.stopPropagation();
            dp.style.display = 'block';
            $(".dp").hide();
        });

        document.addEventListener('click', function(){
            dp.style.display = 'none';
        });

        window.setInterval(function(){
            xhr.get('php/notificacoesMensagens.php?acao=verificar', function(total){
                total_not.innerHTML = total;
            });
        }, 5000);

        window.setInterval(function(){
            xhr.get('php/notificacoesMensagens.php?acao=getnots', function(nots){
                res.innerHTML = nots;
            });
        }, 5000);

    });
//----------------------------------------------------------------------------------//