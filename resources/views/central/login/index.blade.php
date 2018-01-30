<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ICONE Sistema</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="" name="RPWEB" />
        <link rel="shortcut icon" href="{{ URL::asset('assets/global/images/favicon.png') }}">
        <link href="{{ URL::asset('assets/global/css/style.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/global/css/ui.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/global/plugins/bootstrap-loading/lada.min.css') }}" rel="stylesheet">
    </head>
    <body class="account2" data-page="login">
        <!-- BEGIN LOGIN BOX -->
        <div class="container" id="login-block">
            <i class="user-img" style="margin-top: 150px;"></i>
            <div class="account-info">
                <a href="dashboard.html" class="logo"></a> 
                <h3>Modular &amp; Flexivel.</h3>
                <ul>
                    <li><i class="icon-magic-wand"></i> Caracteristica 1 </li>
                    <li><i class="icon-magic-wand"></i> Caracteristica 2</li>
                    <li><i class="icon-magic-wand"></i> Caracteristica 3</li>
                    <li><i class="icon-magic-wand"></i> Caracteristica 4</li>
                </ul>
            </div>
            <div class="account-form">
                <form method="POST" action="{{ url('central/login/authenticate')}}" class="form-signin" role="form">
                    {{ csrf_field() }}
                    <h3><strong>Acesse</strong> sua conta</h3>
                    
                    
                    <div class="append-icon">
                        <input type="text" name="usu_usuario" id="name" class="form-control form-white username" placeholder="Digite seu usuário" required>
                        <i class="icon-user"></i>
                    </div>
                    
                    <div class="append-icon m-b-20">
                        <input type="password" name="usu_senha" class="form-control form-white password" placeholder="Digite sua senha" required>
                        <i class="icon-lock"></i>
                    </div>
                    <button type="submit" class="btn btn-lg btn-dark btn-rounded ladda-button" data-style="expand-left">Entrar</button>
                    <span class="forgot-password"><a id="password" href="account-forgot-password.html">Esqueceu sua senha?</a></span>
                </form>
                <form class="form-password" role="form">
                    <h3><strong>Trocar</strong> sua senha</h3>
                    <div class="append-icon m-b-20">
                        <input type="password" name="password" class="form-control form-white mail" placeholder="E-mail" required>
                        <i class="icon-lock"></i>
                    </div>
                    <button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Enviar link troca de senha</button>
                    <div class="clearfix m-t-60">
                        <p class="pull-left m-t-20 m-b-0"><a id="login" href="#">Tenho uma conta? Login</a></p>
                    </div>
                </form>
            </div>

        </div>
        <!-- END LOCKSCREEN BOX -->
        <p class="account-copyright">
            <span>Copyright © {{date('Y')}} </span><span>ICONE</span>.<span> Todos os direitos reservados.</span>
        </p>
       <script src="{{ URL::asset('assets/global/plugins/jquery/jquery-3.1.0.min.js') }}"></script>
        <script src="{{ URL::asset('assets/global/plugins/jquery/jquery-migrate-3.0.0.min.js') }}"></script>
        <script src="{{ URL::asset('assets/global/plugins/gsap/main-gsap.min.js') }}"></script>
        <script src="{{ URL::asset('assets/global/plugins/tether/js/tether.min.js') }}"></script>
        <script src="{{ URL::asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('assets/global/plugins/backstretch/backstretch.min.js') }}"></script>
        <script src="{{ URL::asset('assets/global/plugins/bootstrap-loading/lada.min.js') }}"></script>
        <script src="{{ URL::asset('assets/global/js/pages/login-v2.js') }}"></script>
    </body>
</html>