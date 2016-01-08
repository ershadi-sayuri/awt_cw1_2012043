/**
 * Created by Ershadi Sayuri on 1/7/2016.
 */
var AdminConsoleRouter = Backbone.Router.extend({
    routeParams: {},
    routes: {
        'view/manageusers': 'viewManageUsers',
        'view/managequestions': 'viewManageQuestions',
        'view/addadmin': 'viewAddAdmin',
        'view/addquestion': 'viewAddQuestion'
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

    viewManageQuestions: function () {
        var questionListView = new QuestionListView();

        $("#content_right").innerHTML = "";
        $("#content_right").html(questionListView.render().el);
    },

    viewManageUsers: function () {
        var userListView = new UserListView();

        $("#content_right").innerHTML = "";
        $("#content_right").html(userListView.render().el);
    },

    viewAddAdmin: function () {
        var addAdminView = new AddAdminView({
            el: 'form',
            model: new AdminModel()
        });

        $("#content_right").innerHTML = "";
        $("#content_right").html(addAdminView.render().el);
    },

    viewAddQuestion: function () {
        var questionView = new AddQuestionView({
            el: 'form',
            model: new QuestionModel()
        });

        $("#content_right").innerHTML = "";
        $("#content_right").html(questionView.render().el);
    }
});

var adminConsoleRouter = new AdminConsoleRouter();

Backbone.history.start();
