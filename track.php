<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
        .button-group {
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            margin: 5px;
            background-color: #0073aa;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #005f8d;
        }
    </style>
</head>
<body>
    <form id="multiStepForm">
        <!-- Step 1 -->
        <div class="step active" data-step="1">
            <h2>Step 1</h2>
            <p><input type="radio" name="step1" value="Option 1"> Option 1</p>
            <p><input type="radio" name="step1" value="Option 2"> Option 2</p>
            <div class="button-group">
                <button type="button" class="next-button">Next</button>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="step" data-step="2">
            <h2>Step 2</h2>
            <p><input type="radio" name="step2" value="Option 1"> Option 1</p>
            <p><input type="radio" name="step2" value="Option 2"> Option 2</p>
            <div class="button-group">
                <button type="button" class="previous-button">Previous</button>
                <button type="button" class="next-button">Next</button>
            </div>
        </div>

        <!-- Add more steps up to Step 8 as needed -->

        <!-- Step 8 -->
        <div class="step" data-step="8">
            <h2>Step 8</h2>
            <p><input type="radio" name="step8" value="Option 1"> Option 1</p>
            <p><input type="radio" name="step8" value="Option 2"> Option 2</p>
            <div class="button-group">
                <button type="button" class="previous-button">Previous</button>
                <button type="submit" class="submit-button">Submit</button>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function ($) {
            const steps = $(".step");
            let currentStep = 1;

            // Function to show the current step
            function showStep(step) {
                steps.removeClass("active");
                $(`.step[data-step="${step}"]`).addClass("active");
            }

            // Radio button click event
            jQuery('input[type="radio"]').on('click', function () {
                alert("okoko")
                const currentStepElement = jQuery(this).closest('.step');
                const nextButton = jQuery(this).closest().find('.e-form__buttons__wrapper__button-next');
                if (nextButton.length) {
                    nextButton.trigger('click');
                }
            });

            // Next button click event
            $(".next-button").on("click", function () {
                if (currentStep < steps.length) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            // Previous button click event
            $(".previous-button").on("click", function () {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            // Form submission
            $("#multiStepForm").on("submit", function (e) {
                e.preventDefault();
                alert("Form submitted!");
            });
        });
    </script>
</body>
</html>
