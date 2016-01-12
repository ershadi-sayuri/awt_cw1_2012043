// Define a View that uses our model
var SignUpView = Backbone.View.extend({
    events: {
        'click #saveUserButton': function (e) {
            e.preventDefault();
            this.saveUser();
        }
    },

    initialize: function () {
        // This hooks up the validation
        Backbone.Validation.bind(this);
        this.model.on('change', this.render, this);
    },

    saveUser: function () {
        var data = $("#signUpForm").serializeObject();

        this.model.set(data);

        // Check if the model is valid before saving
        if (this.model.isValid(true)) {
            this.model.save(data, {
                success: function () {
                    console.log("success");
                    var userModel = new UserModel();
                },
                error: function (e) {
                    console.log(e)
                    var userModel = new UserModel();
                },
            });
        }
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


    remove: function () {
        // Remove the validation binding
        Backbone.Validation.unbind(this);
        return Backbone.View.prototype.remove.apply(this, arguments);
    },

    render: function () {
        this.$el.html(this.template(this.model.attributes));
    }
});


