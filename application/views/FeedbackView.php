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
<body id="page-top" class="index">

<!-- Header -->
<?php include('HeaderMain.html'); ?>

<!-- body -->
<header>
    <div class="container text-center">
        <div class="row">
            <div class="intro-text col-lg-12">
                <div class="col-lg-11 boarder">
                    <span class="skills">Result</span></br>
                    <!-- correct answer count-->
                    <?php echo $query[0]; ?> of 10 </br>
                    <!-- correct percentage-->
                    <?php echo $query[0] * 10 ?>% </br>
                    <!-- feedback description-->
                    <?php echo $query[1] ?> </br>
                    <!-- time spent foe the quiz-->
                    Time spent &nbsp;<label id="minutes_f"></label>:<label id="seconds_f"></label>
                </div>
                </br>
                <form action="viewAnswerDescription" method="get">
                    <div class="col-lg-4">
                        <input class="btn btn-outline next-btn" type="submit" value="Check your answers"/>
                    </div>
                </form>
                <form action="viewProgress" method="get">
                    <div class="col-lg-4">
                        <input class="btn btn-outline next-btn" type="submit" value="View progress"/>
                    </div>
                </form>
                <form method="get" action="http://localhost/awt_cw1_2012043/index.php/question/loadTenQuestionIds">
                    <div class="col-lg-4">
                        <input class="btn btn-outline next-btn" type="submit" value="Try Again"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Footer -->
<?php include('Footer.html'); ?>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll visible-xs visible-sm">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>dr
    </a>
</div>
</body>
</html>