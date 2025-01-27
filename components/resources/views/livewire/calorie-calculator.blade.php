<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Calorie Calculator</h1>

    <form id="calorieForm" class="mb-4">
        <div class="mb-3">
            <label for="age" class="form-label">Age (years)</label>
            <input type="number" id="age" class="form-control" placeholder="Enter your age">
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select id="gender" class="form-select">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Weight (kg)</label>
            <input type="number" id="weight" step="0.1" class="form-control" placeholder="Enter your weight">
        </div>

        <div class="mb-3">
            <label for="height" class="form-label">Height (cm)</label>
            <input type="number" id="height" step="0.1" class="form-control" placeholder="Enter your height">
        </div>

        <div class="mb-3">
            <label for="activityLevel" class="form-label">Activity Level</label>
            <select id="activityLevel" class="form-select">
                <option value="">Select Activity Level</option>
                <option value="sedentary">Sedentary (little or no exercise)</option>
                <option value="light">Light (light exercise/sports 1-3 days a week)</option>
                <option value="moderate">Moderate (moderate exercise/sports 3-5 days a week)</option>
                <option value="active">Active (hard exercise/sports 6-7 days a week)</option>
                <option value="very_active">Very Active (very hard exercise or a physical job)</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Calculate</button>
    </form>

    <div id="resultContainer" class="mt-4">
        <h2 class="h5">Estimated Daily Calorie Needs</h2>
        <p id="calorieResult" class="fw-bold text-primary"></p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ageInput = document.getElementById('age');
        const genderInput = document.getElementById('gender');
        const weightInput = document.getElementById('weight');
        const heightInput = document.getElementById('height');
        const activityLevelInput = document.getElementById('activityLevel');
        const calorieResult = document.getElementById('calorieResult');
        const resultContainer = document.getElementById('resultContainer');

        // Load saved data from localStorage
        function loadSavedData() {
            const savedData = JSON.parse(localStorage.getItem('calorieCalculator')) || {};
            ageInput.value = savedData.age || '';
            genderInput.value = savedData.gender || '';
            weightInput.value = savedData.weight || '';
            heightInput.value = savedData.height || '';
            activityLevelInput.value = savedData.activityLevel || '';
            if (savedData.calories) {
                calorieResult.textContent = `${savedData.calories.toFixed(2)} calories/day`;
                resultContainer.style.display = 'block';
            } else {
                resultContainer.style.display = 'none';
            }
        }

        // Calculate calories based on input
        function calculateCalories(age, gender, weight, height, activityLevel) {
            let bmr;

            // Basal Metabolic Rate (BMR) calculation
            if (gender === 'male') {
                bmr = 10 * weight + 6.25 * height - 5 * age + 5;
            } else if (gender === 'female') {
                bmr = 10 * weight + 6.25 * height - 5 * age - 161;
            } else {
                return null;
            }

            // Activity level multiplier
            const activityMultipliers = {
                sedentary: 1.2,
                light: 1.375,
                moderate: 1.55,
                active: 1.725,
                very_active: 1.9,
            };

            return bmr * (activityMultipliers[activityLevel] || 1);
        }

        // Save data to localStorage
        function saveData(data) {
            localStorage.setItem('calorieCalculator', JSON.stringify(data));
        }

        // Handle form submission
        document.getElementById('calorieForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const age = parseInt(ageInput.value, 10);
            const gender = genderInput.value;
            const weight = parseFloat(weightInput.value);
            const height = parseFloat(heightInput.value);
            const activityLevel = activityLevelInput.value;

            if (!age || !gender || !weight || !height || !activityLevel) {
                alert('Please fill in all fields.');
                return;
            }

            const calories = calculateCalories(age, gender, weight, height, activityLevel);
            if (calories) {
                calorieResult.textContent = `${calories.toFixed(2)} calories/day`;
                resultContainer.style.display = 'block';

                // Save data
                saveData({ age, gender, weight, height, activityLevel, calories });
            }
        });

        // Load saved data on page load
        loadSavedData();
    });
</script>
