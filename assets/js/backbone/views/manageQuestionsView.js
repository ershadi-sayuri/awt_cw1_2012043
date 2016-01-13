/**
 * Created by Ershadi Sayuri on 1/6/2016.
 */
var ManageQuestionView = Backbone.View.extend({

    render: function (id) {
        var questionModel = new QuestionModel();
        questionModel.urlRoot = "../question/getQuestionData/" + id;
        var addQuestionView = new AddQuestionView({
            model: questionModel,
        });
        return addQuestionView.render({id: id});
    }
});
