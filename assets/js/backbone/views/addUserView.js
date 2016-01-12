/**
 * Created by Ershadi Sayuri on 1/12/2016.
 */
var AddUserView = Backbone.View.extend({
    initialize: function () {
        // This hooks up the validation
        Backbone.Validation.bind(this);
    },

    events: {
        'click #saveUserButton': function (e) {
            e.preventDefault();
            this.saveUser();
        }
    },

    render: function () {
        var template = _.template($('#new-admin-template').html());
        var renderedContent = template(this.model.attributes);
        this.$el.html(renderedContent);
        return this;
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
        var data = $("#addAdminForm").serializeObject();

        this.model.set(data);

        // Check if the model is valid before saving
        if (this.model.isValid(true)) {
            this.model.save(data, {
                success: function (response) {
                    console.log("success response " + response);
                },
                error: function (error) {
                    console.log("error response " + error);
                }
            });
        }
    },

    remove: function () {
        // Remove the validation binding
        Backbone.Validation.unbind(this);
        return Backbone.View.prototype.remove.apply(this, arguments);
    },
});