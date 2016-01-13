/**
 * Created by Ershadi Sayuri on 1/13/2016.
 */
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
        var data = $("#signInForm").serializeObject();

        this.model.set(data);

        // Check if the model is valid before saving
        if (this.model.isValid(true)) {
            this.model.save(data, {
                success: function (response) {
                    if (response.attributes.login_status == "incorrect password") {
                        $("#password").val("");
                        $("#signInMessage").text("Incorrect password.");
                        $("#signInMessage").addClass("text-warning");
                    } else if (response.attributes.login_status == "incorrect username and password") {
                        $("#username").val("");
                        $("#password").val("");
                        $("#signInMessage").text("Incorrect user name and password.");
                        $("#signInMessage").addClass("text-warning");
                    } else if (response.attributes.login_status == "admin user") {
                        window.location.href = "../main/loadAdminPage";
                    } else if (response.attributes.login_status == "student user") {
                        window.location.href = "../question/loadTenQuestionIds";
                    }
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

    render: function () {
        this.$el.html(this.template(this.model.attributes));
    }
});

$(function () {
    var view = new SignInForm({
        el: 'form',
        model: new SignInModel()
    });
});
