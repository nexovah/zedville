<div class="flex menus overborderleftright border-b border-[#D2DDDB]">
    <a href="{{ route('bank.pay_bills') }}" class="tabitems {{ request()->routeIs('bank.pay_bills') ? 'active' : '' }}">
        Pay a Bill
    </a>
    <a href="{{ route('bank.manage_payee') }}" class="tabitems {{ request()->routeIs('bank.manage_payee') ? 'active' : '' }}">
        Manage Payee
    </a>
    <a href="{{ route('bank.recurring_payment') }}" class="tabitems {{ request()->routeIs('bank.recurring_payment') ? 'active' : '' }}">
        Recurring Payment
    </a>
    <a href="{{ route('bank.payment_history') }}" class="tabitems {{ request()->routeIs('bank.payment_history') ? 'active' : '' }}">
        Payment History
    </a>
</div>
