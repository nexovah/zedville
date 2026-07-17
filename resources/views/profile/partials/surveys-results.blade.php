<div class="survey-container">
    <div class="survey-content">
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
        <div>
            <h2 class="step-title">📊 My Consumer Profile</h2>
            <p class="step-description"><b>Where Does Your Money Go?</b></p>
            <p class="step-description">
                <b>Intro text:</b> Understanding how you spend money is the first step to becoming a smart consumer. 
                Here's a breakdown of your typical monthly expenses based on your lifestyle:
            </p>

            <div class="results-container">

                <!-- Food & Groceries -->
                <div class="category-section">
                    <div class="category-title">🍎 Food & Groceries</div>

                    <div class="expense-item">
                        <span>
                            Weekly groceries
                             <br>
                            <small>{{ $itemNames }}</small>
                        </span>
                        <span id="basketCost" style="white-space: nowrap;">{{ number_format($basketTotal, 2) }} Zed</span>
                    </div>

                    <div class="expense-item">
                        <span>School lunch</span>
                        <span id="lunchCost">{{ number_format($lunch, 2) }} Zed</span>
                    </div>
                </div>

                <!-- Transportation -->
                <div class="category-section">
                    <div class="category-title">🚌 Getting Around</div>

                    <div class="expense-item">
                        <span>Travel to school</span>
                        <span id="transportCost">{{ number_format($transport , 2) }} Zed</span>
                    </div>
                </div>

                <!-- Fun & Free Time -->
                <div class="category-section">
                    <div class="category-title">🎭 Fun & Free Time</div>

                    <div class="expense-item">
                        <span>Activities & hobbies</span>
                        <span id="activitiesCost">{{ number_format($activities , 2) }} Zed</span>
                    </div>

                    <div class="expense-item">
                        <span>Eating out</span>
                        <span id="restaurantsCost">{{ number_format($restaurants , 2) }} Zed</span>
                    </div>
                </div>

                <!-- Total -->
                <div class="total-section">
                    <div class="total-label">Your Monthly Spending Snapshot</div>
                    <div class="total-amount" id="totalCost">{{ number_format($total, 2) }} Zed</div>
                </div>

            </div>

            <!-- Info Note -->
            <div class="info-note">
                <strong>💡 Good to Know:</strong>
                This shows your spending in the categories we asked about. Real life includes other costs too—
                like clothes, phone plans, and personal items. As you learn to budget, you'll track these as well!
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <div></div>
                @if($ConsumersurveyExists)
                    <div class="tooltip-wrapper">
                        <button
                            class="themeBtn disabled-btn"
                            disabled>
                            Update My Profile
                        </button>
                        <span class="custom-tooltip">
                            You have completed the survey for this month. You can do the survey again next month.
                        </span>
                    </div>

                @else
                    <a href="{{ route('consumer-profile-survey') }}">
                        <button class="themeBtn">
                            Update My Profile
                        </button>
                    </a>
                @endif
            </div>

            <p class="step-description" style="margin-top: 10px; text-align:center;">
                Changed your habits? Maybe you started biking to school or cooking more at home?  
                Update your profile anytime, and you'll see the changes reflected in next month's statement.
            </p>

        </div>
    </div>
</div>
