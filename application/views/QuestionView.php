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
<?php include('Header.html'); ?>

<!-- Header -->
<header>
    <div class="container">
        <div class="row">
            <form action="checkAnswers" method="get">
                <input type="hidden" name="question_number" value="<?php echo $query[0]->question_number ?>"/>
                <input type="hidden" name="question_id" value="<?php echo $query[0]->question_id ?>"/>

                <div class="progress-bar-default">
                    <div class="progress-bar-fill" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                         aria-valuemax="100" style="width: <?php echo ($query[0]->question_number - 1) * 10 ?>%">
                        <!-- progress bar-->
                        <?php echo ($query[0]->question_number - 1) * 10 ?>%
                    </div>
                </div>
                <div class="col-md-8 boarder">
                    <div class="intro-text">
                        <span class="skills">
                            <!-- question -->
                            <?php echo($query[0]->question_number . ") " . $query[0]->question) ?></span></br>
                        <?php foreach ($query[0]->answers as $answer) { ?>
                                    <!-- answers -->
                                    <input type="radio" name="answer" value="<?php echo $answer[1] ?>"/>
                                    <span class="skills"><?php echo $answer[0] ?></span></br>
                                    <?php
                                }
                        ?>
                        </br>
                        <!-- alert box -->
                        <?php if ($query[0]->answerProvided == false) { ?>
                            <div class="alert alert-danger" role="alert">Please select an answer and press next</div>
                        <?php } ?>
                        <div id="next-btn">
                            <?php if ($query[0]->question_number == 10) { ?>
                                <input class="btn btn-outline" type="submit" value="Submit" onclick="getLastTime()"/>
                            <?php } else { ?>
                                <input class="btn btn-outline" type="submit" value="Next" onclick="getLastTime()"/>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <!-- timer -->
                <div class="col-md-3 boarder text-center">
                    Time Spent
                    <h1>
                        <div id="clock">
                            <label id="minutes"></label>:<label id="seconds"></label>
                        </div>
                    </h1>
                </div>
            </form>
            <div class="col-md-6 top-padding">
                Total 10 questions
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
</body>
</html>