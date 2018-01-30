<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="ICONE Sistema">
    <meta name="author" content="RPWEB">
    <link rel="shortcut icon" href="{{ URL::asset('assets/global/images/favicon.png') }}" type="image/png">
    <title>ICONE Sistema - Central</title>
    <link href="{{ URL::asset('assets/global/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/global/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/global/css/theme.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/global/css/ui.css') }}" rel="stylesheet">
    
    <!-- BEGIN PAGE STYLE -->
    <link href="{{ URL::asset('assets/global/plugins/datatables/dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/global/plugins/metrojs/metrojs.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/global/plugins/maps-amcharts/ammap/ammap.css') }}" rel="stylesheet">
    <!-- END PAGE STYLE -->
    <link href="{{ URL::asset('assets/global/plugins/step-form-wizard/css/step-form-wizard.min.css')}}" rel="stylesheet">
    <script src="{{ URL::asset('assets/global/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>
    <!-- BEGIN PAGE STYLE -->

    <link href="{{ URL::asset('assets/global/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
    <!-- END PAGE STYLE -->
    <style>
      .form-control.form-white,.form-control {
        border: 1px solid #949494;
      }
      

      .form-control.form-white:focus,.form-control:focus {
            outline: none !important;
            border:1px solid #008AE8;
            box-shadow: 0 0 5px #719ECE !important;
      }
  </style>
    <script>
        base_url = '{{URL::to('/')}}'
    </script>
  </head>
  <!-- LAYOUT: Apply "submenu-hover" class to body element to have sidebar submenu show on mouse hover -->
  <!-- LAYOUT: Apply "sidebar-collapsed" class to body element to have collapsed sidebar -->
  <!-- LAYOUT: Apply "sidebar-top" class to body element to have sidebar on top of the page -->
  <!-- LAYOUT: Apply "sidebar-hover" class to body element to show sidebar only when your mouse is on left / right corner -->
  <!-- LAYOUT: Apply "submenu-hover" class to body element to show sidebar submenu on mouse hover -->
  <!-- LAYOUT: Apply "fixed-sidebar" class to body to have fixed sidebar -->
  <!-- LAYOUT: Apply "fixed-topbar" class to body to have fixed topbar -->
  <!-- LAYOUT: Apply "rtl" class to body to put the sidebar on the right side -->
  <!-- LAYOUT: Apply "boxed" class to body to have your page with 1200px max width -->

  <!-- THEME STYLE: Apply "theme-sdtl" for Sidebar Dark / Topbar Light -->
  <!-- THEME STYLE: Apply  "theme sdtd" for Sidebar Dark / Topbar Dark -->
  <!-- THEME STYLE: Apply "theme sltd" for Sidebar Light / Topbar Dark -->
  <!-- THEME STYLE: Apply "theme sltl" for Sidebar Light / Topbar Light -->
  
  <!-- THEME COLOR: Apply "color-default" for dark color: #2B2E33 -->
  <!-- THEME COLOR: Apply "color-primary" for primary color: #319DB5 -->
  <!-- THEME COLOR: Apply "color-red" for red color: #C9625F -->
  <!-- THEME COLOR: Apply "color-green" for green color: #18A689 -->
  <!-- THEME COLOR: Apply "color-orange" for orange color: #B66D39 -->
  <!-- THEME COLOR: Apply "color-purple" for purple color: #6E62B5 -->
  <!-- THEME COLOR: Apply "color-blue" for blue color: #4A89DC -->
  <!-- BEGIN BODY -->
  <body class="fixed-topbar fixed-sidebar theme-sdtl color-default dashboard fixed-topbar bg-light-dark">
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section>
      <!-- BEGIN SIDEBAR -->
      <div class="sidebar">
        <div class="logopanel">
          <h1>
              ICONE
          </h1>
        </div>
        <div class="sidebar-inner">
          
          <div class="menu-title">
            Navegação 
          </div>
          <ul class="nav nav-sidebar">
            @can('permissao','HomeController@index')
            <li class=" nav-active active"><a href="{{url('central/home')}}"><i class="icon-home"></i><span>Dashboard</span></a></li>
            @endcan
            
            @can('permissao','ClienteController@index')
            <li class=""><a href="{{url('central/cliente')}}"><i class="icon-home"></i><span>Clientes</span></a></li>
            @endcan
            <li class="nav-parent">
              <a href="#"><i class="icon-puzzle"></i><span>Produtos</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                @can('permissao','ProdutoController@index')
                <li><a href="{{url('central/produto')}}"> Produtos</a></li>
                @endcan
                
                @can('permissao','CategoriaController@index')
                <li><a href="{{url('central/categoria')}}"> Categorias</a></li>
                @endcan
              </ul>
            </li>
            
            <li class="nav-parent">
              <a href="#"><i class="icon-puzzle"></i><span>Lojas</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                @can('permissao','LojaController@index')
                <li><a href="{{url('central/loja')}}">Lista</a></li>
                @endcan
                
                @can('permissao','EstoqueController@index')
                <li><a href="{{url('central/estoque/filterproduct')}}"> Estoque</a></li>
                @endcan
                
                @can('permissao','ChequeController@index')
                <li><a href="{{url('central/cheque')}}"> Cofre</a></li>
                @endcan
                <li><a href="{{url('central/pedidos/loja')}}"> Vendas Cheques</a></li>
              </ul>
            </li>

            <li class="nav-parent">
              <a href=""><i class="icon-layers"></i><span>Segurança</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                @can('permissao','UsuarioController@index')
                <li><a href="{{url('central/usuario')}}"> Usuários</a></li>
                @endcan
                
                @can('permissao','PermissaoController@index')
                <li><a href="{{url('central/configuracao/permissoes')}}">Permissões</a></li>
                @endcan
              </ul>
            </li>
            
            <li class="nav-parent">
              <a href=""><i class="icon-layers"></i><span>Caixa de mensagem</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                @can('permissao','UsuarioController@index')
                <li><a href="{{url('central/caixa-mensagem/create')}}"> Escrever</a></li>
                @endcan
              </ul>
            </li>

          </ul>

          <div class="sidebar-footer clearfix">
            <a class="pull-left footer-settings" href="#" data-rel="tooltip" data-placement="top" data-original-title="Configurações">
            <i class="icon-settings"></i></a>
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Tela Cheia">
            <i class="icon-size-fullscreen"></i></a>
            <a class="pull-left btn-effect" href="{{ url('central/login/logout') }}" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Sair">
            <i class="icon-power"></i></a>
          </div>
        </div>
      </div>
      <!-- END SIDEBAR -->
      <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
          <div class="header-left">
            <div class="topnav">
              <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
