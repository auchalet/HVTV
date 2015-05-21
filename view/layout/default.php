<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo isset($title_for_layout)?$title_for_layout:'A l\'hôpital Velpo ?'; ?></title>
	
	<!-- core CSS -->
    <link href="<?php echo '/css/bootstrap.min.css';?>" rel="stylesheet">
    <link href="<?php echo '/css/font-awesome.min.css';?>" rel="stylesheet">
    <link href="<?php echo '/css/animate.min.css';?>" rel="stylesheet">
    <link href="<?php echo '/css/prettyPhoto.css';?>" rel="stylesheet">
    <link href="<?php echo '/css/main.css';?>" rel="stylesheet">
    <link href="<?php echo '/css/responsive.css';?>" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo 'images/ico/apple-touch-icon-144-precomposed.png';?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo 'images/ico/apple-touch-icon-114-precomposed.png';?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo 'images/ico/apple-touch-icon-72-precomposed.png';?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo 'images/ico/apple-touch-icon-57-precomposed.png';?>">
</head><!--/head-->

<body class="homepage">

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>  +0123 456 70 90</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php Router::url('actus/'); ?>"><img src="images/logo.png" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <?php 
                        
                        //var_dump($this);
                        $pagesMenu=$this->request('Pages','getMenu');
                        //var_dump($pagesMenu);
                        foreach ($pagesMenu as $p) {
                            echo '<li><a href="/pages/view/'.$p->id.'" title="'.$p->name.'">'.$p->name.'</a></li>';
                        }

                        ?>
                        <li class="active">
                            <a href="<?php echo '/actus'; ?>">Actualités</a>
                        </li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->


                <div class="container">
                    <?php
                        echo $content_for_layout;
                    ?>
                </div>
                

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="<?php echo 'js/jquery.js';?>"></script>
    <script src="<?php echo 'js/bootstrap.min.js';?>"></script>
    <script src="<?php echo 'js/jquery.prettyPhoto.js';?>"></script>
    <script src="<?php echo 'js/jquery.isotope.min.js';?>"></script>
    <script src="<?php echo 'js/main.js';?>"></script>
    <script src="<?php echo 'js/wow.min.js';?>"></script>
</body>
</html>