/**
 * Created by Ershadi Sayuri on 1/7/2016.
 */
var AdminConsoleRouter = Backbone.Router.extend({
    routeParams: {},
    routes: {
        '': 'home',
        'view/manageusers': 'viewManageUsers',
        'view/managequestions': 'viewManageQuestions',
        'view/addadmin': 'viewAddAdmin',
        'view/addquestion': 'viewAddQuestion',
        'edit/question/:id': 'editQuestion'
    },

    /**
     * Override navigate function
     * @param route the route hash
     * @param key to pass the parameter
     * @param options the Options for navigate functions
     */
    navigate: function (route, key, options) {
        var routeOption = {
            trigger: true
        };
        var params = (options && options.params) ? options.params : null;
        $.extend(routeOption, options);
        delete routeOption.params;

        //set the params for the route
        this.param(key, params);

        Backbone.Router.prototype.navigate(route, routeOption);
    },

    /**
     * Get or set parameters for a route fragment
     * @param fragment fragment Exact route hash
     * @param params the parameter you to set for the route
     * @returns param value for that parameter
     */
    param: function (fragment, params) {
        var matchedRoute;
        _.any(Backbone.history.handlers, function (handler) {
            if (handler.route.test(fragment)) {
                matchedRoute = handler.route;
            }
        });
        if (params !== undefined) {
            this.routeParams[fragment] = params;
        }

        return this.routeParams[fragment];
    },

    /**
     * show question list view
     */
    viewManageQuestions: function () {
        var questionListView = new QuestionListView();
        $("#content_right").empty();
        $("#content_right").append(questionListView.render().el);
    },

    /**
     * show user list view
     */
    viewManageUsers: function () {
        var userListView = new UserListView();
        $("#content_right").innerHTML = "";
        $("#content_right").html(userListView.render().el);
    },

    /**
     * show add user view
     */
    viewAddAdmin: function () {
        var addUserView = new AddUserView({
            model: new UserModel()
        });

        $("#content_right").innerHTML = "";
        $("#content_right").html(addUserView.render().el);
    },

    /**
     * show add question view
     */
    viewAddQuestion: function () {
        var addQuestionView = new AddQuestionView({
            model: new QuestionModel()
        });

        $("#content_right").innerHTML = "";
        $("#content_right").html(addQuestionView.render().el);
    },

    /**
     * show navigation bar
     * show add question view
     */
    home: function () {
        var navigator = new NavigatorView();
        $("#navigator").empty();
        $("#navigator").html(navigator.render().el);

        this.viewAddQuestion();
    },

    /**
     * show edit question view
     * @param id
     */
    editQuestion: function (id) {
        var editView = new AddQuestionView({model: new QuestionModel()});
        $("#content_right").empty();
        $("#content_right").html(editView.render(id).el);
    }
});

var adminConsoleRouter = new AdminConsoleRouter();
Backbone.history.start();
