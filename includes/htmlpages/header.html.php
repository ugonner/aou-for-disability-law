<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
      xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
      xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>

    <?php if(!isset($description)){
        if(isset($title)){
            $description = $title;
        }else{
            $title = 'JONAPWD Group';
            $description = '';
        }
    }?>
    <meta name="description" content="<?php echo $description; ?>" />
    <title> <?php echo $title; ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="<?php echo $description; ?>" />
    <script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link rel="icon" href="/api/img/site-imgs/logo.jpg">

    <link href='//fonts.googleapis.com/css?family=Raleway:400,600,700' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->


    <link href="/api/css/bootstrap/bootstrap.css" rel='stylesheet' type='text/css' />
    <script src="/api/js/jquery.min.js"></script>
    <script src="/api/js/bootstrap.min.js"></script>
    <!--<script src="/api/js/jquery/jquery-3.1.1.min.js"></script>
        <script src="/api/js/bootstrap/bootstrap.min.js"></script>
        -->

    <!--start slider -->
    <link  rel="stylesheet" href="/api/css/fwslider.css" media="all">
    <script type="text/javascript" src="/api/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/api/js/fwslider.js"></script>
    <!--end slider -->

    <!-- Custom Theme files -->
    <link href="/api/css/style2.css" rel='stylesheet' type='text/css' />
    <link href="/api/css/style.css" rel='stylesheet' type='text/css' />
    <link href="/api/css/dlc-menu-style.css" rel='stylesheet' type='text/css' />


    <!-- animation-effect -->
    <link href="/api/css/animate.min.css" rel="stylesheet">
    <script src="/api/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!-- //animation-effect -->

    <!--adding tinymce js-->
    <?php if(isset($isadmin)):?>
        <script type="text/javascript" src="/api/js/tinymce/js/tinymce/tinymce.min.js"></script>
        <!--<script>tinymce.init({ selector:'textarea' });</script>-->
        <script type="text/javascript">
            tinymce.init({
                selector: "textarea#elm1",
                theme: "modern",
                width: 500,
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                content_css: "css/content.css",
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        </script>

    <?php endif;?>

    <style>
        /*overwritting classes*/
        a{
            /*color: firebrick !important;*/
            font-weight: bolder !important;
        }
        .bg-primary{
            /*background: darkslategray;*/

            background-image: linear-gradient(to right, black,gray,darkslategray,grey,black);
            /*background: url("/api/img/banner-3.jpg");*/
        }
        /*.dropdown-menu li a{
            color: #000000 !important;
        }*/
        .btn-info{
            background: #ffff00 !important;
            color: firebrick !important;
        }

        .secondary-color{
            color: #ffff00 !important;
        }
        .bg-transparent, .form-control, input{
            background: transparent !important;
            color: #f5f5f5 !important;
        }

        select.form-control{
            color: firebrick !important;
            font-weight: bolder !important;
        }

        .bg-success{
            background: green !important;
        }

        .side-nav-toggler{
            position: absolute;
            top: 50px;
            right: 0;
            z-index: 20;
        }

        .side-nav{
            position: absolute;
            top: 10px;
            width: 50px;
            z-index: 10;
        }

        .hover-btns{
            position: relative;
            width: 50px;
            transition: width 4s;
        }

        .hover-btns-content, .hover-btns-2-content{
            display: none;
            position: absolute;
            width: 200px;
            padding: 20px;
            z-index: 10;
            background: #000000;
            color: #f5f5f5;
        }

        .hover-btns-content, .hover-btns-2-content{
            top: 0%;
            left: 100%;
        }

        .hover-btns-content h3 a {
            text-decoration: none;
            color: greenyellow;
        }

        .hover-btns-2-content{
            bottom: 0%;
            right: 100%;
        }

        .hover-btns:hover, .hover-btns-2:hover{
            width: 70px;
        }

        .hover-btns:hover .hover-btns-content , .hover-btns-2:hover .hover-btns-2-content{
            display: inline-block;
        }

        /*home tab-images*/

        .tab-image{
            max-height: 400px !important;
        }
        /*@keyframes lengther{
            0%{width: 50px;}
            100%{width: 70px;}
        }
        @keyframes faders{
            0%{opacity: 0;}
            100%{opacity: 1;}
        }*/
        /*@media screen and (max-width: 678px){
            .dropdown-menu li a{
                color: #f0ad4e !important;
            }
        }*/

    </style>

    <!--from dyna-->
    <!--for text up and down-->
    <style type="text/css">

        /*Example CSS for the two demo scrollers*/

        #pscroller1{
            width: 400px;
            height: 100px;
            /*border: 1px solid black;*/
            padding: 5px;
            background-color: transparent;
            color: whitesmoke;
            margin: 5px;
        }

        #pscroller2{
            width: 350px;
            height: 100px;
            border: 1px solid black;
            padding: 3px;
            background: red;
        }

        #pscroller2 a{
            text-decoration: none;
        }

        .someclass{ //class to apply to your scroller(s) if desired
        }

    </style>

    <script type="text/javascript">

        /*Example message arrays for the two demo scrollers*/

        var pausecontent=new Array()
        pausecontent[0]=
            '<div class="container-fluid">' +
                ' <div class="col-xs-3">' +
                '<img src="/api/img/site-imgs/logo.jpg" class="img-responsive">' +
                '</div>' +
                '<div class="col-xs-9">' +
                ' <a href="/api/index-2.php"> Involve JONAPWD !</a><br> JONAPWD Anambra Nothing About Us Without Us, Involve JONAPWD' +
                '</div>' +
                '</div>' +
                '<br>&nbsp;'
        pausecontent[1]=
            '<div class="container-fluid">' +
                ' <div class="col-xs-3">' +
                '<img src="/api/img/site-imgs/logo.jpg" class="img-responsive">' +
                '</div>' +
                '<div class="col-xs-9">' +
                ' <a href="/api/index-2.php"> Up-To-Date !</a><br> JONAPWD Anambra Is here to bring you up to speed with current news and updates' +
                '</div>' +
                '</div>' +
                '<br>&nbsp;'
        pausecontent[2]=
            '<div class="container-fluid">' +
                ' <div class="col-xs-3">' +
                '<img src="/api/img/site-imgs/logo.jpg" class="img-responsive">' +
                '</div>' +
                '<div class="col-xs-9">' +
                ' <a href="/api/index-2.php"> Yes, Great !</a><br> Stand With You, Stand Up For Others' +
                '</div>' +
                '</div>' +
                '<br>&nbsp; '
        pausecontent[3]=
            '<div class="container-fluid">' +
                ' <div class="col-xs-3">' +
                '<img src="/api/img/site-imgs/logo.jpg" class="img-responsive">' +
                '</div>' +
                '<div class="col-xs-9">' +
                ' <a href="/api/index-2.php"> Wake To This !</a><br>There is Ability In Disability' +
                '</div>' +
                '</div>' +
                '<br>&nbsp; '
        pausecontent[4]=
            '<div class="container-fluid">' +
                ' <div class="col-xs-3">' +
                '<img src="/api/img/site-imgs/logo.jpg" class="img-responsive">' +
                '</div>'+
                '<div class="col-xs-9">' +
                ' <a href="/api/index-2.php"> Together For All !</a><br> Let us all move and move further' +
                '</div>' +
                '</div>' +
                '<br>&nbsp; '

        var pausecontent2=new Array()
        pausecontent2[0]='<a href="http://www.news.com/">News.com: Technology and business reports</a>'
        pausecontent2[1]='<a href="http://www.cnn.com/">CNN: Headline and breaking news 24/7</a>'
        pausecontent2[2]='<a href="http://news.bbc.co.uk/">BBC News: UK and international news</a>'

    </script>

    <script type="text/javascript">

        /***********************************************
         * Pausing up-down scroller- (c) Dynamic Drive (www.dynamicdrive.com)
         * Please keep this notice intact
         * Visit http://www.dynamicdrive.com/ for this script and 100s more.
         ***********************************************/

        function pausescroller(content, divId, divClass, delay){
            this.content=content //message array content
            this.tickerid=divId //ID of ticker div to display information
            this.delay=delay //Delay between msg change, in miliseconds.
            this.mouseoverBol=0 //Boolean to indicate whether mouse is currently over scroller (and pause it if it is)
            this.hiddendivpointer=1 //index of message array for hidden div
            document.write('<div id="'+divId+'" class="'+divClass+'" style="position: relative; overflow: hidden"><div class="innerDiv" style="position: absolute; width: 100%" id="'+divId+'1">'+content[0]+'</div><div class="innerDiv" style="position: absolute; width: 100%; visibility: hidden" id="'+divId+'2">'+content[1]+'</div></div>')
            var scrollerinstance=this
            if (window.addEventListener) //run onload in DOM2 browsers
                window.addEventListener("load", function(){scrollerinstance.initialize()}, false)
            else if (window.attachEvent) //run onload in IE5.5+
                window.attachEvent("onload", function(){scrollerinstance.initialize()})
            else if (document.getElementById) //if legacy DOM browsers, just start scroller after 0.5 sec
                setTimeout(function(){scrollerinstance.initialize()}, 500)
        }

        // -------------------------------------------------------------------
        // initialize()- Initialize scroller method.
        // -Get div objects, set initial positions, start up down animation
        // -------------------------------------------------------------------

        pausescroller.prototype.initialize=function(){
            this.tickerdiv=document.getElementById(this.tickerid)
            this.visiblediv=document.getElementById(this.tickerid+"1")
            this.hiddendiv=document.getElementById(this.tickerid+"2")
            this.visibledivtop=parseInt(pausescroller.getCSSpadding(this.tickerdiv))
//set width of inner DIVs to outer DIV's width minus padding (padding assumed to be top padding x 2)
            this.visiblediv.style.width=this.hiddendiv.style.width=this.tickerdiv.offsetWidth-(this.visibledivtop*2)+"px"
            this.getinline(this.visiblediv, this.hiddendiv)
            this.hiddendiv.style.visibility="visible"
            var scrollerinstance=this
            document.getElementById(this.tickerid).onmouseover=function(){scrollerinstance.mouseoverBol=1}
            document.getElementById(this.tickerid).onmouseout=function(){scrollerinstance.mouseoverBol=0}
            if (window.attachEvent) //Clean up loose references in IE
                window.attachEvent("onunload", function(){scrollerinstance.tickerdiv.onmouseover=scrollerinstance.tickerdiv.onmouseout=null})
            setTimeout(function(){scrollerinstance.animateup()}, this.delay)
        }


        // -------------------------------------------------------------------
        // animateup()- Move the two inner divs of the scroller up and in sync
        // -------------------------------------------------------------------

        pausescroller.prototype.animateup=function(){
            var scrollerinstance=this
            if (parseInt(this.hiddendiv.style.top)>(this.visibledivtop+5)){
                this.visiblediv.style.top=parseInt(this.visiblediv.style.top)-5+"px"
                this.hiddendiv.style.top=parseInt(this.hiddendiv.style.top)-5+"px"
                setTimeout(function(){scrollerinstance.animateup()}, 50)
            }
            else{
                this.getinline(this.hiddendiv, this.visiblediv)
                this.swapdivs()
                setTimeout(function(){scrollerinstance.setmessage()}, this.delay)
            }
        }

        // -------------------------------------------------------------------
        // swapdivs()- Swap between which is the visible and which is the hidden div
        // -------------------------------------------------------------------

        pausescroller.prototype.swapdivs=function(){
            var tempcontainer=this.visiblediv
            this.visiblediv=this.hiddendiv
            this.hiddendiv=tempcontainer
        }

        pausescroller.prototype.getinline=function(div1, div2){
            div1.style.top=this.visibledivtop+"px"
            div2.style.top=Math.max(div1.parentNode.offsetHeight, div1.offsetHeight)+"px"
        }

        // -------------------------------------------------------------------
        // setmessage()- Populate the hidden div with the next message before it's visible
        // -------------------------------------------------------------------

        pausescroller.prototype.setmessage=function(){
            var scrollerinstance=this
            if (this.mouseoverBol==1) //if mouse is currently over scoller, do nothing (pause it)
                setTimeout(function(){scrollerinstance.setmessage()}, 100)
            else{
                var i=this.hiddendivpointer
                var ceiling=this.content.length
                this.hiddendivpointer=(i+1>ceiling-1)? 0 : i+1
                this.hiddendiv.innerHTML=this.content[this.hiddendivpointer]
                this.animateup()
            }
        }

        pausescroller.getCSSpadding=function(tickerobj){ //get CSS padding value, if any
            if (tickerobj.currentStyle)
                return tickerobj.currentStyle["paddingTop"]
            else if (window.getComputedStyle) //if DOM2
                return window.getComputedStyle(tickerobj, "").getPropertyValue("padding-top")
            else
                return 0
        }

    </script>
    <!--end up-down scroll-->

