// Define the text to be typed
const sloganText = "Local grown solutions!";

// Get the #slogan element
const sloganElement = document.getElementById('slogan');

// Define a function to simulate typing
function typeWriter(text, i, speed) {
  if (i < text.length) {
    sloganElement.querySelector('em').textContent += text.charAt(i);
    i++;
    setTimeout(() => typeWriter(text, i, speed), speed);
  }
}

// Call the typeWriter function with the sloganText
typeWriter(sloganText, 0, 100);