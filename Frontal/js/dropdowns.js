var dropdowns = document.querySelectorAll(".dropdown")
                dropdowns.forEach(function (dropdown) {
                  dropdown.addEventListener("mouseenter", function () {
                    dropdown.querySelector(".dropdown-menu").classList.add("show")
                  })
                  dropdown.addEventListener("mouseleave", function () {
                    dropdown.querySelector(".dropdown-menu").classList.remove("show")
                  })
                })