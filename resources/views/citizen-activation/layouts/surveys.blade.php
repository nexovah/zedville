 <div class="survey-container">
        <div class="progress-bar">
            <div class="progress-fill" id="progressBar"></div>
        </div>
    </div>
<style>
        .disabled-btn {
            opacity: 0.6;
            cursor: not-allowed;
        }
         .tooltip-wrapper {
    position: relative;
    display: inline-block;
}

.custom-tooltip {
    visibility: hidden;
    opacity: 0;
    width: 280px;
    background-color: #222;
    color: #fff;
    text-align: center;
    padding: 8px 10px;
    border-radius: 6px;
    font-size: 13px;

    position: absolute;
    bottom: 125%;
    left: 50%;
    transform: translateX(-50%);

    transition: opacity 0.3s ease;
    z-index: 1000;
}

.tooltip-wrapper:hover .custom-tooltip {
    visibility: visible;
    opacity: 1;
}
    </style>
    <div class="survey-content">
        <div class="error-message" id="errorMessage"></div>

        <!-- Step 1: Agreement -->
        <div class="step active" data-step="1">
            <p class="font-size:.88rem;font-weight:600;color:var(--text-secondary);margin-bottom:.75rem;text-transform:uppercase;letter-spacing:.05em">📋 Before We Begin</p>
            <p class="step-description">To help us gather accurate information, please respond to each question as truthfully as possible about your personal experiences.</p>
            
            <div class="agreement-box">
                <div class="checkbox-container">
                    <input type="checkbox" id="agreement1" name="agreement1">
                    <label for="agreement1">I agree to provide truthful answers that accurately reflect my real-life experiences and understand that this agreement is required to proceed with the survey.</label>
                </div>
            </div>
            <div class="button-group">
                <div></div>
                <button class="themeBtn " onclick="nextStep()" id="step1Next" disabled>Continue</button>
            </div>
           

        </div>

        <!-- Step 2: Diet Type -->
        <div class="step" data-step="2">
            <p class="font-size:.88rem;font-weight:600;color:var(--text-secondary);margin-bottom:.75rem;text-transform:uppercase;letter-spacing:.05em">🍽️ What's Your Diet?</p>
            <p class="step-description">Select the diet type that best describes your eating habits.</p>

            <div class="option-group">
                <label class="option-card">
                    <input type="radio" name="diet" value="omnivore">
                    <div class="option-title">🍖 Omnivore</div>
                    <div class="option-description">You eat everything</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="diet" value="vegetarian">
                    <div class="option-title">🥚 Vegetarian</div>
                    <div class="option-description">No meat, but eggs, milk, cheese, etc.</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="diet" value="pescatarian">
                    <div class="option-title">🐟 Pescatarian</div>
                    <div class="option-description">No meat, but fish, eggs, milk, cheese, etc.</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="diet" value="vegan">
                    <div class="option-title">🌱 Vegan</div>
                    <div class="option-description">No meat, no fish, no animal products like cheese, honey, etc.</div>
                </label>
            </div>

            <div class="grocery-note">
                <strong>📝 Note:</strong> Cooking oil is automatically included in your shopping basket.
            </div>

            <div class="button-group">
                <button class="whiteBtn" onclick="prevStep()">Back</button>
                <button class="themeBtn" onclick="nextStep()" disabled id="step2Next">Continue</button>
            </div>
        </div>

        <!-- Step 3: Consumer Basket Agreement -->
        <div class="step" data-step="3">
            <h2 class="step-title">🛒 Consumer Basket</h2>
            <p class="step-description">Let's set up your monthly grocery basket.</p>

            <div class="agreement-box">
                <div class="checkbox-container">
                    <input type="checkbox" id="agreement2" name="agreement2">
                    <label for="agreement2">I agree to provide truthful answers that accurately reflect my real-life experiences and understand that this agreement is required to proceed with the survey.</label>
                </div>
            </div>

            <div class="button-group">
                <button class="whiteBtn" onclick="prevStep()">Back</button>
                <button class="themeBtn" onclick="nextStep()" disabled id="step3Next">Continue</button>
            </div>
        </div>

        <!-- Step 4: Select Groceries -->
        <div class="step" data-step="4">
            <h2 class="step-title">🛍️ Choose Your Groceries</h2>
            <p class="step-description">Select <strong>10 items</strong> that you usually buy or use in a typical month. We'll add cooking oil automatically (total: 11 items).</p>

            <div class="info-note">
                <strong>Selected items:</strong> <span id="selectedCount">0</span>/10
            </div>

            <div class="checkbox-grid" id="groceryList">
                <!-- Will be populated by JavaScript based on diet selection -->
            </div>

            <div class="button-group">
                <button class="whiteBtn" onclick="prevStep()">Back</button>
                <button class="themeBtn" onclick="nextStep()" disabled id="step4Next">Continue</button>
            </div>
        </div>

        <!-- Step 5: Lunch -->
        <div class="step" data-step="5">
            <h2 class="step-title">🍱 School Lunch</h2>
            <p class="step-description">How do you usually get your lunch for school?</p>

            <div class="option-group">
                <label class="option-card">
                    <input type="radio" name="lunch" value="20">
                    <div class="option-title">🏠 Always from Home</div>
                    <div class="option-description">You bring food from home or never eat at school</div>
                    <div class="option-cost">20 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="lunch" value="22">
                    <div class="option-title">🏠🏫 Mostly Home (75/25)</div>
                    <div class="option-description">Around 75% home and 25% school food</div>
                    <div class="option-cost">22 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="lunch" value="25">
                    <div class="option-title">⚖️ Half & Half (50/50)</div>
                    <div class="option-description">Around 50% home and 50% school food</div>
                    <div class="option-cost">25 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="lunch" value="27">
                    <div class="option-title">🏫🏠 Mostly School (75/25)</div>
                    <div class="option-description">Around 25% home and 75% school food</div>
                    <div class="option-cost">27 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="lunch" value="30">
                    <div class="option-title">🏫 Always from School</div>
                    <div class="option-description">You always eat school-provided meals</div>
                    <div class="option-cost">30 Zed/month</div>
                </label>
            </div>

            <div class="button-group">
                <button class="whiteBtn" onclick="prevStep()">Back</button>
                <button class="themeBtn" onclick="nextStep()" disabled id="step5Next">Continue</button>
            </div>
        </div>

        <!-- Step 6: Transportation -->
        <div class="step" data-step="6">
            <h2 class="step-title">🚌 Transportation</h2>
            <p class="step-description">What is your main mode of transportation to campus?</p>

            <div class="option-group">
                <label class="option-card">
                    <input type="radio" name="transport" value="0">
                    <div class="option-title">🚶 Walking</div>
                    <div class="option-description">Get your daily steps in!</div>
                    <div class="option-cost">0 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="transport" value="10">
                    <div class="option-title">🚴 Cycling</div>
                    <div class="option-description">Bicycle maintenance included</div>
                    <div class="option-cost">10 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="transport" value="80">
                    <div class="option-title">🚇 Public Transport</div>
                    <div class="option-description">Bus, train, or metro</div>
                    <div class="option-cost">80 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="transport" value="100">
                    <div class="option-title">🚌 School Bus</div>
                    <div class="option-description">Dedicated school transportation</div>
                    <div class="option-cost">100 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="transport" value="70">
                    <div class="option-title">🚗 Personal Vehicle</div>
                    <div class="option-description">Self-driven or driven by parent/guardian (petrol + maintenance)</div>
                    <div class="option-cost">70 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="transport" value="240">
                    <div class="option-title">🚕 Taxi / Ride-hailing</div>
                    <div class="option-description">Regular taxi or ride service usage</div>
                    <div class="option-cost">240 Zed/month</div>
                </label>
            </div>

            <div class="button-group">
                <button class="whiteBtn" onclick="prevStep()">Back</button>
                <button class="themeBtn" onclick="nextStep()" disabled id="step6Next">Continue</button>
            </div>
        </div>

        <!-- Step 7: Paid Activities -->
        <div class="step" data-step="7">
            <h2 class="step-title">🎸 Paid Activities</h2>
            <p class="step-description">How many times per week do you participate in paid activities? (Examples: sports, music lessons, tutoring, or other classes)</p>

            <div class="option-group">
                <label class="option-card">
                    <input type="radio" name="activities" value="0">
                    <div class="option-title">Never (0 times)</div>
                    <div class="option-cost">0 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="activities" value="50">
                    <div class="option-title">Once a week</div>
                    <div class="option-cost">50 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="activities" value="75">
                    <div class="option-title">2 times per week</div>
                    <div class="option-cost">75 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="activities" value="95">
                    <div class="option-title">3 times per week</div>
                    <div class="option-cost">95 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="activities" value="110">
                    <div class="option-title">4 times per week</div>
                    <div class="option-cost">110 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="activities" value="125">
                    <div class="option-title">5 times per week</div>
                    <div class="option-cost">125 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="activities" value="140">
                    <div class="option-title">6 times per week</div>
                    <div class="option-cost">140 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="activities" value="155">
                    <div class="option-title">Every day</div>
                    <div class="option-cost">155 Zed/month</div>
                </label>
            </div>

            <div class="button-group">
                <button class="whiteBtn" onclick="prevStep()">Back</button>
                <button class="themeBtn" onclick="nextStep()" disabled id="step7Next">Continue</button>
            </div>
        </div>

        <!-- Step 8: Restaurants -->
        <div class="step" data-step="8">
            <h2 class="step-title">🍕 Eating Out</h2>
            <p class="step-description">How frequently do you eat at restaurants during a typical week? (fast food, restaurants, etc.)</p>

            <div class="option-group">
                <label class="option-card">
                    <input type="radio" name="restaurants" value="0">
                    <div class="option-title">Never</div>
                    <div class="option-cost">0 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="restaurants" value="50">
                    <div class="option-title">Once a week</div>
                    <div class="option-cost">50 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="restaurants" value="65">
                    <div class="option-title">2 times per week</div>
                    <div class="option-cost">65 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="restaurants" value="80">
                    <div class="option-title">3 times per week</div>
                    <div class="option-cost">80 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="restaurants" value="95">
                    <div class="option-title">4 times per week</div>
                    <div class="option-cost">95 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="restaurants" value="110">
                    <div class="option-title">5 times per week</div>
                    <div class="option-cost">110 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="restaurants" value="125">
                    <div class="option-title">6 times per week</div>
                    <div class="option-cost">125 Zed/month</div>
                </label>

                <label class="option-card">
                    <input type="radio" name="restaurants" value="140">
                    <div class="option-title">Every day</div>
                    <div class="option-cost">140 Zed/month</div>
                </label>
            </div>

            <div class="button-group">
                <button class="whiteBtn" onclick="prevStep()">Back</button>
                <button class="themeBtn" onclick="showResults()">See My Results</button>
            </div>
        </div>

        <!-- Step 9: Results -->
        <div class="step" data-step="9">
            <h2 class="step-title">📊 My Consumer Profile</h2>
            <p class="step-description"><b>Where Does Your Money Go?</b></p>
            <p class="step-description">
                <b>Intro text:</b> Understanding how you spend money is the first step to becoming a smart consumer. 
                Here's a breakdown of your typical monthly expenses based on your lifestyle:
            </p>

            <div class="results-container">
                <div class="category-section">
                    <div class="category-title">🍽️ Food & Groceries</div>
                    <div class="expense-item">
                        <span>Weekly groceries</span>
                        <span id="basketCost">0 Zed</span>
                    </div>
                    <div class="expense-item">
                        <span>School lunch</span>
                        <span id="lunchCost">0 Zed</span>
                    </div>
                </div>

                <div class="category-section">
                    <div class="category-title">🚌 Getting Around</div>
                    <div class="expense-item">
                        <span>Travel to school</span>
                        <span id="transportCost">0 Zed</span>
                    </div>
                </div>

                <div class="category-section">
                    <div class="category-title">🎭 Fun & Free Time</div>
                    <div class="expense-item">
                        <span>Activities & hobbies</span>
                        <span id="activitiesCost">0 Zed</span>
                    </div>
                    <div class="expense-item">
                        <span>Eating out</span>
                        <span id="restaurantsCost">0 Zed</span>
                    </div>
                </div>

                <div class="total-section">
                    <div class="total-label">Your Monthly Spending Snapshot</div>
                    <div class="total-amount" id="totalCost">0 Zed</div>
                </div>
            </div>
            <div class="info-note">
                <strong>💡 Good to Know:</strong>
                This shows your spending in the categories we asked about. Real life includes other costs too—
                like clothes, phone plans, and personal items. As you learn to budget, you'll track these as well!
            </div>
            <!-- onclick="restartSurvey()" -->
            <div class="button-group">
               <div></div>  <div class="tooltip-wrapper"><button class="themeBtn disabled-btn" >Start New Survey</button> <span class="custom-tooltip"> You have completed the survey for this month. You can do the survey again next month. </span></div>
            </div>
            

            <p class="step-description" style="margin-top: 10px; text-align:center;">
                Changed your habits? Maybe you started biking to school or cooking more at home?  
                Update your profile anytime, and you'll see the changes reflected in next month's statement.
            </p>
        </div>
    </div>
</div>
@push('scripts')
<script>
    // Intercept survey submission for this page only
// Listen for the fetch request completion in the survey
const originalFetch = window.fetch;
window.fetch = function(...args) {
    const url = args[0];
    
    // Check if this is the survey submission
    if (typeof url === 'string' && url.includes('/profile/storesurvey')) {
        return originalFetch.apply(this, args)
            .then(response => {
                // Clone response before reading it
                const clonedResponse = response.clone();
                
                // Get the survey data from the response
                clonedResponse.json().then(data => {
                    console.log('Survey saved successfully:', data);
                    
                    // Show success message
                    //alert('Survey completed successfully! Page will refresh in 3 seconds...');
                    
                    // Refresh page after 3 seconds
                    setTimeout(function() {
                         window.location.href = '{{ route('bank.index') }}';
                    }, 3000);
                }).catch(err => console.error('Error parsing response:', err));
                
                return response;
            });
    }
    
    return originalFetch.apply(this, args);
};
</script>
@endpush
    


