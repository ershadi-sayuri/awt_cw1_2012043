<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Advance Web Technology CW1 - 2012043</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../assets/css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
          type="text/css">
</head>
<body id="page-top" class="index">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header page-scroll">
            <img src="../../assets/img/profile_small.png">
            <a class="navbar-brand">Ershadi's PHP Quiz</a>
        </div>
    </div>
</nav>

<!-- Header -->
<header>
    <div class="container ">
        <div class="row">
            <div class="intro-text col-lg-12">
                <div class="col-lg-11">
                    <h2>Answer Sumamry</h2>
                    <table class="table">
                        <?php foreach ($query as $questions) { ?>
                            <tr>
                                <!-- question number -->
                                <td><?php echo $questions[0] ?></td>
                                <!-- correct or wrong -->
                                <td><?php echo $questions[1] ?></td>
                                <!-- answer description -->
                                <td><?php echo $questions[2] ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Footer -->
<footer class="text-center navbar-fixed-bottom">
    <div class="footer-below">
        <div class="row">
            <div class="col-lg-11">
                Copyright &copy; 2012043 Ershadi Sayuri
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll visible-xs visible-sm">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>
</body>
</html>