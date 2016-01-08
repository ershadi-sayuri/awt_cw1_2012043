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

// Define a model with some validation rules
var QuestionModel = Backbone.Model.extend({
    defaults: {
        question: '',
        difficultyLevel: '',
        explanation: '',
        answer1: '',
        answer1Status:'',
        answer2: '',
        answer2Status:'',
        answer3: '',
        answer3Status:'',
    },
    validation: {
        question: {
            required: true
        },
        difficultyLevel: {
            required: true
        },
        explanation: {
            required: true
        },
        answer1: {
            required: true
        },
        answer1Status:{
            required: true,
            number: true
        },
        answer2: {
            required: true
        },
        answer2Status:{
            required: true,
            number: true
        },
        answer3: {
            required: true
        },
        answer3Status:{
            required: true,
            number: true
        }
    }
});

var AddQuestionView = Backbone.View.extend({
    initialize: function () {
        // This hooks up the validation
        Backbone.Validation.bind(this);
    },

    events: {
        'click #saveQuestionButton': function (e) {
            e.preventDefault();
            this.saveQuestion();
        }
    },

    render: function () {
        var template = _.template($('#new-question-template').html());
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

    saveQuestion: function (event) {
        var data = this.$el.serializeObject();

        this.model.set(data);

        // Check if the model is valid before saving
        if (this.model.isValid(true)) {
            var saveUserRouter = new SaveUserRouter();

            saveUserRouter.navigate("save/user", "user", {
                params: JSON.stringify(this.model.attributes)
            });
        }
    },

    remove: function () {
        // Remove the validation binding
        Backbone.Validation.unbind(this);
        return Backbone.View.prototype.remove.apply(this, arguments);
    },
});