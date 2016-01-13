/**
 * Created by Ershadi Sayuri on 1/12/2016.
 */
// Define a model with some validation rules
var QuestionModel = Backbone.Model.extend({
    urlRoot: "../question/saveQuestion",

    defaults: {
        questionId:'',
        question: '',
        difficulty: '',
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
        difficulty: {
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
