const input = document.getElementById("search");
const list = document.getElementById("suggestions");

input.addEventListener("input", () => {
  const query = input.value.trim();
  if (query.length < 1) {
    list.innerHTML = "";
    return;
  }

  fetch("autocomplete.php?search=" + query)
    .then((res) => res.json())
    .then((data) => {
      list.innerHTML = "";

      data.exact.forEach((el) => {
        list.innerHTML += `<li onclick="goToElement(${el.id})"><strong>${el.name}</strong></li>`;
      });

      if (data.contain.length) {
        list.innerHTML += `<li class="separator">---</li>`;
      }

      data.contain.forEach((el) => {
        list.innerHTML += `<li onclick="goToElement(${el.id})">${el.name}</li>`;
      });
    });
});

// Fonction pour aller vers element.php
function goToElement(id) {
  window.location.href = "element.php?id=" + id;
}

// Entrée dans input redirige vers recherche.php
input.addEventListener("keydown", function (e) {
  if (e.key === "Enter") {
    window.location.href = "recherche.php?search=" + input.value;
  }
});
