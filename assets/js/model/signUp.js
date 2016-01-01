// Extend the callbacks to work with Bootstrap, as used in this example
_.extend(Backbone.Validation.callbacks, {
    valid: function (view, attr, selector) {
        var $el = view.$('[name=' + attr + ']'),
            $group = $el.closest('.form-group');

        $group.removeClass('has-error');
        $group.find('.help-block').html('').addClass('hidden');
    },
    invalid: function (view, attr, error, selector) {
        var $el = view.$('[name=' + attr + ']'),
            $group = $el.closest('.form-group');

        $group.addClass('has-error');
        $group.find('.help-block').html(error).removeClass('hidden');
    }
});

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
        alert("ssasad" + this.param("user"));
        var username = JSON.parse(this.param("user")).username;
        var password = JSON.parse(this.param("user")).password;
        alert(username + " " + password);

        $.ajax({
            type: "GET",
            url: '../User/addNewUser',
            data: {username: username, password: password},
            success: function (response) {
                alert("User saved successfully.");
            },
            error: function () {
                alert("Failed to save the user.");
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

/**
 * converts form elements to a valid JSON object
 */
$.fn.serializeObject = function () {
    "use strict";
    var a = {}, b = function (b, c) {
        var d = a[c.name];
        "undefined" != typeof d && d !== null ? $.isArray(d) ? d.push(c.value) : a[c.name] = [d, c.value] : a[c.name] = c.value
    };
    return $.each(this.serializeArray(), b), a
};
