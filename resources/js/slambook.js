document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("slambookForm");
    const nextButtons = document.querySelectorAll(".next-btn");
    const prevButtons = document.querySelectorAll(".prev-btn");

    nextButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const currentSection = document.getElementById(
                "section-" + this.dataset.current
            );
            const nextSection = document.getElementById(
                "section-" + this.dataset.next
            );

            // Validate current section before moving to next
            const inputs = currentSection.querySelectorAll(
                "input[required], textarea[required]"
            );
            let isValid = true;

            inputs.forEach((input) => {
                if (input.type === "radio") {
                    const radioGroup = currentSection.querySelectorAll(
                        `input[name="${input.name}"]`
                    );
                    const isChecked = Array.from(radioGroup).some(
                        (radio) => radio.checked
                    );
                    if (!isChecked) {
                        isValid = false;
                    }
                } else if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add("error");
                } else {
                    input.classList.remove("error");
                }
            });

            if (isValid) {
                currentSection.style.display = "none";
                nextSection.style.display = "block";
                window.scrollTo({ top: 0, behavior: "smooth" });
            } else {
                alert("Please fill in all required fields before proceeding.");
            }
        });
    });

    prevButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const currentSection = document.getElementById(
                "section-" + this.dataset.current
            );
            const prevSection = document.getElementById(
                "section-" + this.dataset.prev
            );

            currentSection.style.display = "none";
            prevSection.style.display = "block";
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    });
});
