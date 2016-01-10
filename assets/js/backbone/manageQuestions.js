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
        });
        return this;
    }
});

// Define a model with some validation rules
var QuestionModel = Backbone.Model.extend({
    urlRoot: "../Question/addNewQuestion",
    defaults: {
        question: '',
        difficultyLevel: '',
        explanation: '',
        answer1: '',
        answer1Status: '',
        answer2: '',
        answer2Status: '',
        answer3: '',
        answer3Status: '',
    },
    validation: {
        question: {
            required: true
        },
        difficultyLevel: {
            required: true,
            range: [1, 3]
        },
        explanation: {
            required: true
        },
        answer1: {
            required: true
        },
        answer1Status: {
            required: true,
            range: [0, 1]
        },
        answer2: {
            required: true
        },
        answer2Status: {
            required: true,
            range: [0, 1]
        },
        answer3Status: {
            range: [0, 1]
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

    render: function (options) {
        if (options != undefined) {
            if (options.id) {
                var questionModel = new QuestionModel({urlRoot:'../Question/getQuestionData'});
                questionModel.fetch({
                    success: function () {
                        alert("hiiiiiiiiiiiiiiiiiiii")
                    },
                    error: function () {
                        alert("errorrrrrrrrrrrrrrrr")
                    }
                });
            }
        } else {
            var template = _.template($('#new-question-template').html());
            var renderedContent = template(this.model.attributes);
            this.$el.html(renderedContent);
        }

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

    saveQuestion: function () {
        var data = $("#addQuestionForm").serializeObject();

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

var ManageQuestionRouter = Backbone.Router.extend({
    routes: {
        'edit/question/:id': 'editquestion'
    },

    /**
     * Override navigate function
     * @param route the route hash
     * @param key to pass the parameter
     * @param options the Options for navigate functions
     */
    navigate: function (route, key, options) {
        var routeOption = {
            trigger: true
        };
        var params = (options && options.params) ? options.params : null;
        $.extend(routeOption, options);
        delete routeOption.params;

        //set the params for the route
        this.param(key, params);

        Backbone.Router.prototype.navigate(route, routeOption);
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

    editquestion: function (id) {
        var questionModel = new QuestionModel();
        questionModel.rootUrl = "./Question/getQuestionData"
        var addQuestionView = new AddQuestionView({
            model: questionModel,
        });
        addQuestionView.render({id: id});
    },
});