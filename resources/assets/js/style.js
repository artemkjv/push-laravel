function extend() {
  const gamburger = document.querySelector(".gamburger");
  const mobileMenu = document.querySelector(".dp_menu_extend");
  const docMenu = document.querySelector(".docp_top_menu");
  const docToggled = docMenu ? docMenu.querySelector(".gamburger") : null;
  const onesignal = document.querySelector(".onesignal_menu");
  const selectorNav = document.querySelector("#docp_selector");
  if (selectorNav) {
    selectorNav.addEventListener("click", (e) => {
      selectorNav.classList.toggle("select");
      selectorNav.querySelectorAll(".docp_selector_option").forEach((el, i) => {
        el.style.display = selectorNav.classList.contains("select") && "block";

        el.addEventListener("click", (e) => {
          selectorNav
            .querySelectorAll(".docp_selector_option")
            .forEach((elem) => {
              elem.style.display = "none";
            });
          e.target.style.display = "block";
          const input = el.querySelector("input");
          input.disabled = false;
          input.style.pointerEvents = "auto";
        });
      });
    });
  }
  if (docToggled) {
    docToggled.addEventListener("click", () => {
      onesignal.style.display =
        getComputedStyle(onesignal).display === "none" ? "block" : "none";
    });
    return;
  }
  if (gamburger) {
    gamburger.addEventListener("click", () => {
      mobileMenu.classList.toggle("not_visible");
    });
  }
}
extend();
