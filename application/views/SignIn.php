<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Advance Web Technology CW1 - 2012043</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/css/freelancer.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
          type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="../bower_components/underscore/underscore.js"></script>
    <script src="../bower_components/backbone/backbone.js"></script>
    <script src="../bower_components/backbone.validation/src/backbone-validation.js"></script>

    <script src="../assets/js/backbone/common.js"></script>

    <script src="../assets/js/backbone/models/signIn.js"></script>
    <script src="../assets/js/backbone/views/signInView.js"></script>

    <script src="../assets/js/backbone/signIn.js"></script>
</head>
<body id="page-top" class="background">

<!-- Header -->
<?php include('Header.html'); ?>

<!-- Body -->
<section class="container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-center">Sign In</h1>
            </div>
            <form class="form-horizontal text-left" role="form" id="signInForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username" class="col-lg-4">Username</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="username" name="username"/>
                            <span class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-4">Password</label>

                        <div class="col-lg-8">
                            <input type="password" class="form-control" id="password" name="password"/>
                            <span class="help-block hidden"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-md-12">
                            <button id="signInButton" class="btn btn-success btn-block">Sign In</button>
                            <span><a href="#">Need help?</a></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include('Footer.html'); ?>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll visible-xs visible-sm">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron   -up"></i>
    </a>
</div>

<!-- Plugin JavaScript -->
<script src="../assets/js/classie.js"></script>
<script src="../assets/js/cbpAnimatedHeader.js"></script>

</body>
</html>