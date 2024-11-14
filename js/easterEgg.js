function createFrank() {
  const img = document.createElement("img");
  img.src = "./images/shhh.webp";
  img.width = 500;
  document.body.appendChild(img);
}

function checkMessage() {
  if (currentMessage === secretMessage) {
    return true;
  }

  for (let i = 0; i < currentMessage.length; i++) {
    if (currentMessage[i] === secretMessage[i]) {
      continue;
    } else {
      currentMessage = "";
      break;
    }
  }

  return false;
}

const secretMessage = "showmefrank";
let currentMessage = "";

document.body.addEventListener("keypress", (e) => {
  currentMessage += e.key;
  if (checkMessage()) {
    createFrank();
  }
});
