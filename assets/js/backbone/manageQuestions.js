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

var AddQuestionView = Backbone.View.extend({
    events: {
        'click #saveQuestionButton': function (e) {
            e.preventDefault();
            this.saveQuestion();
        }
    },

    render: function () {
        var template = _.template($('#new-question-template').html());
        var renderedContent = template({});
        this.$el.html(renderedContent);
        return this;
    },

    saveQuestion: function (event) {

    },
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