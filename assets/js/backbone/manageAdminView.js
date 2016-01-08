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
        adminConsoleRouter.navigate("add/question", "question", {});
    },
    manageQuestions: function () {
        adminConsoleRouter.navigate("manage/questions", "questions", {});
    },
    addNewAdmin: function () {
        adminConsoleRouter.navigate("add/admin", "user", {});
    },
    manageUsers: function () {
        adminConsoleRouter.navigate("manage/users", "users", {});
    }
});

$(function () {
    var view = new AdminView({
        el: 'form',
    });
});