<div class="transMoneySec">
    <h3 class="text-lg font-bold whitespace-nowrap ">Transfer Money</h3>
    <div class="flex flex-wrap gap-4 mt-6">
        <div class="w-full xl:w-[100%]">
            <div class="bg-white rounded-lg p-6 border border-[#D2DDDB] userProfileDtls ">
                <form action="#" method="post">
                    <div class="space-y-4">
                        <div class="flex flex-wrap lg:flex-nowrap gap-4">
                            <div class="w-full lg:w-[50%]">
                                <div class="mb-4 form-group">
                                    <label class="block mb-2 text-base font-medium text-black">From Account</label>
                                    <select class="form-select">
                                        <option value="primary">Primary Savings (2,850 ZEDS)</option>
                                        <option value="emergency">Emergency Fund (500 ZEDS)</option>
                                        <option value="moneyMarket">Money Market (1,200 ZEDS)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-full lg:w-[50%]">
                                <div class="mb-4 form-group">
                                    <label class="block mb-2 text-base font-medium text-black">To Bank</label>
                                    <select class="form-select">
                                        <option value="">Select Bank</option>
                                        <option value="Universal Bank">Universal Bank</option>
                                        <option value="Chase Bank">Chase Bank</option>
                                        <option value="Wells Fargo">Wells Fargo</option>
                                        <option value="Bank of America">Bank of America</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap lg:flex-nowrap gap-4">
                            <div class="w-full lg:w-[33.33%]">
                                <div class="mb-4 form-group">
                                    <label class="block mb-2 text-base font-medium text-black">Account Number</label>
                                    <input class="form-control" placeholder="Enter account number" type="text" value="">
                                </div>
                            </div>
                            <div class="w-full lg:w-[33.33%]">
                                <div class="mb-4 form-group">
                                    <label class="block mb-2 text-base font-medium text-black">Recipient Name</label>
                                    <input class="form-control" placeholder="Enter recipient name" type="text" value="">
                                </div>
                            </div>
                            <div class="w-full lg:w-[33.33%]">
                                <div class="mb-4 form-group">
                                    <label class="block mb-2 text-base font-medium text-black">Amount (ZEDS)</label>
                                    <input class="form-control" placeholder="0.00" type="number" value="">
                                </div>
                            </div>
                        </div>
                        <div class="pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-semibold text-black mb-4">When to Transfer</h3>
                            <div class="space-y-4">
                                <div class="mb-4 form-group">
                                    <label class="block mb-2 text-base font-medium text-black">Schedule</label>
                                    <select class="form-select" id="transferSchedule">
                                        <option value="now">Now (Transfer immediately)</option>
                                        <option value="once">Once (Future date)</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="quarterly">Quarterly</option>
                                    </select>
                                </div>
                                <div class="mb-4 form-group" id="onetimmeDate" style="display: none;">
                                    <label class="block mb-2 text-base font-medium text-black">Transfer Date</label>
                                    <input type="date" class="form-control" placeholder="Select date" value="">
                                </div>
                                <div class="flex flex-wrap lg:flex-nowrap gap-4" id="recurringDate" style="display: none;">
                                    <div class="w-full lg:w-[50%]">
                                        <div class="mb-4 form-group">
                                            <label class="block mb-2 text-base font-medium text-black">Start Date</label>
                                            <input type="date" class="form-control" placeholder="Select date" value="">
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-[50%]">
                                        <div class="mb-4 form-group">
                                            <label class="block mb-2 text-base font-medium text-black">End Date (Optional)</label>
                                            <input type="date" class="form-control" placeholder="Select date" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="themeBtn" id="submitTransferBtn"><span>Send Now</span></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="w-full xl:w-[100%]">
            <div class="bg-white rounded-lg p-6 border border-[#D2DDDB]">
                <h3 class="text-lg font-semibold text-black mb-4">Scheduled Transfers</h3>
                <div class="themeTable">
                    <div class="text-center py-8 text-gray-500"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target mx-auto mb-3 text-gray-300">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                        <p>No scheduled transfers yet</p>
                    </div>

                    <table class="table w-full hidden">
                        <thead>
                            <tr>
                                <th class="text-left">Date</th>
                                <th class="text-left">From</th>
                                <th class="text-left">To</th>
                                <th class="text-left">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                            <tr>
                                <td>01/01/2023</td>
                                <td>Primary Savings</td>
                                <td>Universal Bank</td>
                                <td>100 ZEDS</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>