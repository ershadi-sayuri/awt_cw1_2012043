/**
 * Created by Ershadi Sayuri on 1/12/2016.
 */
var QuestionListView = Backbone.View.extend({
    questions: null,
    template: _.template($('#question-list-template').html()),
    events: {
        'click #deleteButton': function (e) {
            this.delete(e);
        }
    },
    /**
     * get all questions
     * @returns {QuestionListView}
     */
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
        this.questions = questions;
        return this;
    },
    /**
     * delete selected question
     * @param e
     */
    delete: function (e) {
        var question_id = $(e.currentTarget).data("questionid");
        var index = $(e.currentTarget).data("index");
        var question = new QuestionModel();
        question.urlRoot = "../question/deleteQuestion/" + question_id;
        var that = this;
        console.log(this.questions);
        question.fetch({
            success: function () {
                that.questions.remove(that.questions.at(index));
                var renderedContent = that.template({questions1: that.questions.models});
                that.$el.html(renderedContent);
                $("#content_right").empty();
                $("#content_right").append(that.el);
            },
            error: function () {
                alert("error occurred");
            }
        });
    }
});