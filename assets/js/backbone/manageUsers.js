/**
 * Created by Ershadi Sayuri on 1/7/2016.
 */
var Users = Backbone.Collection.extend({
    url: '../user/loadAllUsers'
});

var UserListView = Backbone.View.extend({
    render: function () {
        var that = this;
        var users = new Users();
        var template = _.template($('#user-list-template').html());

        users.fetch({
            success: function (users) {
                var renderedContent = template({users1: users.models});
                that.$el.html(renderedContent);
                console.log(users);
            },
            error: function (e) {
                console.log(e);
            }
        })
        return this;
    }
});

// Define a model with some validation rules
var UserModel = Backbone.Model.extend({
    urlRoot: "../User/addNewUser",
    defaults: {
        username: '',
        password: '',
        repeatPassword: '',
        roleId: ''
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
                success: function () {
                    console.log("success");
                },
                error: function (e) {
                    console.log(e)
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

$(function () {
    var view = new SignUpView({
        el: 'form',
        model: new UserModel()
    });
});


