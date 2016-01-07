/**
 * Created by Ershadi Sayuri on 1/6/2016.
 */

var Questions = Backbone.Collection.extend({
    url: '../question/loadAllQuestions'
});

var QuestionListView = Backbone.View.extend({
    render: function () {
        var that = this;
        var questions = new Questions();
        var template = _.template($('#question-list-template').html());

        questions.fetch({
            success: function (questions) {
                var renderedContent = template({questions1: questions.models});
                that.$el.html(renderedContent);
                console.log(questions);
            },
            error: function (e) {
                console.log(e);
            }
        })
        return this;
    }
});

var AdminConsoleRouter = Backbone.Router.extend({
    routes: {
        '': 'managequestions'
    }
});

var questionListView = new QuestionListView();

var adminConsoleRouter = new AdminConsoleRouter();
adminConsoleRouter.on('route:managequestions', function () {
    $("#table").innerHTML = "";
    $("#table").append(questionListView.render().el);
});

Backbone.history.start();