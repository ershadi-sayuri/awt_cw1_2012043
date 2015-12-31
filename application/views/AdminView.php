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
<body id="page-top">

<!-- Header -->
<?php include('Header.html'); ?>

<!-- Body -->
<header id="home">
    <div class="container text-center">
        <div class="col-lg-3">
            <ul class="list-group">
                <a href="#" class="list-group-item">Add new question</a>
                <a href="#" class="list-group-item">Manage questions</a>
                <a href="#" class="list-group-item">Add new admin</a>
                <a href="#" class="list-group-item">Manage admins</a>
                <a class="list-group-item"><img class="img-responsive" src="../assets/img/profile.png" alt=""></a>
            </ul>
        </div>
        <div class="col-lg-9">
            <div class="panel panel-default text-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">Add new question</h2>
                </div>
                <div class="panel-body">
                    <table class="table text-left">
                        <tr>
                            <td colspan="2">
                                <div class="text-info">Fill in the question details below</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Question</td>
                            <td><input type="text" size="70"/></td>
                        </tr>
                        <tr>
                            <td>Difficulty level</td>
                            <td>
                                <input type="text"/>
                                <div class="text-warning">* An integer value from 1, 2 or 3 and 1 is easy while 3 is the
                                    difficult
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Explanation</td>
                            <td><input type="text" size="70"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="text-info">Fill in the answer details below</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Answer 1</td>
                            <td><input type="text" size="70"/></td>
                        </tr>
                        <tr>
                            <td>Answer status</td>
                            <td>
                                <input type="text"/>
                                <div class="text-warning">* An integer value 0 or 1 indicating 0 for incorrect answer and
                                    1 for correct answer.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Answer 2</td>
                            <td><input type="text" size="70"/></td>
                        </tr>
                        <tr>
                            <td>Answer status</td>
                            <td> <input type="text"/></td>
                        </tr>
                        <tr>
                            <td>Answer 3</td>
                            <td><input type="text" size="70"/></td>
                        </tr>
                        <tr>
                            <td>Answer status</td>
                            <td> <input type="text"/></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Footer -->
<?php include('Footer.html'); ?>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll visible-xs visible-sm">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

<!-- Plugin JavaScript -->
<script src="../assets/js/classie.js"></script>
<script src="../assets/js/cbpAnimatedHeader.js"></script>
</body>
</html>