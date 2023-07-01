const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step .bullet");
let current = 1;

nextBtnFirst.addEventListener("click", function(event) {
  event.preventDefault();
  // Perform form validation
  const firstName = document.querySelector('input[name="first-name"]').value;
  const lastName = document.querySelector('input[name="last-name"]').value;
  const errorElement = document.querySelector('.page.active .error');
  
  if (firstName.trim() === "" || lastName.trim() === "") {
    if (errorElement) {
      errorElement.textContent = "Please fill in all fields.";
    }
    return;
  }
  
  if (errorElement) {
    errorElement.textContent = ""; // Clear error message if validation passes
  }
  
  slidePage.style.marginLeft = "-25%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});

nextBtnSec.addEventListener("click", function(event) {
  event.preventDefault();
  // Perform form validation
  const emailAddress = document.querySelector('input[name="email"]').value;
  const phoneNumber = document.querySelector('input[name="phone"]').value;
  const errorElement = document.querySelector('.slide-page .page.active .error');
  
  // Regex pattern for email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  // Regex pattern for phone number validation (allowing only digits and optional '+')
  const phoneRegex = /^\+?\d+$/;
  
  if (!emailRegex.test(emailAddress)) {
    errorElement.textContent = "Please enter a valid email address.";
    return;
  }
  
  if (!phoneRegex.test(phoneNumber)) {
    errorElement.textContent = "Please enter a valid phone number.";
    return;
  }
  
  errorElement.textContent = ""; // Clear error message if validation passes
  
  slidePage.style.marginLeft = "-50%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});

nextBtnThird.addEventListener("click", function(event) {
  event.preventDefault();
  // Perform form validation
  const dateOfBirth = document.querySelector('input[name="date"]').value;
  const gender = document.querySelector('select[name="gender"]').value;
  const errorElement = document.querySelector('.slide-page .page.active .error');
  
  // Regex pattern for date validation (dd/mm/yyyy format)
  const dateRegex = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
  
  if (!dateRegex.test(dateOfBirth)) {
    errorElement.textContent = "Please enter a valid date of birth (dd/mm/yyyy).";
    return;
  }
  
  errorElement.textContent = ""; // Clear error message if validation passes
  
  slidePage.style.marginLeft = "-75%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});

submitBtn.addEventListener("click", function() {
  // Perform form validation
  const username = document.querySelector('input[name="username"]').value;
  const password = document.querySelector('input[name="password"]').value;
  const errorElement = document.querySelector('.slide-page .page.active .error');
  
  // Regex pattern for password validation (minimum 8 characters with at least one uppercase letter, one lowercase letter, and one digit)
  const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  
  if (username.trim() === "" || password.trim() === "") {
    errorElement.textContent = "Please fill in all fields.";
    return;
  }
  
  if (!passwordRegex.test(password)) {
    errorElement.textContent = "Please enter a valid password (minimum 8 characters with at least one uppercase letter, one lowercase letter, and one digit).";
    return;
  }
  
  errorElement.textContent = ""; // Clear error message if validation passes
  
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  
  setTimeout(function() {
    alert("Your Form Successfully Signed up");
    location.reload();
  }, 800);
});

prevBtnSec.addEventListener("click", function(event) {
  event.preventDefault();
  slidePage.style.marginLeft = "0%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});

prevBtnThird.addEventListener("click", function(event) {
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});

prevBtnFourth.addEventListener("click", function(event) {
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
