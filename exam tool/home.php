<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam Tool</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .hidden {
            display: none;
        }
        .question {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Online Exam Tool</h1>
    <div id="create-question-section">
        <h2>Create Question</h2>
        <label for="question-text">Question:</label>
        <input type="text" id="question-text">
        <label for="answer-text">Answer:</label>
        <input type="text" id="answer-text">
        <button onclick="addQuestion()">Add Question</button>
    </div>

    <div id="exam-section" class="hidden">
        <h2>Take Exam</h2>
        <form id="exam-form">
            <!-- Questions will be inserted here -->
        </form>
        <button onclick="submitExam()">Submit Exam</button>
    </div>

    <div id="results-section" class="hidden">
        <h2>Results</h2>
        <p id="results"></p>
    </div>

    <script>
        let questions = [];

        function addQuestion() {
            const questionText = document.getElementById('question-text').value;
            const answerText = document.getElementById('answer-text').value;

            if (questionText && answerText) {
                questions.push({ question: questionText, answer: answerText });

                document.getElementById('question-text').value = '';
                document.getElementById('answer-text').value = '';

                alert('Question added successfully!');
                showExam();
            } else {
                alert('Please enter both question and answer.');
            }
        }

        function showExam() {
            if (questions.length > 0) {
                document.getElementById('exam-section').classList.remove('hidden');
                const examForm = document.getElementById('exam-form');
                examForm.innerHTML = '';

                questions.forEach((q, index) => {
                    const div = document.createElement('div');
                    div.className = 'question';
                    div.innerHTML = `
                        <label>${q.question}</label>
                        <input type="text" id="answer-${index}">
                    `;
                    examForm.appendChild(div);
                });
            }
        }

        function submitExam() {
            let correctAnswers = 0;
            questions.forEach((q, index) => {
                const userAnswer = document.getElementById(`answer-${index}`).value;
                if (userAnswer.toLowerCase() === q.answer.toLowerCase()) {
                    correctAnswers++;
                }
            });

            document.getElementById('results').innerText = `You got ${correctAnswers} out of ${questions.length} correct.`;
            document.getElementById('results-section').classList.remove('hidden');
        }
    </script>
</body>
</html>
