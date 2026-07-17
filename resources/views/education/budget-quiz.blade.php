@extends('layouts.profile')

@section('title', 'Educational Finance Department')

@section('content')
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">Introduction to Budget</h1>
</div>
<div class="grid grid-cols-1 gap-5 mt-6">
    <div class="themeTabspills">
        <div class="w-full">
            <div class="max-w-[600px] mx-auto w-full bg-white border border-color-[#D2DDDB] rounded">
                <form action="#" method="post">
                    <div class="quizeIntroSteps p-10" id="quizeIntroText">
                        <h2 class="text-xl font-semibold mb-4">Introduction to Budget</h2>
                        <div id="questionTxtCarou" class="relative w-full">
                            <!-- Question Instructions -->
                            <div class="quizSliderContent">
                                <!-- Item 1 -->
                                <div class="duration-200 ease-linear quizQuesTab active">
                                    <div class="introText">
                                        <h4 class="text-lg font-semibold mb-4">What’s a Budget?</h4>
                                        <p class="mb-2">A budget is like a simple guide for your money. It helps you:</p>
                                        <ul class="list-disc list-inside">
                                            <li><strong>Know your money.</strong> How much money is coming in.</li>
                                            <li><strong>See where it goes.</strong> What you spend your money on.</li>
                                            <li><strong>Plan to save.</strong> Set aside some money for things you want in the future.</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Item 2 -->
                                <div class="duration-200 ease-linear quizQuesTab">
                                    <div class="introText">
                                        <p class="mb-2">Why make choices about our money?</p>
                                        <p>The money we have now is limited. Whether it’s your allowance, gifts, or even money you might earn later, there’s only much of it. This means we need to make choices about what’s most important to spend it on. A budget helps us make these smart choices.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Questions -->
                            <div class="tab-nav flex justify-end gap-4 mt-8">
                                <button type="button" class="secondaryBtn hidden tb-prev">Previous</button>
                                <button type="button" class="themeBtn tb-next">Next</button>
                                <button type="button" class="themeBtn hidden startQuiz" id="startQuiz">Start Quiz</button>
                            </div>
                        </div>
                    </div>

                    <div class="quizeSecQuestion hidden" id="quizQuestions">
                        <div class="quizQuestionSecItem" id="questionansSet">
                            <div class="quizQuestionSec">
                                <div class="singleQuiz active">
                                    <div class="quesHeading p-4 border-b border-color-[#D2DDDB] shadow-sm">
                                        <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
                                            <h4 class="text-xl font-semibold">Question 1</h4>
                                            <span class="text-sm font-semibold">1/5</span>
                                        </div>
                                        <h2 class="questionTitle text-2xl font-semibold">What is a budget?</h2>
                                    </div>
                                    <div class="questionLists p-4">
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet1" id="qsetques1_1">
                                            <label for="qsetques1_1" class="quizLabel">A type of bank account</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet1" id="qsetques1_2" data-correct="true">
                                            <label for="qsetques1_2" class="quizLabel">A guide for your money</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet1" id="qsetques1_3">
                                            <label for="qsetques1_3" class="quizLabel">A way to earn more money</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet1" id="qsetques1_4">
                                            <label for="qsetques1_4" class="quizLabel">A list of things you want to buy</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="singleQuiz">
                                    <div class="quesHeading p-4 border-b border-color-[#D2DDDB] shadow-sm">
                                        <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
                                            <h4 class="text-xl font-semibold">Question 2</h4>
                                            <span class="text-sm font-semibold">2/5</span>
                                        </div>
                                        <h2 class="questionTitle text-2xl font-semibold">What does a budget help you do?</h2>
                                    </div>
                                    <div class="questionLists p-4">
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet2" id="qsetques2_1">
                                            <label for="qsetques2_1" class="quizLabel">pend all your money at once</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet2" id="qsetques2_2" data-correct="true">
                                            <label for="qsetques2_2" class="quizLabel">Know how much money is coming in and where it goes</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet2" id="qsetques2_3">
                                            <label for="qsetques2_3" class="quizLabel">Hide your money from others</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet2" id="qsetques2_4">
                                            <label for="qsetques2_4" class="quizLabel">Only buy expensive things</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="singleQuiz">
                                    <div class="quesHeading p-4 border-b border-color-[#D2DDDB] shadow-sm">
                                        <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
                                            <h4 class="text-xl font-semibold">Question 3</h4>
                                            <span class="text-sm font-semibold">3/5</span>
                                        </div>
                                        <h2 class="questionTitle text-2xl font-semibold">Why is it important to track how much money you have?</h2>
                                    </div>
                                    <div class="questionLists p-4">
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet3" id="qsetques3_1">
                                            <label for="qsetques3_1" class="quizLabel">So you can spend it all quickly</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet3" id="qsetques3_2" data-correct="true">
                                            <label for="qsetques3_2" class="quizLabel">Because money is limited, and you need to make smart choices</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet3" id="qsetques3_3">
                                            <label for="qsetques3_3" class="quizLabel">To impress your friends</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet3" id="qsetques3_4">
                                            <label for="qsetques3_4" class="quizLabel">Because banks require it</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="singleQuiz">
                                    <div class="quesHeading p-4 border-b border-color-[#D2DDDB] shadow-sm">
                                        <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
                                            <h4 class="text-xl font-semibold">Question 4</h4>
                                            <span class="text-sm font-semibold">4/5</span>
                                        </div>
                                        <h2 class="questionTitle text-2xl font-semibold">What is the first step in creating a budget?</h2>
                                    </div>
                                    <div class="questionLists p-4">
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet4" id="qsetques4_1">
                                            <label for="qsetques4_1" class="quizLabel">Spending all your money</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet4" id="qsetques4_2" data-correct="true">
                                            <label for="qsetques4_2" class="quizLabel">Knowing how much money you have coming in</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet4" id="qsetques4_3">
                                            <label for="qsetques4_3" class="quizLabel">To impress your friends</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet4" id="qsetques4_4">
                                            <label for="qsetques4_4" class="quizLabel">Because banks require it</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="singleQuiz">
                                    <div class="quesHeading p-4 border-b border-color-[#D2DDDB] shadow-sm">
                                        <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
                                            <h4 class="text-xl font-semibold">Question 5</h4>
                                            <span class="text-sm font-semibold">5/5</span>
                                        </div>
                                        <h2 class="questionTitle text-2xl font-semibold">How does a budget help with future goals?</h2>
                                    </div>
                                    <div class="questionLists p-4">
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet5" id="qsetques5_1">
                                            <label for="qsetques5_1" class="quizLabel">By letting you spend everything now</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet5" id="qsetques5_2" data-correct="true">
                                            <label for="qsetques5_2" class="quizLabel">By helping you save for things you want later</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet5" id="qsetques5_3">
                                            <label for="qsetques5_3" class="quizLabel">By making money disappear</label>
                                        </div>
                                        <div class="quizItems">
                                            <input type="radio" class="hidden" name="questionSet5" id="qsetques5_4">
                                            <label for="qsetques5_4" class="quizLabel">By preventing you from ever spending</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="quizeBtns flex flex-wrap justify-end items-center gap-4 mt-4 p-4">
                                <button type="button" class="secondaryBtn qs-prev hidden">Previous</button>
                                <button type="button" class="themeBtn qs-next">Next</button>
                                <button type="submit" class="themeBtn hidden submitBtn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    jQuery(document).ready(function() {
        $(".tb-next").click(function() {
            let cur = $(this).closest("#questionTxtCarou").find(".quizQuesTab.active");
            if (jQuery(cur).next().length > 0) {
                $(".tb-prev").removeClass("hidden");
                $(this).parent('.tab-nav').addClass("justify-between");
                jQuery(".quizQuesTab").removeClass("active");
                jQuery(cur).next().addClass("active");
            }
            if (jQuery(cur).next().next().length == 0) {
                $(".tb-next").addClass("hidden");
                $(".startQuiz").removeClass("hidden");
            }
        });

        $(".tb-prev").click(function() {
            let cur = $(this).closest("#questionTxtCarou").find(".quizQuesTab.active");
            if (jQuery(cur).prev().length > 0) {
                $(".startQuiz").addClass("hidden");
                $(".tb-next").removeClass("hidden");
                jQuery(".quizQuesTab").removeClass("active");
                jQuery(cur).prev().addClass("active");
            }
            if (jQuery(cur).prev().prev().length == 0) {
                $(".tb-prev").addClass("hidden");
                $(this).parent('.tab-nav').removeClass("justify-between");
            }
        });

        // Start Quiz
        $("#startQuiz").click(function() {
            $("#quizeIntroText").addClass("hidden");
            $("#quizQuestions").removeClass("hidden");
        });

        // Quiz Next Previous Btns Actions
        
        jQuery(".qs-next").click(function() {
            let qescur = $(this).closest("#questionansSet").find(".singleQuiz.active");
            if (jQuery(qescur).next().length > 0) {
                $(".qs-prev").removeClass("hidden");
                $(this).parent('.quizeBtns').addClass("justify-between");
                jQuery(".singleQuiz").removeClass("active");
                jQuery(qescur).next().addClass("active");
            }
            if (jQuery(qescur).next().next().length == 0) {
                $(".qs-next").addClass("hidden");
                $(".submitBtn").removeClass("hidden");
            }
        });

        $(".qs-prev").click(function() {
            let qescur = $(this).closest("#questionansSet").find(".singleQuiz.active");
            if (jQuery(qescur).prev().length > 0) {
                $(".submitBtn").addClass("hidden");
                $(".qs-next").removeClass("hidden");
                jQuery(".singleQuiz").removeClass("active");
                jQuery(qescur).prev().addClass("active");
            }
            if (jQuery(qescur).prev().prev().length == 0) {
                $(".qs-prev").addClass("hidden");
                $(this).parent('.quizeBtns').removeClass("justify-between");
            }
        });
    });

    // Correct And Wrong Answer Detect

    
</script>
@endpush