<!--              <ul class="nav nav-icons">
                <li><a href="#" class="toggle-sidebar-top"><span class="icon-user-following"></span></a></li>
                <li><a href="mailbox.html"><span class="octicon octicon-mail-read"></span></a></li>
                <li><a href="#"><span class="octicon octicon-flame"></span></a></li>
                <li><a href="builder-page.html"><span class="octicon octicon-rocket"></span></a></li>
              </ul>-->
            </div>
          </div>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">

              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img src="{{ URL::asset('assets/global/images/avatars/user1.png') }}" alt="user image">
                <span class="username">Oi, {{ explode(' ',Auth::user()->usu_nome)[0]}}</span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="{{ url('central/login/logout') }}"><i class="icon-logout"></i><span>Sair</span></a>
                  </li>
                </ul>
              </li>
              <!-- END USER DROPDOWN -->
            </ul>
          </div>
          <!-- header-right -->
        </div>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
            
          <div class="header">
            <h2>{{ $pagina or 'Página'}} <strong>{{ $titulo or 'Título'}}</strong></h2>
<!--            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="#">Make</a>
                </li>
                <li><a href="#">Forms</a>
                </li>
                <li class="active">Forms Validation</li>
              </ol>
            </div>-->
          </div>
            
          @yield('content')
<!--          <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset">
                <span>Copyright <span class="copyright">©</span> 2016 </span>
                <span>THEMES LAB</span>.
                <span>All rights reserved. </span>
              </p>
              <p class="pull-right sm-pull-reset">
                <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
              </p>
            </div>
          </div>-->
        </div>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END MAIN CONTENT -->
      <!-- BEGIN BUILDER -->
      <div class="builder hidden-sm hidden-xs" id="builder">
        <a class="builder-toggle"><i class="icon-wrench"></i></a>
        <div class="inner">
          <div class="builder-container">
            <a href="#" class="btn btn-sm btn-default" id="reset-style">Reset</a>
            <h4>Layout opções</h4>

            <h4 class="border-top">Cores</h4>
            <div class="row">
              <div class="col-xs-12">
                <div class="theme-color bg-dark" data-main="default" data-color="#2B2E33"></div>
                <div class="theme-color background-primary" data-main="primary" data-color="#319DB5"></div>
                <div class="theme-color bg-red" data-main="red" data-color="#C75757"></div>
                <div class="theme-color bg-green" data-main="green" data-color="#1DA079"></div>
                <div class="theme-color bg-orange" data-main="orange" data-color="#D28857"></div>
                <div class="theme-color bg-purple" data-main="purple" data-color="#B179D7"></div>
                <div class="theme-color bg-blue" data-main="blue" data-color="#4A89DC"></div>
              </div>
            </div>
            <h4 class="border-top">Tema</h4>
            <div class="row row-sm">
              <div class="col-xs-6">
                <div class="theme clearfix sdtl" data-theme="sdtl">
                  <div class="header theme-left"></div>
                  <div class="header theme-right-light"></div>
                  <div class="theme-sidebar-dark"></div>
                  <div class="bg-light"></div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="theme clearfix sltd" data-theme="sltd">
                  <div class="header theme-left"></div>
                  <div class="header theme-right-dark"></div>
                  <div class="theme-sidebar-light"></div>
                  <div class="bg-light"></div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="theme clearfix sdtd" data-theme="sdtd">
                  <div class="header theme-left"></div>
                  <div class="header theme-right-dark"></div>
                  <div class="theme-sidebar-dark"></div>
                  <div class="bg-light"></div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="theme clearfix sltl" data-theme="sltl">
                  <div class="header theme-left"></div>
                  <div class="header theme-right-light"></div>
                  <div class="theme-sidebar-light"></div>
                  <div class="bg-light"></div>
                </div>
              </div>
            </div>
            <h4 class="border-top">Background</h4>
            <div class="row">
              <div class="col-xs-12">
                <div class="bg-color bg-clean" data-bg="clean" data-color="#F8F8F8"></div>
                <div class="bg-color bg-lighter" data-bg="lighter" data-color="#EFEFEF"></div>
                <div class="bg-color bg-light-default" data-bg="light-default" data-color="#E9E9E9"></div>
                <div class="bg-color bg-light-blue" data-bg="light-blue" data-color="#E2EBEF"></div>
                <div class="bg-color bg-light-purple" data-bg="light-purple" data-color="#E9ECF5"></div>
                <div class="bg-color bg-light-dark" data-bg="light-dark" data-color="#DCE1E4"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- BEGIN QUICKVIEW SIDEBAR -->
    <div id="quickview-sidebar">
      <div class="quickview-header">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#chat" data-toggle="tab">Chat</a></li>
          <li><a href="#notes" data-toggle="tab">Notes</a></li>
          <li><a href="#settings" data-toggle="tab" class="settings-tab">Settings</a></li>
        </ul>
      </div>
      <div class="quickview">
        <div class="tab-content">
          <div class="tab-pane fade active in" id="chat">
            <div class="chat-body current">
              <div class="chat-search">
                <form class="form-inverse" action="#" role="search">
                  <div class="append-icon">
                    <input type="text" class="form-control" placeholder="Search contact...">
                    <i class="icon-magnifier"></i>
                  </div>
                </form>
              </div>
              <div class="chat-groups">
                <div class="title">GROUP CHATS</div>
                <ul>
                  <li><i class="turquoise"></i> Favorites</li>
                  <li><i class="turquoise"></i> Office Work</li>
                  <li><i class="turquoise"></i> Friends</li>
                </ul>
              </div>
              <div class="chat-list">
                <div class="title">FAVORITES</div>
                <ul>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="{{ URL::asset('assets/global/images/avatars/avatar13.png') }}" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Bobby Brown</div>
                      <div class="user-txt">On the road again...</div>
                    </div>
                    <div class="user-status">
                      <i class="online"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="{{ URL::asset('assets/global/images/avatars/avatar5.png') }}" alt="avatar" />
                      <div class="pull-right badge badge-danger">3</div>
                    </div>
                    <div class="user-details">
                      <div class="user-name">Alexa Johnson</div>
                      <div class="user-txt">Still at the beach</div>
                    </div>
                    <div class="user-status">
                      <i class="away"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="{{ URL::asset('assets/global/images/avatars/avatar10.png') }}" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Bobby Brown</div>
                      <div class="user-txt">On stage...</div>
                    </div>
                    <div class="user-status">
                      <i class="busy"></i>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="chat-list">
                <div class="title">FRIENDS</div>
                <ul>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="{{ URL::asset('assets/global/images/avatars/avatar7.png') }}" alt="avatar" />
                      <div class="pull-right badge badge-danger">3</div>
                    </div>
                    <div class="user-details">
                      <div class="user-name">James Miller</div>
                      <div class="user-txt">At work...</div>
                    </div>
                    <div class="user-status">
                      <i class="online"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="{{ URL::asset('assets/global/images/avatars/avatar11.png') }}" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Fred Smith</div>
                      <div class="user-txt">Waiting for tonight</div>
                    </div>
                    <div class="user-status">
                      <i class="offline"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="{{ URL::asset('assets/global/images/avatars/avatar8.png') }}" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Ben Addams</div>
                      <div class="user-txt">On my way to NYC</div>
                    </div>
                    <div class="user-status">
                      <i class="offline"></i>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="chat-conversation">
              <div class="conversation-header">
                <div class="user clearfix">
                  <div class="chat-back">
                    <i class="icon-action-undo"></i>
                  </div>
                  <div class="user-details">
                    <div class="user-name">James Miller</div>
                    <div class="user-txt">On the road again...</div>
                  </div>
                </div>
              </div>
              <div class="conversation-body">
                <ul>
                  <li class="img">
                    <div class="chat-detail">
                      <span class="chat-date">today, 10:38pm</span>
                      <div class="conversation-img">
                        <img src="{{ URL::asset('assets/global/images/avatars/avatar4.png') }}" alt="avatar 4"/>
                      </div>
                      <div class="chat-bubble">
                        <span>Hi you!</span>
                      </div>
                    </div>
                  </li>
                  <li class="img">
                    <div class="chat-detail">
                      <span class="chat-date">today, 10:45pm</span>
                      <div class="conversation-img">
                        <img src="{{ URL::asset('assets/global/images/avatars/avatar4.png') }}" alt="avatar 4"/>
                      </div>
                      <div class="chat-bubble">
                        <span>Are you there?</span>
                      </div>
                    </div>
                  </li>
                  <li class="img">
                    <div class="chat-detail">
                      <span class="chat-date">today, 10:51pm</span>
                      <div class="conversation-img">
                        <img src="{{ URL::asset('assets/global/images/avatars/avatar4.png') }}" alt="avatar 4"/>
                      </div>
                      <div class="chat-bubble">
                        <span>Send me a message when you come back.</span>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="conversation-message">
                <input type="text" placeholder="Your message..." class="form-control form-white send-message" />
                <div class="item-footer clearfix">
                  <div class="footer-actions">
                    <i class="icon-rounded-marker"></i>
                    <i class="icon-rounded-camera"></i>
                    <i class="icon-rounded-paperclip-oblique"></i>
                    <i class="icon-rounded-alarm-clock"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="notes">
            <div class="list-notes current withScroll">
              <div class="notes ">
                <div class="row">
                  <div class="col-md-12">
                    <div id="add-note">
                      <i class="fa fa-plus"></i>ADD A NEW NOTE
                    </div>
                  </div>
                </div>
                <div id="notes-list">
                  <div class="note-item media current fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Reset my account password</p>
                      </div>
                      <p class="note-desc hidden">Break security reasons.</p>
                      <p><small>Tuesday 6 May, 3:52 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Call John</p>
                      </div>
                      <p class="note-desc hidden">He have my laptop!</p>
                      <p><small>Thursday 8 May, 2:28 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Buy a car</p>
                      </div>
                      <p class="note-desc hidden">I'm done with the bus</p>
                      <p><small>Monday 12 May, 3:43 am</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Don't forget my notes</p>
                      </div>
                      <p class="note-desc hidden">I have to read them...</p>
                      <p><small>Wednesday 5 May, 6:15 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media current fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Reset my account password</p>
                      </div>
                      <p class="note-desc hidden">Break security reasons.</p>
                      <p><small>Tuesday 6 May, 3:52 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Call John</p>
                      </div>
                      <p class="note-desc hidden">He have my laptop!</p>
                      <p><small>Thursday 8 May, 2:28 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Buy a car</p>
                      </div>
                      <p class="note-desc hidden">I'm done with the bus</p>
                      <p><small>Monday 12 May, 3:43 am</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Don't forget my notes</p>
                      </div>
                      <p class="note-desc hidden">I have to read them...</p>
                      <p><small>Wednesday 5 May, 6:15 pm</small></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="detail-note note-hidden-sm">
              <div class="note-header clearfix">
                <div class="note-back">
                  <i class="icon-action-undo"></i>
                </div>
                <div class="note-edit">Edit Note</div>
                <div class="note-subtitle">title on first line</div>
              </div>
              <div id="note-detail">
                <div class="note-write">
                  <textarea class="form-control" placeholder="Type your note here"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="settings">
            <div class="settings">
              <div class="title">ACCOUNT SETTINGS</div>
              <div class="setting">
                <span> Show Personal Statut</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
                <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
              </div>
              <div class="setting">
                <span> Show my Picture</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
                <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
              </div>
              <div class="setting">
                <span> Show my Location</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
                <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
              </div>
              <div class="title">CHAT</div>
              <div class="setting">
                <span> Show User Image</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="setting">
                <span> Show Fullname</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="setting">
                <span> Show Location</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="setting">
                <span> Show Unread Count</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="title">STATISTICS</div>
              <div class="settings-chart">
                <div class="progress visible">
                  <progress class="progress-bar-primary stat1" value="82" max="100"></progress>
                  <div class="progress-info">
                    <span class="progress-name">Stat 1</span>
                    <span class="progress-value">82%</span>
                  </div>
                </div>
              </div>
              <div class="settings-chart">
                <div class="progress visible">
                  <progress class="progress-bar-primary stat1" value="43" max="100"></progress>
                  <div class="progress-info">
                    <span class="progress-name">Stat 2</span>
                    <span class="progress-value">43%</span>
                  </div>
                </div>
              </div>
              <div class="m-t-30" style="width:100%">
                <canvas id="setting-chart" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END QUICKVIEW SIDEBAR -->
    <!-- BEGIN SEARCH -->
    <div id="morphsearch" class="morphsearch">
      <form class="morphsearch-form">
        <input class="morphsearch-input" type="search" placeholder="Search..."/>
        <button class="morphsearch-submit" type="submit">Search</button>
      </form>
      <div class="morphsearch-content withScroll">
        <div class="dummy-column user-column">
          <h2>Users</h2>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/avatars/avatar1_big.png') }}" alt="Avatar 1"/>
            <h3>John Smith</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/avatars/avatar2_big.png') }}" alt="Avatar 2"/>
            <h3>Bod Dylan</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/avatars/avatar3_big.png') }}" alt="Avatar 3"/>
            <h3>Jenny Finlan</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/avatars/avatar4_big.png') }}" alt="Avatar 4"/>
            <h3>Harold Fox</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/avatars/avatar5_big.png') }}" alt="Avatar 5"/>
            <h3>Martin Hendrix</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/avatars/avatar6_big.png') }}" alt="Avatar 6"/>
            <h3>Paul Ferguson</h3>
          </a>
        </div>
        <div class="dummy-column">
          <h2>Articles</h2>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/gallery/1.jpg') }}" alt="1"/>
            <h3>How to change webdesign?</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/gallery/2.jpg') }}" alt="2"/>
            <h3>News From the sky</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/gallery/3.jpg') }}" alt="3"/>
            <h3>Where is the cat?</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/gallery/4.jpg') }}" alt="4"/>
            <h3>Just another funny story</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/gallery/5.jpg') }}" alt="5"/>
            <h3>How many water we drink every day?</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/gallery/6.jpg') }}" alt="6"/>
            <h3>Drag and drop tutorials</h3>
          </a>
        </div>
        <div class="dummy-column">
          <h2>Recent</h2>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/gallery/7.jpg') }}" alt="7"/>
            <h3>Design Inspiration</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/gallery/8.jpg') }}" alt="8"/>
            <h3>Animals drawing</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/gallery/9.jpg') }}" alt="9"/>
            <h3>Cup of tea please</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/gallery/10.jpg') }}" alt="10"/>
            <h3>New application arrive</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/gallery/11.jpg') }}" alt="11"/>
            <h3>Notification prettify</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="{{ URL::asset('assets/global/images/gallery/12.jpg') }}" alt="12"/>
            <h3>My article is the last recent</h3>
          </a>
        </div>
      </div>
      <!-- /morphsearch-content -->
      <span class="morphsearch-close"></span>
    </div>
    <!-- END SEARCH -->
    <!-- BEGIN PRELOADER -->
    <div class="loader-overlay">
      <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>
    <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    <script src="{{ URL::asset('assets/global/plugins/jquery/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery/jquery-migrate-3.0.0.min.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/gsap/main-gsap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/tether/js/tether.min.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/appear/jquery.appear.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery-cookies/jquery.cookies.min.js') }}"></script> <!-- Jquery Cookies, for theme -->
    <script src="{{ URL::asset('assets/global/plugins/jquery-block-ui/jquery.blockUI.min.js') }}"></script> <!-- simulate synchronous behavior when using AJAX -->
    <script src="{{ URL::asset('assets/global/plugins/bootbox/bootbox.min.js') }}"></script> <!-- Modal with Validation -->
    <script src="{{ URL::asset('assets/global/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script> <!-- Custom Scrollbar sidebar -->
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js') }}"></script> <!-- Show Dropdown on Mouseover -->
    <script src="{{ URL::asset('assets/global/plugins/charts-sparkline/sparkline.min.js') }}"></script> <!-- Charts Sparkline -->
    <script src="{{ URL::asset('assets/global/plugins/retina/retina.min.js') }}"></script> <!-- Retina Display -->
    <!--<script src="{{ URL::asset('assets/global/plugins/select2/dist/js/select2.full.min.js') }}"></script>  Select Inputs -->
    <script src="{{ URL::asset('assets/global/plugins/icheck/icheck.min.js') }}"></script> <!-- Checkbox & Radio Inputs -->
    <script src="{{ URL::asset('assets/global/plugins/backstretch/backstretch.min.js') }}"></script> <!-- Background Image -->
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script> <!-- Animated Progress Bar -->
    <script src="{{ URL::asset('assets/global/js/builder.js') }}"></script> <!-- Theme Builder -->
    <script src="{{ URL::asset('assets/global/js/sidebar_hover.js') }}"></script> <!-- Sidebar on Hover -->
    <script src="{{ URL::asset('assets/global/js/application.js') }}"></script> <!-- Main Application Script -->
    
    <script src="{{ URL::asset('assets/global/js/widgets/notes.js') }}"></script> <!-- Notes Widget -->
    <script src="{{ URL::asset('assets/global/js/quickview.js') }}"></script> <!-- Chat Script -->
    <script src="{{ URL::asset('assets/global/js/pages/search.js') }}"></script> <!-- Search Script -->
    <!-- BEGIN PAGE SCRIPT -->
    <script src="{{ URL::asset('assets/global/plugins/metrojs/metrojs.min.js') }}"></script> <!-- Flipping Panel -->
