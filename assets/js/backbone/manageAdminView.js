/**
 * Created by Ershadi Sayuri on 1/7/2016.
 */
// Define a View that uses our model
var AdminView = Backbone.View.extend({
    events: {
        'click #addNewQuestion': function (e) {
            e.preventDefault();
            this.addNewQuestion();
        },
        'click #manageQuestions': function (e) {
            e.preventDefault();
            this.manageQuestions();
        },
        'click #addNewAdmin': function (e) {
            e.preventDefault();
            this.addNewAdmin();
        },
        'click #manageUsers': function (e) {
            e.preventDefault();
            this.manageUsers();
        }
    },

    addNewQuestion: function () {
        adminConsoleRouter.navigate("view/addquestion", "question", {});
    },
    manageQuestions: function () {
        adminConsoleRouter.navigate("view/managequestions", "questions", {});
    },
    addNewAdmin: function () {
        adminConsoleRouter.navigate("view/addadmin", "user", {});
    },
    manageUsers: function () {
        adminConsoleRouter.navigate("view/manageusers", "users", {});
    }
});

$(function () {
    var view = new AdminView({
        el: 'form',
    });
});