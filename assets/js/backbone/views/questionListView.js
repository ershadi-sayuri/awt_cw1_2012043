/**
 * Created by Ershadi Sayuri on 1/12/2016.
 */
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
        });
        return this;
    }
});