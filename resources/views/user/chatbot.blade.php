<!DOCTYPE html>
<html lang="en">
<head>
    <title>HealthHub Chatbot</title>

    <!-- Include necessary CSS and JavaScript files for Bootstrap modal -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        .navbar-container {
            z-index: 100;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin-top: 200px;
            padding: 0;
            background: linear-gradient(to bottom right, #5faafa, #e4f2fb);
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .chat-container {
            margin-top: 120px;
            height: 400px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .user-bubble {
            /*background: linear-gradient(to bottom right,  rgb(90,144,225), rgba(0, 0, 0, 0.05));*/
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 5px;
            margin-top: 10px;
            color: rgb(35, 58, 90);
        }

        .bot-bubble {
                background-color: #9DCCFB;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 35px;
            color: white;
        }
        .input-container {
            display: flex;
            margin-top: 10px;
        }

        .input-button {
            flex: 1;
            padding: 5px;
            margin: 5px;
            background-color: #5a90e1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #007BFF;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            margin-right: 10px;
        }

        .typing-indicator {
            color: #a3a3a5;
            margin-top: 5px;
            animation: typing 1s infinite;
        }

        @keyframes typing {
            0% { opacity: 0.5; }
            50% { opacity: 1; }
            100% { opacity: 0.5; }
        }
    </style>
</head>



<body>
@include('user.navbar')

<div class="container">
    <h2 style="color: #1246CA;">HealthHub Chatbot</h2>
    <div class="chat-container" id="chat-container"></div>
</div>

  <script>
    const chatContainer = document.getElementById('chat-container');

    const questions = [
        {
            question: "What is the immune system?",
            response: "The immune system is a complex network of cells, tissues, and organs that work together to defend the body against harmful invaders such as bacteria, viruses, and other pathogens.",
            followUpQuestions: [
                {
                    question: "How does the immune system fight off infections?",
                    response: "When the immune system detects a foreign substance, it activates an immune response. This response involves the production of specialized cells and molecules that target and destroy the invading pathogens."
                },
                {
                    question: "What are the different components of the immune system?",
                    response: "The immune system consists of various components, including white blood cells (such as lymphocytes and phagocytes), antibodies, lymph nodes, spleen, thymus, and bone marrow."
                }
            ]
        },
        {
            question: "What are common types of allergies?",
            response: "Common types of allergies include hay fever (allergic rhinitis), asthma, allergic conjunctivitis, food allergies, insect sting allergies, and medication allergies.",
            followUpQuestions: [
                {
                    question: "How are allergies diagnosed?",
                    response: "Allergies are typically diagnosed through a combination of medical history, physical examination, and allergy testing, which may include skin tests and blood tests."
                },
                {
                    question: "What are common allergy triggers?",
                    response: "Allergies can be triggered by various substances, such as pollen, dust mites, pet dander, certain foods (e.g., peanuts, shellfish), insect venom, and medications."
                }
            ]
        },
        {
            question: "What is the importance of regular exercise?",
            response: "Regular exercise offers numerous health benefits, including improved cardiovascular health, enhanced mood, weight management, increased muscle strength, and reduced risk of chronic diseases.",
            followUpQuestions: [
                {
                    question: "How much exercise should one engage in?",
                    response: "The recommended amount of exercise varies depending on age, overall health, and fitness goals. Generally, adults should aim for at least 150 minutes of moderate-intensity aerobic activity or 75 minutes of vigorous-intensity activity per week, along with muscle-strengthening exercises on two or more days."
                },
                {
                    question: "What are some examples of aerobic exercises?",
                    response: "Aerobic exercises include brisk walking, running, swimming, cycling, dancing, and aerobic classes."
                }
            ]
        },
        {
            question: "What are antibiotics?",
            response: "Antibiotics are medications used to treat bacterial infections. They work by either killing the bacteria or inhibiting their growth, allowing the body's immune system to eliminate the infection.",
            followUpQuestions: [
                {
                    question: "Can antibiotics treat viral infections?",
                    response: "No, antibiotics are ineffective against viral infections such as the common cold, flu, or most cases of bronchitis. Viral infections typically resolve on their own, and the use of antibiotics is unnecessary and can contribute to antibiotic resistance."
                },
                {
                    question: "What are the potential side effects of antibiotics?",
                    response: "Common side effects of antibiotics may include gastrointestinal disturbances (such as nausea and diarrhea), allergic reactions, and antibiotic-associated diarrhea or yeast infections."
                }
            ]
        },
        {
            question: "What is diabetes?",
            response: "Diabetes is a chronic condition characterized by high levels of glucose (sugar) in the blood. It occurs when the body either does not produce enough insulin or cannot effectively use the insulin it produces.",
            followUpQuestions: [
                {
                    question: "What are the types of diabetes?",
                    response: "The main types of diabetes are type 1 diabetes, type 2 diabetes, and gestational diabetes.",
                    followUpQuestions: [
                        {
                            question: "What is the difference between type 1 and type 2 diabetes?",
                            response: "Type 1 diabetes is an autoimmune condition where the body's immune system attacks and destroys insulin-producing cells in the pancreas. Type 2 diabetes, on the other hand, is characterized by insulin resistance and inadequate insulin production."
                        },
                        {
                            question: "What are the risk factors for developing type 2 diabetes?",
                            response: "Risk factors for type 2 diabetes include obesity, sedentary lifestyle, family history of diabetes, high blood pressure, and certain ethnic backgrounds."
                        }
                    ]
                },
                {
                    question: "How is diabetes managed?",
                    response: "Diabetes management often includes lifestyle changes, such as maintaining a healthy diet, regular exercise, monitoring blood glucose levels, and taking medications (e.g., insulin injections or oral medications) as prescribed by a healthcare professional."
                }
            ]
        },

        {
            question: "What is hypertension?",
            response: "Hypertension, or high blood pressure, is a condition in which the force of the blood against the artery walls is consistently too high. It is a significant risk factor for cardiovascular diseases.",
            followUpQuestions: [
                {
                    question: "What are the risk factors for hypertension?",
                    response: "Risk factors for hypertension include family history of high blood pressure, age, obesity, sedentary lifestyle, excessive salt intake, excessive alcohol consumption, and certain chronic conditions (e.g., kidney disease)."
                },
                {
                    question: "How is hypertension treated?",
                    response: "Hypertension can be managed through lifestyle changes, such as adopting a healthy diet (e.g., DASH diet), regular physical activity, limiting alcohol intake, quitting smoking, and taking prescribed antihypertensive medications."
                }
            ]
        },
        {
            question: "What is depression?",
            response: "Depression is a mood disorder characterized by persistent feelings of sadness, hopelessness, and a lack of interest or pleasure in activities. It can significantly affect a person's daily life and well-being.",
            followUpQuestions: [
                {
                    question: "What are the common symptoms of depression?",
                    response: "Common symptoms of depression may include persistent sadness, loss of interest or pleasure in activities, changes in appetite and sleep patterns, fatigue, feelings of worthlessness or guilt, difficulty concentrating, and thoughts of self-harm."
                },
                {
                    question: "How is depression treated?",
                    response: "Depression can be treated through a combination of psychotherapy (talk therapy), medication (antidepressants), and support from healthcare professionals. Lifestyle changes, such as regular exercise and stress management, can also be beneficial."
                }
            ]
        }
    ];



    initializeChatbot();

    function initializeChatbot() {
      addBotResponse("Hello! How can I assist you with your medical questions today?");
      displayQuestionButtons();
    }

    function displayQuestionButtons() {
      questions.forEach((question) => {
        const questionButton = document.createElement('button');
        questionButton.classList.add('input-button');
        questionButton.innerText = question.question;
        questionButton.addEventListener('click', () => handleQuestionClick(question));
        chatContainer.appendChild(questionButton);
      });
    }

    function handleQuestionClick(question) {
      addQuestionMessage(question.question);
      addBotResponse(question.response);

      // Check if the question has follow-up questions
      if (question.followUpQuestions) {
        displayFollowUpQuestionButtons(question.followUpQuestions);
      }
    }

    function displayFollowUpQuestionButtons(followUpQuestions) {
      followUpQuestions.forEach((followUpQuestion) => {
        const followUpButton = document.createElement('button');
        followUpButton.classList.add('input-button');
        followUpButton.innerText = followUpQuestion.question;
        followUpButton.addEventListener('click', () => handleFollowUpQuestionClick(followUpQuestion));
        chatContainer.appendChild(followUpButton);
      });
    }

    function handleFollowUpQuestionClick(followUpQuestion) {
      addQuestionMessage(followUpQuestion.question);
      addBotResponse(followUpQuestion.response);

      // Check if the follow-up question has additional follow-up questions
      if (followUpQuestion.followUpQuestions) {
        displayFollowUpQuestionButtons(followUpQuestion.followUpQuestions);
      }
    }

    function addQuestionMessage(question) {
      const userBubble = createChatBubble(question, 'user-bubble');
      chatContainer.appendChild(userBubble);
    }

    function addBotResponse(response) {
      const botBubble = createChatBubble(response, 'bot-bubble');
      chatContainer.appendChild(botBubble);
      scrollToBottom();
    }

    function createChatBubble(message, bubbleClass) {
      const bubble = document.createElement('div');
      bubble.classList.add('chat-bubble', bubbleClass);
      bubble.innerText = message;
      return bubble;
    }

    function scrollToBottom() {
      chatContainer.scrollTop = chatContainer.scrollHeight;
    }
  </script>
</body>
</html>
