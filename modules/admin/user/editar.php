<?php
include"modules/admin/widgets/header.php";
include"modules/admin/widgets/sidebar.php";
$user = new \modules\admin\user\models\DBUser;

$dataU = $user->selectUser($id);

?>
<style>
    .col-md-6{
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
    }
    .demo-card-image.mdl-card {
        width: 256px;
        height: 256px;
        background: url('<?=$endereco?>includes/img/tumblr_nugarh0Kql1ti4wako1_540.gif') center / cover;
    }
    .demo-card-image > .mdl-card__actions {
        height: 52px;
        padding: 16px;
        background: rgba(0, 0, 0, 0.2);
    }
    .demo-card-image__filename {
        color: #fff;
        font-size: 14px;
        font-weight: 500;
    }

    .card-create-user.mdl-card {
        width: 512px;
    }
    .card-create-user > .mdl-card__title {
        color: #000;
        height: 56px;
        text-align: center;
        /*background: url('<?=$endereco?>includes/img/LOGO.png') no-repeat center;*/
        background-size: 60%;
    }
    .card-create-user > .mdl-card__menu {
        color: #fff;
    }

    .card-create-user .mdl-card__supporting-text input, .card-create-user .mdl-card__supporting-text select {
        padding: 10px;
        margin: 5px 0;
        outline: none;
        font-size: 16px;
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
    }

</style>


    <div class="row" style="margin-top: 40px;">
        <div class="col-md-10 col-md-offset-2">
            <div class="col-md-6 col-md-offset-2">
                <form id="send-user" class="col-md-12">
                    <!-- Wide card with share menu button -->
                    <div class="card-create-user mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title text-center">
                            <h3 >Atualizando Dados</h3>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <input class='col-md-12' type="text" id="name" name="name" value="<?=$dataU['name']?>" placeholder="Usuário" required="">
                            <input class='col-md-12' type="email" id="email" name="email" value="<?=$dataU['email']?>" placeholder="E-mail" required="">
                            <input class='col-md-12' type="password" id='pass' name="pass" placeholder="Senha">
                            <input class='col-md-12' type="password" id='pass2' placeholder="re-Senha">
                            <input type="hidden" name="id_user" value="<?=$id?>">
                        </div>
                        <div class="mdl-card__actions mdl-card--border col-md-12 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Salvar alterações
                            </button>
                        </div>
                        <div class="mdl-card__menu ">
                            <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                                <i class="material-icons">share</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!--lista de ativos-->
        </div>
    </div>

<script>
    $(function(){
        $("#send-user").on("submit",function(){
            event.preventDefault();
            var data = $( this ).serialize();

            var pass = $("#pass");
            var pass2 = $("#pass2");


            if((pass.val() != pass2.val())){
                notification.error('Senhas incorretas.');
                console.log('oxe cadê?');
            }else{
                $.ajax({
                    type: 'post',
                    url: '<?=$endereco?>admin/user/controller/edit.php',
                    data: data,
                    datatype: 'html',
                    success: function(t){
                        console.log(t);
                        notification.ok('Usuário alterado com sucesso!!');
                        setTimeout(function(){ window.location.href = "<?=$site?>admin/user"; },2000);
                    },
                    error: function(){
                        notification.ok('Error ao salvar o usuário!!');
                    }
                });
            }
        });


        $(".btn-custom").on("click",function(){
            event.preventDefault();
            var url = $( this ).data("url");
            var id = $( this ).data("id");
            var msg = $( this ).data("msg");

            $.ajax({
                type: 'post',
                url: url,
                data: 'id='+id,
                datatype: 'html',
                success: function(t){
                    console.log(t);
                    //notification.ok(msg);
                   // window.location.reload();
                },
                error: function(){
                    notification.ok('Houve algum erro no sistema, talvés seja a internet...');
                }
            });

        });


    });


</script>

<?php
include"modules/admin/widgets/rodape.php";
?>
