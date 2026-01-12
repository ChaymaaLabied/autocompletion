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

      // Exact
      data.exact.forEach((el) => {
        list.innerHTML += `<li><strong>${el.name}</strong></li>`;
      });

      // Séparateur si contain existe
      if (data.contain.length) {
        list.innerHTML += `<li class="separator">---</li>`;
      }

      // Contain
      data.contain.forEach((el) => {
        list.innerHTML += `<li>${el.name}</li>`;
      });
    });
});
