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
                <form class="form-horizontal text-left" role="form">
                    <a id="addNewQuestion" class="list-group-item">Add new question</a>
                    <a id="manageQuestions" class="list-group-item">Manage questions</a>
                    <a id="addNewAdmin" class="list-group-item">Add new admin</a>
                    <a id="manageUsers" class="list-group-item">Manage users</a>
                </form>
                <a class="list-group-item"><img class="img-responsive" src="../assets/img/profile.png" alt=""></a>
            </ul>
        </div>

        <div id="content_right"></div>
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

<script type="text/template" id="new-question-template">
    <div class="col-lg-9">
        <div class="panel panel-default text-primary">
            <div class="panel-heading">
                <h2 class="panel-title">Add new question</h2>
            </div>
            <form class="form-horizontal text-left" role="form">
                <div class="panel-body text-left">
                    <div class="text-info">Fill in the question details below</div>
                    <div class="form-group">
                        <label for="question" class="col-lg-4">Question</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="question" name="question"/>
                            <span class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="difficultyLevel" class="col-lg-4">Difficulty level</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="difficultyLevel" name="difficultyLevel"/>
                            <span class="help-block hidden"></span>

                            <div class="text-warning">* An integer value from 1, 2 or 3 and 1 is easy while 3 is the
                                difficult
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="explanation" class="col-lg-4">Explanation</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="explanation" name="explanation"/>
                            <span class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="text-info">Fill in the answer details below</div>
                    <div class="form-group">
                        <label for="answer1" class="col-lg-4">Answer 1</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="answer1" name="answer1"/>
                            <span class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="answer1Status" class="col-lg-4">Answer status</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="answer1Status" name="answer1Status"/>
                            <span class="help-block hidden"></span>

                            <div class="text-warning">* An integer value 0 or 1 indicating 0 for incorrect answer
                                and 1 for correct answer.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="answer2" class="col-lg-4">Answer 2</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="answer2" name="answer2"/>
                            <span class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="answer2Status" class="col-lg-4">Answer status</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="answer2Status" name="answer2Status"/>
                            <span class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="answer3" class="col-lg-4">Answer 3</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="answer3" name="answer3"/>
                            <span class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="answer3Status" class="col-lg-4">Answer status</label>

                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="answer3Status" name="answer3Status"/>
                            <span class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button id="saveQuestionButton" class="btn btn-success">Save question</button>
                        </div>
                    </div>
                    <div id="questionSaveMessage" class="text-left"></div>
                </div>
            </form>
        </div>
    </div>
</script>

<script type="text/template" id="question-list-template">
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
            </div>
        </div>
    </div>
</script>

<script type="text/template" id="new-admin-template">
    <div class="col-lg-9">
        <div class="panel panel-default text-primary">
            <div class="panel-heading">
                <h2 class="panel-title">Add new admin</h2>
            </div>
            <form class="form-horizontal text-left" role="form">
                <div class="panel-body text-left">
                    <div class="form-group">
                        <label for="username" class="col-lg-4">Admin Username</label>

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
                    <div class="form-group">
                        <label for="repeatPassword" class="col-lg-4">Repeat Password</label>

                        <div class="col-lg-8">
                            <input type="password" class="form-control" id="repeatPassword" name="repeatPassword"/>
                            <span class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button id="saveAdminButton" class="btn btn-success">Save admin</button>
                        </div>
                    </div>
                    <div id="signUpMessage" class="text-left"></div>
                </div>
            </form>
        </div>
    </div>
</script>

<script type="text/template" id="user-list-template">
    <div class="col-lg-9">
        <div class="panel panel-default text-primary">
            <div class="panel-heading">
                <h2 class="panel-title">Manage users</h2>
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
                        <div class="text-warning">* Enter user name to search</div>
                    </div>
                </div>
                <table class="table text-left">
                    <col width="80%">
                    <col width="20%">
                    <% _.each(users1, function(user) { %>
                    <tr>
                        <td><%= user.get('user_name') %></td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default">Edit</button>
                                <button type="button" class="btn btn-default">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <% }); %>
                </table>
            </div>
        </div>
    </div>
</script>

<!-- Plugin JavaScript -->
<script src="../assets/js/classie.js"></script>
<script src="../assets/js/cbpAnimatedHeader.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone.js"></script>
<script src="../bower_components/backbone.validation/src/backbone-validation.js"></script>

<script src="../assets/js/backbone/manageQuestions.js"></script>
<script src="../assets/js/backbone/manageUsers.js"></script>

<script src="../assets/js/backbone/manageAdminView.js"></script>

<script src="../assets/js/backbone/router.js"></script>
</body>
</html>