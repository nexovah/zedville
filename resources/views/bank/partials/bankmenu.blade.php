<div class="flex menus overborderleftright border-b border-[#D2DDDB]">
    <a href="{{ route('bank.index') }}" class="tabitems {{ request()->routeIs('bank.index') ? 'active' : '' }}">
        Dashboard
    </a>
    <a href="{{ route('bank.my_account') }}" class="tabitems {{ request()->routeIs('bank.my_account') ? 'active' : '' }}">
        My Accounts
    </a>
    <a href="{{ route('bank.transfer') }}" class="tabitems {{ request()->routeIs('bank.transfer') ? 'active' : '' }}">
        Transfers
    </a>
    <a href="{{ route('bank.pay_bills') }}" class="tabitems {{ request()->routeIs('bank.pay_bills') ? 'active' : '' }}">
        Pay Bills
    </a>
    <!-- <a href="{{ route('bank.bank_statements') }}" class="tabitems {{ request()->routeIs('bank.bank_statements') ? 'active' : '' }}">
        Statements
    </a> -->
    <a href="{{ route('bank.bank_statement_show') }}" class="tabitems {{ request()->routeIs('bank.bank_statement_show') ? 'active' : '' }}">
        Statements
    </a>
    <a href="{{ route('bank.help') }}" class="tabitems {{ request()->routeIs('bank.help') ? 'active' : '' }}">
        Help
    </a>
</div>
