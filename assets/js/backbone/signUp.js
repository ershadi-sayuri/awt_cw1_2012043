// Define a model with some validation rules
var SignUpModel = Backbone.Model.extend({
    defaults: {
        username: '',
        password: '',
        repeatPassword: ''
    },
    validation: {
        username: {
            required: true
        },
        password: {
            minLength: 8
        },
        repeatPassword: {
            equalTo: 'password',
            msg: 'The passwords does not match'
        }
    }
});

// Define a View that uses our model
var SignUpForm = Backbone.View.extend({
    events: {
        'click #signUpButton': function (e) {
            e.preventDefault();
            this.signUp();
        }
    },

    initialize: function () {
        // This hooks up the validation
        Backbone.Validation.bind(this);
    },

    signUp: function () {
        var data = this.$el.serializeObject();

        this.model.set(data);

        // Check if the model is valid before saving
        if (this.model.isValid(true)) {
            var signUpRouter = new SignUpRouter();
            Backbone.history.start();
            signUpRouter.navigate("save/user", "user", {
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

var SignUpRouter = Backbone.Router.extend({
    routeParams: {},
    routes: {
        "save/user": "saveUser",
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

    saveUser: function () {
        var username = JSON.parse(this.param("user")).username;
        var password = JSON.parse(this.param("user")).password;

        $.ajax({
            type: "GET",
            url: '../user/addnewuser',
            data: {username: username, password: password, role_id: "r002"},
            success: function (response) {
                $("#signUpMessage").html("User added successfully." + response);
                location.href="Home.php"

            },
            error: function () {
                $("#signUpMessage").append("Failed to add new user.");
            }
        });
    },
});

$(function () {
    var view = new SignUpForm({
        el: 'form',
        model: new SignUpModel()
    });
});