</head>
<body class="bg-primary">
<!--<h3 class="panel-body" style="font-family: 'roboto', sans-serif;">
    </h3>
-->

<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="header-bottom">
        </div>

        <div class="navbar-main">

            <div class="container-fluid"  style="background: black !important;">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>

                    </button>

                    <!--<a class="navbar-brand" href="/">
                        <img src="/api/img/site-imgs/logo.jpg" style="width: 2em; height: 1.5em;">
                    </a>-->

                </div>

                <div id="navbar" class="navbar-collapse collapse pull-right" >

                    <ul class="nav navbar-nav" >

                        <li><a class="is-active btn btn-primary" href="">Home</a></li>
                        <li><a class="btn btn-sm " href="/api/paragraph/section.html.php">The Law</a></li>
                        <li><a class="btn btn-lg " href="/api/paragraph/uploadparagraph.html.php">Upload Paragraph</a></li>

                        <li class="has-child"><a class="btn" href="">About</a>
                            <ul class="submenu">
                                <li class="submenu-item"><a class="btn btn-primary" href="">
                                        History, Mission & Goals
                                    </a></li>
                                <li class="submenu-item"><a class="btn btn-primary" href="">
                                        Aims, Achievements & Challenges
                                    </a></li>
                            </ul>
                        </li>
                        <?php if(!isset($_SESSION["userid"])):?>
                            <li ><a class="btn btn-danger" href=""><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                            <li ><a class="btn btn-danger" href=""><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

                        <?php else: ?>
                            <li ><a class="btn btn-danger" href=""><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
                        <?php endif;?>
                    </ul>
                </div> <!-- /#navbar -->

            </div> <!-- /.container -->

        </div> <!-- /.navbar-main -->
    </nav>

</header>
<!-- /. main-header -->



