@include('user.navbar')

  <title>HealthHub Chatbot</title>
  <style>
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
      height: 400px;
      overflow-y: scroll;
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 10px;
    }

    .user-bubble {
      background: linear-gradient(to bottom right, #007BFF, #00BFFF);
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 5px;
      color: white;
    }

    .bot-bubble {
        background-color: #a3a3a5;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 5px;
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
  </style>
</head>
<body>
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
      }
      // Add more medical-related questions and follow-up questions as needed
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