<!--    <script src="{{ URL::asset('assets/global/plugins/noty/jquery.noty.packaged.min.js') }}"></script>   Notifications -->
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-editable/js/bootstrap-editable.min.js') }}"></script> <!-- Inline Edition X-editable -->
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-context-menu/bootstrap-contextmenu.min.js') }}"></script> <!-- Context Menu -->
    <script src="{{ URL::asset('assets/global/plugins/multidatepicker/multidatespicker.min.js') }}"></script> <!-- Multi dates Picker -->
    <script src="{{ URL::asset('assets/global/plugins/charts-chartjs/Chart.min.js') }}"></script>  <!-- ChartJS Chart -->
    <script src="{{ URL::asset('assets/global/plugins/charts-highstock/js/highstock.js') }}"></script> <!-- financial Charts -->
    <script src="{{ URL::asset('assets/global/plugins/charts-highstock/js/modules/exporting.js') }}"></script> <!-- Financial Charts Export Tool -->
    <script src="{{ URL::asset('assets/global/plugins/maps-amcharts/ammap/ammap.js') }}"></script> <!-- Vector Map -->
    <script src="{{ URL::asset('assets/global/plugins/maps-amcharts/ammap/maps/js/worldLow.js') }}"></script> <!-- Vector World Map  -->
    <script src="{{ URL::asset('assets/global/plugins/maps-amcharts/ammap/themes/black.js') }}"></script> <!-- Vector Map Black Theme -->
    <script src="{{ URL::asset('assets/global/plugins/skycons/skycons.min.js') }}"></script> <!-- Animated Weather Icons -->
    <script src="{{ URL::asset('assets/global/plugins/simple-weather/jquery.simpleWeather.js') }}"></script> <!-- Weather Plugin -->
    <script src="{{ URL::asset('assets/global/js/widgets/todo_list.js') }}"></script>
    <script src="{{ URL::asset('assets/global/js/widgets/widget_weather.js') }}"></script>
    <script src="{{ URL::asset('assets/global/js/pages/dashboard.js') }}"></script>

    <!-- BEGIN NOTIFICATION SCRIPT -->
    <script src="{{ URL::asset('assets/global/plugins/noty/jquery.noty.packaged.min.js') }}"></script>  <!-- Notifications -->
    <script src="{{ URL::asset('js/notificacao.js') }}" type="text/javascript"></script>
    <!-- END NOTIFICATION SCRIPTS -->

    <!-- END PAGE SCRIPT -->
    <script src="{{ URL::asset('assets/admin/layout1/js/layout.js') }}"></script>
    <!-- BEGIN INPUT MASK SCRIPT -->
    <script src="{{ URL::asset('js/jquery.mask.min.js') }}" type="text/javascript"></script>
    <!-- END BEGIN INPUT MASK SCRIPT -->
    
    <script src="{{ URL::asset('assets/global/plugins/datatables/jquery.dataTables.min.js')}}"></script> <!-- Tables Filtering, Sorting & Editing -->
    <script src="{{ URL::asset('assets/global/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/global/js/pages/table_dynamic.js')}}"></script>
    <script src="{{ URL::asset('assets/global/plugins/summernote/summernote.min.js')}}"></script> <!-- Simple HTML Editor -->
    <script src="{{ URL::asset('js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/js/plugins.js?n=1') }}"></script> <!-- Main Plugin Initialization Script -->
    <script type="text/javascript">
        $(function() {
		$(".select-search").select2();          
        });
    </script>
    @stack('scripts')
    
  </body>
</html>

