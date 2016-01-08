// Define a model with some validation rules
var SignInModel = Backbone.Model.extend({
    defaults: {
        username: '',
        password: '',
    },
    validation: {
        username: {
            required: true
        },
        password: {
            required: true
        }
    }
});

// Define a View that uses our model
var SignInForm = Backbone.View.extend({
    events: {
        'click #signInButton': function (e) {
            e.preventDefault();
            this.signIn();
        }
    },

    initialize: function () {
        // This hooks up the validation
        Backbone.Validation.bind(this);
    },

    signIn: function () {
        var data = this.$el.serializeObject();

        this.model.set(data);

        // Check if the model is valid before saving
        if (this.model.isValid(true)) {
            var signInRouter = new SignInRouter();
            Backbone.history.start();
            signInRouter.navigate("signin/user", "user", {
                params: JSON.stringify(this.model.attributes)
            });
        }
    },

    remove: function () {
        // Remove the validation binding
        Backbone.Validation.unbind(this);
        return Backbone.View.prototype.remove.apply(this, arguments);
    },

    render: function () {
        this.$el.html(this.template(this.model.attributes));
    }
});

var SignInRouter = Backbone.Router.extend({
    routeParams: {},
    routes: {
        "signin/user": "signInUser",
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

    signInUser: function () {
        var username = JSON.parse(this.param("user")).username;
        var password = JSON.parse(this.param("user")).password;

        $.ajax({
            type: "GET",
            url: '../user/signinuser',
            data: {username: username, password: password},
            success: function (response) {
                alert("User logged in successfully.");
            },
            error: function () {
                alert("Failed to save the user.");
            }
        });
    },
});

$(function () {
    var view = new SignInForm({
        el: 'form',
        model: new SignInModel()
    });
});
