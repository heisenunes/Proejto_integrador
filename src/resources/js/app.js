require("./bootstrap");

const swap =
    (sel1, sel2, left = true) =>
    () => {
        const elem1 = document.querySelectorAll(sel1);
        const elem2 = document.querySelectorAll(sel2);

        if (!elem1 || !elem2) return;

        elem1.forEach((e) =>
            left ? e.classList.remove("hidden") : e.classList.add("hidden")
        );
        elem2.forEach((e) =>
            left ? e.classList.add("hidden") : e.classList.remove("hidden")
        );
    };

const setupEditQuestionTitle = () => {
    const editBtn = document.querySelector("#edit-question-content-btn");
    const cancelBtn = document.querySelector(
        "#edit-question-content-form > #form-cancel"
    );

    if (!editBtn || !cancelBtn) return;

    editBtn.addEventListener(
        "click",
        swap("#question-content-div", "#edit-question-content-form", false)
    );
    cancelBtn.addEventListener(
        "click",
        swap("#question-content-div", "#edit-question-content-form", true)
    );
};

setupEditQuestionTitle();
