/**
 * Created by Ershadi Sayuri on 1/7/2016.
 */
var AdminConsoleRouter = Backbone.Router.extend({
    routeParams: {},
    routes: {
        'manage/users': 'manageusers',
        'manage/questions': 'managequestions',
        'add/admin': 'addadmin',
        'add/question': 'addquestion'
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

    managequestions: function () {
        $("#content_right").innerHTML = "";
        $("#content_right").html(questionListView.render().el);
    },

    manageusers: function () {
        $("#content_right").innerHTML = "";
        $("#content_right").html(userListView.render().el);
    },

    addadmin: function () {
        $("#content_right").innerHTML = "";
        $("#content_right").html(adminView.render().el);
    },

    addquestion: function () {
        $("#content_right").innerHTML = "";
        $("#content_right").html(questionView.render().el);
    }
});

var questionListView = new QuestionListView();
var userListView = new UserListView();
var adminView = new AddAdminView();
var questionView = new AddQuestionView();

var adminConsoleRouter = new AdminConsoleRouter();

Backbone.history.start();
