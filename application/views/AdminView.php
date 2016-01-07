<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->

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

        <div class="col-lg-9" style="display: none">
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

                                <div class="text-warning">* An integer value 0 or 1 indicating 0 for incorrect answer
                                    and
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
                            <td><input type="text"/></td>
                        </tr>
                        <tr>
                            <td>Answer 3</td>
                            <td><input type="text" size="70"/></td>
                        </tr>
                        <tr>
                            <td>Answer status</td>
                            <td><input type="text"/></td>
                        </tr>
                    </table>
                    <div class="text-right">
                        <button class="btn btn-primary text-left">Sign In</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="panel panel-default text-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">Manage questions</h2>
                </div>
                <div class="panel-body">
                    <div class="center-block">
                        <div class="input-group">
                            <div class="input-group">
                                <input type="text" id="searchText" class="form-control" placeholder="Search question..."
                                       size="90"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button">Go</button>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div id="table"></div>
                </div>
            </div>

            <div class="col-lg-9" style="display: none">
                <div class="panel panel-default text-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title">Add new admin</h2>
                    </div>
                    <div class="panel-body">
                        <table class="table text-left">
                            <tr>
                                <td>Admin user name</td>
                                <td><input type="text"/></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>
                                    <input type="password"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Confirm password</td>
                                <td><input type="password"/></td>
                            </tr>
                        </table>
                        <div class="text-right">
                            <button class="btn btn-primary text-left">Save admin</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9" style="display: none">
                <div class="panel panel-default text-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title">Manage admins</h2>
                    </div>
                    <div class="panel-body">
                        <div class="center-block">
                            <div class="input-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search admin..." size="90"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button">Go</button>
                                        </span>
                                </div>
                                <div class="text-warning">* Enter admin name to search</div>
                            </div>
                        </div>
                        <table class="table text-left">
                            <col width="80%">
                            <col width="20%">
                            <tr>
                                <td>Admin1</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default">Edit</button>
                                        <button type="button" class="btn btn-default">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Admin2</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default">Edit</button>
                                        <button type="button" class="btn btn-default">Delete</button>
                                    </div>
                                </td>
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

<script type="text/template" id="question-list-template">
    <table class="table text-left">
        <col width="80%">
        <col width="20%">
        <% _.each(questions1, function(question) { %>
        <tr>
            <td><%= question.get('question_detail') %></td>
            <td>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default">Edit</button>
                    <button type="button" class="btn btn-default">Delete</button>
                </div>
            </td>
        </tr>
        <% }); %>
    </table>
</script>

<!-- Plugin JavaScript -->
<script src="../assets/js/classie.js"></script>
<script src="../assets/js/cbpAnimatedHeader.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone.js"></script>
<!--<script src="../bower_components/backbone.validation/src/backbone-validation.js"></script>-->

<script src="../assets/js/backbone/manageQuestions.js"></script>
</body>
</html>