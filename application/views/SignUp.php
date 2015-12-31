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

    <!-- Custom Fonts -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
          type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/count_up_timer.js"></script>
</head>
<body id="page-top" class="background">

<!-- Header -->
<?php include('Header.html'); ?>

<!-- Body -->

<section class="container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-center">Sign Up</h1>
            </div>
            <div class="modal-body">
                <table class="table text-left">
                    <tr>
                        <td>User Name :</td>
                        <td><input type="text" class="form-control"/></td>
                    </tr>
                    <tr>
                        <td>Password :</td>
                        <td><input type="password" class="form-control"/></td>
                    </tr>
                    <tr>
                        <td>Confirm Password :</td>
                        <td><input type="password" class="form-control"/></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-block" data-dismiss="modal" aria-hidden="true">Sign Up</button>
                    <span><a href="#">Need help?</a></span>
                </div>
            </div>
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