<script>
    const root = document.documentElement;
    function getCustomPropertyValue(name) {
        const styles = getComputedStyle(root);
        return styles.getPropertyValue(name);
    }
    const fieldset = document.querySelector(".fieldset");
    const fields = document.querySelectorAll(".field");
    const boxes = document.querySelectorAll(".box");
    function handleInputField({ target }) {
        const value = target.value.slice(0, 1);
        target.value = value;
        const step = value ? 1 : -1;
        const fieldIndex = [...fields].findIndex((field) => field === target);
        const focusToIndex = fieldIndex + step;
        if (focusToIndex < 0 || focusToIndex >= fields.length) return;
        fields[focusToIndex].focus();
    }
    fields.forEach((field) => {
        field.addEventListener("input", handleInputField);
    });
    const successBtn = document.querySelector(".success-btn");
    const failureBtn = document.querySelector(".failure-btn");
    const resetBtn = document.querySelector(".reset-btn");
    function input_success() {
        fieldset.classList.add("animate-success");
    }
    function input_failure() {
        function getDelay() {
            const firstStepDuration = getCustomPropertyValue(
                "--transition-duration-step-1"
            );
            const secondStepDuration = getCustomPropertyValue(
                "--transition-duration-step-2"
            );

            return parseInt(firstStepDuration) + parseInt(secondStepDuration);
        }
        function animateFailure() {
            fieldset.classList.add("animate-failure");
            const delay = getDelay();

            setTimeout(() => {
                fieldset.classList.remove("animate-failure");
            }, delay);
        }
        if (fieldset.classList.contains("animate-success")) {
            fieldset.classList.remove("animate-success");

            const delay = parseInt(getCustomPropertyValue("--transition-duration-step-1"))

            setTimeout(() => {
                animateFailure();
            }, delay)

            return;
        }
        animateFailure();
    }
    function input_reset() {
        fieldset.classList.remove("animate-failure");
        fieldset.classList.remove("animate-success");
    }
    function setAnimationDuration({ target }) {
        const {value, dataset: { step }} = target;
        const safeValue = parseInt(value);
        const propertyValue = Number.isNaN(safeValue) ? null : safeValue + "ms";

        root.style.setProperty(`--transition-duration-step-${step}`, propertyValue);
    }
</script>
